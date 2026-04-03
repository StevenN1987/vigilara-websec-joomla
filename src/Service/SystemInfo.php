<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  system.vigilara_websec
 * @copyright   Copyright (C) 2026 Steven Naschold
 * @license     GNU General Public License version 3 or later;
 */

namespace Vigilara\WebSec\Service;

defined('_JEXEC') or die;

class SystemInfo
{
    public function getStatus(): array
    {
        return [
            'php_version'    => PHP_VERSION,
            'server_software'=> $_SERVER['SERVER_SOFTWARE'] ?? '',
            'time'           => gmdate('Y-m-d H:i:s'),
        ];
    }
}


