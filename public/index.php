<?php

session_start();
//session_destroy();

var_dump($_SESSION);
var_dump(" POST : ");
var_dump($_POST);

require_once '../vendor/autoload.php';
require_once '../config/routes.php';
require_once '../config/config.php';
require_once '../src/router.php';
require_once '../src/twig.php';
require_once '../src/database.php';

$db = getConnection($config);

$twig = initTwig('../template/');

$actionController = initRouter($routes, $db);
$actionController($twig, $db);