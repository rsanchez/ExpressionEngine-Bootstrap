<?php

if (!isset($system_path)) {
    $system_path = "system";
}

$debug = 1;

$routing['directory'] = '';
$routing['controller'] = '';
$routing['function'] = '';

if (realpath($system_path) !== false) {
    $system_path = realpath($system_path);
}

$system_path = rtrim($system_path, '/') . '/';

define('BOOT_ONLY', true);

define('SELF', basename(__FILE__));
define('FCPATH', __DIR__ . '/');
define('SYSPATH', $system_path);
define('SYSDIR', basename($system_path));
define('DEBUG', $debug);unset($debug);

error_reporting(E_ALL);
@ini_set('display_errors', 1);

require_once SYSPATH . 'ee/EllisLab/ExpressionEngine/Boot/boot.php';
