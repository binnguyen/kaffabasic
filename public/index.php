<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
error_reporting(1);
ini_set("display_errors", 1);

chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Setup autoloading
require 'init_autoloader.php';
require './vendor/excel/PHPExcel.php';
// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
