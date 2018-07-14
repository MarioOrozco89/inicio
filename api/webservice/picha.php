<?php

$app->get('/obtener/picha/:picha', function($pic){

if($pic >= "18")
{
	$retorno_msj = "pareces el negro de whatsapp";
}
else if($pic <= "17")
{
	$retorno_msj = "eres picha corta";
}


echo json_encode($retorno_msj);
});


?>