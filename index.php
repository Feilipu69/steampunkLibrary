<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

session_start();

use Bihin\steampunkLibrary\classes\Router;

$test = new Router();
$test->renderController();
