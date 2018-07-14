<?php
require_once("../classes/Users.php");

$app->get("/login/:password/:user",function($password, $user){
$login=Users::login($password,$user);
echo json_encode($login);
});

$app->patch('/edit/password', function() use ($app){
$req = $app->request();
$params = json_decode($req->getBody(), true);
$response=Users::editPass($params);
echo json_encode($response);
});

?>