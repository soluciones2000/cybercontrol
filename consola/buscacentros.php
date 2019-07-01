<?php 
header('Content-Type: application/json');
include_once("conexion.php");

$quer0 = "SELECT * FROM centros order by nombre";
if($resul0 = mysqli_query($link,$quer0)) {
	$respuesta = '';
	$cierto = true;
	$coma = '';
	$cierre = false;
	while ($ro0 = mysqli_fetch_array($resul0)) {
		if ($cierto) {
			$respuesta .= '{"centros":';
			$cierto = false;
			$cierre = true;
			$coma = '[';
		} else {
			$coma = ',';
		}
		$respuesta .= $coma.'{"id":'.trim($ro0["id"]).',"nombre":"'.trim($ro0["nombre"]).'","ip":"'.trim($ro0["ip"]).'","encendido":0}';
	}
	$respuesta .= ($cierre) ? ']' : '' ;
	$respuesta .= '}';
} else {
	$respuesta .= 'No';
}
echo $respuesta;
?>
