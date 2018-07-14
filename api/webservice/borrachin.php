<?php

$app->get('/obtener/borracho/:borracho', function($brc){

switch ($brc) {
	case 'modular':
		$respuesta = "no pelas un chango a nalgadas";
		break;
	case 'medina':
		$respuesta = "eres guapo y borrachales";
		break;
	case 'omar':
		$respuesta = "eres borracho cuando te da la gana";
		break;
	default:
		$respuesta = "no tomas por que eres bien puchon";
		break;
}		

echo json_encode($respuesta);
});


?>