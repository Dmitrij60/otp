<?php
// FRONT CONTROLLER

// 1. Общие настройки
ini_set('display_errors', 'off');
error_reporting(E_ALL);
ini_set('log_errors','on');
ini_set('error_log', __DIR__ . '/logs/main_error.log');
session_start();
//2. Подключение файлов
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');


//3. Запук Роутера
$router = new Router();
$router->run();