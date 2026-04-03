<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  system.vigilara_websec
 * @copyright   Copyright (C) 2026 Steven Naschold
 * @license     GNU General Public License version 3 or later;
 */

namespace Vigilara\WebSec\Dashboard;

defined('_JEXEC') or die;

use Joomla\CMS\Dashboard\AbstractDashboardPlugin;
use Joomla\CMS\Dashboard\DashboardPluginInterface;
use Joomla\CMS\Layout\FileLayout;

class VigilaraWidget extends AbstractDashboardPlugin implements DashboardPluginInterface
{
    /**
     * Titel im Dashboard
     */
    public function getTitle(): string
    {
        return 'Vigilara WebSec';
    }

    /**
     * Icon im Dashboard
     */
    public function getIcon(): string
    {
        return 'icon-shield';
    }

    /**
     * Layout-ID (für Joomla)
     */
    public function getLayoutId(): string
    {
        return 'vigilara_websec.dashboard.default';
    }

    /**
     * Rendert das Dashboard-Widget
     */
    public function render(array $data = []): string
    {
        $layout = new FileLayout(
            'dashboard.default',
            JPATH_PLUGINS . '/system/vigilara_websec/tmpl'
        );

        return $layout->render([]);
    }
}
