<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  system.vigilara_websec
 * @copyright   Copyright (C) 2026 Steven Naschold Computerservice
 * @license     GNU General Public License version 3 or later;
 */

namespace Vigilara\WebSec\Event;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class Listener
{
    protected $app;
    protected $params;

    public function __construct($app, $params)
    {
        $this->app    = $app;
        $this->params = $params;
    }

    public function onUserLoginFailure($response)
    {
        $this->storeEvent('login_fail', [
            'username' => $response['username'] ?? '',
            'ip'       => $_SERVER['REMOTE_ADDR'] ?? '',
        ]);
    }

    public function onUserLogin($user, $options = [])
    {
        if (empty($user['username'])) {
            return;
        }

        $joomlaUser = Factory::getUser($user['username']);

        if ($joomlaUser->authorise('core.admin')) {
            $this->storeEvent('admin_login', [
                'user_id'  => $joomlaUser->id,
                'username' => $joomlaUser->username,
                'ip'       => $_SERVER['REMOTE_ADDR'] ?? '',
            ]);
        }
    }

    public function onUserAfterSave($user, $isNew, $success, $msg)
    {
        if (!$success) {
            return;
        }

        $this->storeEvent($isNew ? 'user_created' : 'user_updated', [
            'user_id'  => $user['id'],
            'username' => $user['username'],
        ]);
    }

    public function onUserAfterDelete($user, $success, $msg)
    {
        if (!$success) {
            return;
        }

        $this->storeEvent('user_deleted', [
            'user_id'  => $user['id'],
            'username' => $user['username'],
        ]);
    }

    private function storeEvent(string $type, array $data)
    {
        try {
            $db = Factory::getContainer()->get('DatabaseDriver');

            $query = $db->getQuery(true)
                ->insert($db->quoteName('#__vigilara_events'))
                ->columns([
                    $db->quoteName('type'),
                    $db->quoteName('data'),
                    $db->quoteName('created')
                ])
                ->values(
                    $db->quote($type) . ', ' .
                    $db->quote(json_encode($data)) . ', ' .
                    $db->quote(date('Y-m-d H:i:s'))
                );

            $db->setQuery($query)->execute();
        } catch (\Exception $e) {
            // Monitoring darf nie blockieren
        }
    }
}