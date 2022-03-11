<?php

define('DOCUMENT_ROOT', dirname(__DIR__));

require (DOCUMENT_ROOT . '/vendor/autoload.php');

// echo '<div class="alert alert-info">alerterd</div>';die;
use Src\Router as Router;

$router = new Router;
// var_dump($router);die;
