<?php
require_once("../../Slim/Slim.php");
//require_once("../classes/Connection.php");

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

include("calculadora.php");

//require_once ('users.php');

$app->run();
?>