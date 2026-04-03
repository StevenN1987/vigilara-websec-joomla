<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.vigilara_websec
 * @copyright   Copyright (C) 2026 Steven Naschold
 * @license     GNU General Public License version 3 or later;
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class PlgSystemVigilara_websecInstallerScript
{
    /**
     * Wird bei Neuinstallation ausgeführt
     */
    public function install($parent)
    {
        $this->createDashboardPreset();
        $this->createDatabaseTables();
    }

    /**
     * Wird bei Updates ausgeführt
     */
    public function update($parent)
    {
        $this->createDashboardPreset();
        $this->createDatabaseTables();
    }

    /**
     * Dashboard-Preset "Vigilara Security" anlegen
     */
    private function createDashboardPreset()
    {
        try {
            $db = Factory::getContainer()->get('DatabaseDriver');

            // Prüfen, ob das Preset bereits existiert
            $query = $db->getQuery(true)
                ->select('id')
                ->from('#__administrator_dashboards')
                ->where('alias = ' . $db->quote('vigilara-security'));

            $db->setQuery($query);
            $exists = $db->loadResult();

            if ($exists) {
                return;
            }

            // Neues Dashboard-Preset
            $dashboard = (object) [
                'title'      => 'Vigilara Security',
                'alias'      => 'vigilara-security',
                'home'       => 0,
                'published'  => 1,
                'created'    => date('Y-m-d H:i:s'),
                'modified'   => date('Y-m-d H:i:s'),
            ];

            $db->insertObject('#__administrator_dashboards', $dashboard);
            $dashboardId = $db->insertid();

            // Widget hinzufügen
            $widget = (object) [
                'dashboard_id' => $dashboardId,
                'type'         => 'widget',
                'element'      => 'vigilara_websec',
                'position'     => 'main',
                'ordering'     => 1,
                'params'       => '{}',
            ];

            $db->insertObject('#__administrator_dashboard_items', $widget);

        } catch (\Exception $e) {
            // Fehler ignorieren – Installation darf nie blockieren
        }
    }

    /**
     * Erstellt die benötigten Tabellen (Joomla 6: SQL muss hier ausgeführt werden)
     */
    private function createDatabaseTables()
    {
        try {
            $db = Factory::getContainer()->get('DatabaseDriver');

            $query = "
                CREATE TABLE IF NOT EXISTS `#__vigilara_events` (
                    `id` INT AUTO_INCREMENT PRIMARY KEY,
                    `type` VARCHAR(50),
                    `data` TEXT,
                    `created` DATETIME
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ";

            $db->setQuery($query)->execute();

        } catch (\Exception $e) {
            // Fehler ignorieren – Installation darf nie blockieren
        }
    }
}
