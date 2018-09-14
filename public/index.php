<?php 
session_start();

require '../config/dev.php';
require '../config/Autoloader.php';
require '../_functions/functions.php';

\cyannlab\config\Autoloader::register();

use cyannlab\config\Router;

$router = new Router();
$router->run();

