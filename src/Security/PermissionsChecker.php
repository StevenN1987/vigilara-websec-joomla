<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  system.vigilara_websec
 * @copyright   Copyright (C) 2026 Steven Naschold Computerservice
 * @license     GNU General Public License version 3 or later;
 */

namespace Vigilara\WebSec\Security;

defined('_JEXEC') or die;

class PermissionChecker
{
    /**
     * Joomla‑empfohlene Rechte
     */
    private array $expected = [
        JPATH_CONFIGURATION . '/configuration.php' => [444, 640],
        JPATH_ADMINISTRATOR                       => [755],
        JPATH_CACHE                               => [755],
        JPATH_LOGS                                => [755],
        JPATH_TMP                                 => [755],
        JPATH_ROOT                                => [755],
    ];

    /**
     * Führt die Prüfung durch und liefert ein Array mit Ergebnissen.
     */
    public function scan(): array
    {
        $results = [];

        foreach ($this->expected as $path => $allowed) {
            $results[] = $this->checkPath($path, $allowed);
        }

        return $results;
    }

    /**
     * Prüft einen einzelnen Pfad.
     */
    private function checkPath(string $path, array $allowed): array
    {
        if (!file_exists($path)) {
            return [
                'path'    => $path,
                'status'  => 'missing',
                'perms'   => null,
                'allowed' => $allowed,
            ];
        }

        $perms = substr(sprintf('%o', fileperms($path)), -3);
        $permsInt = (int) $perms;

        return [
            'path'    => $path,
            'perms'   => $permsInt,
            'allowed' => $allowed,
            'status'  => $this->evaluate($path, $permsInt, $allowed),
        ];
    }

    /**
     * Bewertet die Rechte nach Joomla‑Standards.
     */
    private function evaluate(string $path, int $perms, array $allowed): string
    {
        // Kritische Fälle
        $critical = [777, 775, 666];
        if (in_array($perms, $critical, true)) {
            return 'critical';
        }

        // configuration.php Sonderfall
        if ($path === JPATH_CONFIGURATION . '/configuration.php') {
            return in_array($perms, $allowed, true) ? 'ok' : 'critical';
        }

        // Ordner
        if (is_dir($path)) {
            if ($perms === 755) {
                return 'ok';
            }
            if (in_array($perms, [775, 777], true)) {
                return 'critical';
            }
            return 'warning';
        }

        // Dateien
        if (is_file($path)) {
            if (in_array($perms, [644, 640], true)) {
                return 'ok';
            }
            if (in_array($perms, [666, 664], true)) {
                return 'warning';
            }
            return 'warning';
        }

        return 'warning';
    }

    /**
     * Zählt unsichere Dateien (warning + critical)
     */
    public function countUnsafe(): int
    {
        $count = 0;

        foreach ($this->scan() as $item) {
            if (in_array($item['status'], ['warning', 'critical'], true)) {
                $count++;
            }
        }

        return $count;
    }
}