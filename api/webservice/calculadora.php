<?php
$app->get('/obtener/sexo/:sexo', function($sexo){

if($sexo == "M"){
	$retorno_sexo = "Tienes pito";
}else if($sexo == "F")
{
	$retorno_sexo = "Tienes panocha";
}
else{
	$retorno_sexo = "Eres puto o lesbiana";
}

echo json_encode($retorno_sexo);
});

$app->get('/obtener/edad/:year', function($year){
if($year < 1990){
	$respuesta = "Eres guerrero";
}else if($year >= 1990){
	$respuesta = "Eres un milenial pedorro";
}
echo json_encode($respuesta);
});

$app->get('/calcular/mulez/:nombre', function($nombre){

switch ($nombre) {
	case 'agui':
		$respuesta = "Es mula como la chingada";
		break;
	case 'alan':
		$respuesta = "Es mulo como la verga y es el soberano de los mulos";
		break;
	case 'mario':
		$respuesta = "Es un hibrido perfecto entre orozco y ortiz";
		break;
	default:
		$respuesta = "Es un pan de Dios";
		break;
}

echo json_encode($respuesta);

});
?>