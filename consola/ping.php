<?php
include_once("conexion.php");

$ip = (isset($_GET["ip"])) ? $_GET["ip"] : '' ;

$quer0 = "SELECT * FROM centros where ip='".$ip."'";
$resul0 = mysqli_query($link,$quer0);
$ro0 = mysqli_fetch_array($resul0);
$nombrecentro = $ro0["nombre"];


$par = "ping ".$ip;

$ping = shell_exec($par);

$string = "TTL";
// echo $ping;
// echo $string;
$resp = strpos($ping, $string);
// echo "1 - ".$resp." - ";
if ($resp>0) {
	$resp = strpos($ping, $string, $resp+1);
//	 echo "2 - ".$resp." - ";
	if ($resp>0) {
		$resp = strpos($ping, $string, $resp+1);
//		 echo "3 - ".$resp." - ";
		if ($resp>0) {
			$resp = strpos($ping, $string, $resp+1);
//			 echo "4 - ".$resp." - ";
		}
	}
}
if ($resp == false) {
	$correo = 'El centro '.$nombrecentro.' ha dejado de estar en linea, por favor contacte al administrador para prestar el soporte respectivo.';
	$asunto = 'El centro '.$nombrecentro.' ha dejado de estar en linea';
	$cabeceras = 'Content-type: text/html;';
//	if (strpos($_SERVER["HTTP_HOST"],'cybercontrolevolucion')>0) {	
		mail("soluciones2000@gmail.com",$asunto,$correo,$cabeceras);
//	}
	$mensaje = 'No';
} else {
	$mensaje = 'Si';
}
echo $mensaje;
//echo $ping;
?>