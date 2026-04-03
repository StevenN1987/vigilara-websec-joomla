<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  system.vigilara_websec
 * @copyright   Copyright (C) 2026 Steven Naschold
 * @license     GNU General Public License version 3 or later;
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Vigilara\WebSec\Service\SystemInfo;
use Vigilara\WebSec\Security\PermissionsChecker;

class PlgSystemVigilara_websec extends CMSPlugin
{
    protected $app;

    public function __construct(&$subject, $config)
    {
        parent::__construct($subject, $config);
        $this->app = Factory::getApplication();
    }

    // WICHTIG:
    // Listener NICHT manuell registrieren!
    // Joomla lädt Event-Subscriber automatisch über die XML + Namespace.

    public function onAjaxVigilarawebsec()
    {
        $systemInfo  = new SystemInfo();
        $permissions = new PermissionsChecker();

        $events = $this->getEvents();
        $score  = $this->calculateSecurityScore($systemInfo, $permissions, $events);
        $polling = $this->calculatePollingInterval($events);

        return [
            'score'        => $score,
            'polling'      => $polling,
            'system'       => $systemInfo->getStatus(),
            'permissions'  => $permissions->scan(),
            'php'          => $systemInfo->getPhpSecurity(),
            'events'       => $events,
            'eventCount'   => count($events),
            'status'       => $this->getSecurityStatus($score),
        ];
    }

    private function getEvents(): array
    {
        try {
            $db = Factory::getContainer()->get('DatabaseDriver');

            $width = $_GET['width'] ?? 1200;
            $limit = ($width >= 1400) ? 100 : (($width >= 900) ? 50 : 25);

            $query = $db->getQuery(true)
                ->select('*')
                ->from('#__vigilara_events')
                ->order('id DESC')
                ->setLimit($limit);

            $db->setQuery($query);
            $rows = $db->loadAssocList();

            foreach ($rows as &$row) {
                $row['data'] = json_decode($row['data'], true);
            }

            return $rows;
        } catch (\Exception $e) {
            return [];
        }
    }

    private function calculatePollingInterval(array $events): int
    {
        $count = count($events);

        if ($count > 50) return 2000;
        if ($count > 20) return 5000;

        return 10000;
    }

    private function calculateSecurityScore(SystemInfo $system, PermissionsChecker $perm, array $events): int
    {
        $score = 100;

        if (!$system->isPhpSecure()) $score -= 20;
        if (!$system->isJoomlaSecure()) $score -= 15;

        $unsafe = $perm->countUnsafe();
        $score -= min($unsafe * 5, 30);

        $critical = array_filter($events, fn($e) => $e['type'] === 'login_fail');
        $score -= min(count($critical) * 2, 20);

        return max(0, min(100, $score));
    }

    private function getSecurityStatus(int $score): string
    {
        if ($score >= 80) return 'Secure';
        if ($score >= 50) return 'Warning';
        return 'Critical';
    }
}
