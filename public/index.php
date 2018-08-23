<?php 
require '../config/dev.php';
require '../config/Autoloader.php';

\cyannlab\config\Autoloader::register();

use cyannlab\config\Router;

$router = new Router();
$router->run();

