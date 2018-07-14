<?php

$app->get('/obtener/estatura/:estatura', function($est){

if($est > "170"){
	$retorno_msj = "pareces nopal";
}else if($est < "170")
{
	$retorno_msj = "pareces un pinche gnomo como la vieja de la prepa";
}
else if ($est == "170")
{
	$retorno_msj = "la armas para guardia de seguridad privada";
}

echo json_encode($retorno_msj);
});


?>