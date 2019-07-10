<?php

/** FRONT CONTROLLER*/

// 1. Проверка наличия ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Подключение файлов системы
define('ROOT', dirname(__FILE__));
//require_once(ROOT . '/components/Router.php');
//require_once(ROOT . '/components/Db.php');

session_start();
require_once 'components/Autoload.php';

// 3. Соединение с БД

//$string = '21-11-2015';
//$pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
//$replacement = 'Год $3, месяц $2, день $1';
//
//echo preg_replace($pattern, $replacement, $string) . '<br>';
//                    как        куда         что
//                     Год 2015, месяц 11, день 21

// 4. Вызов Router


$router = new Router();
$router->run();
