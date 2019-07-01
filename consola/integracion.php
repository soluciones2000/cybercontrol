<?php
/*
La estuctura del Json debe ser:
{
	"tabla": "<nombre-tabla>",
	"registro": 
	{
		"clave1": "valor1",
		"clave2": "valor2",
		"...": "...",
		...
	}
}

*/
header('Content-Type: application/json');
include_once("conexion.php");

$cJson = (isset($_GET['cJson'])) ? $_GET['cJson'] : '' ;
var_dump($_GET);
//echo $cJson;
$aRegistros = json_decode($cJson,true);
//var_dump($aRegistros["registro"]);
$Tabla = $aRegistros["tabla"];

//echo json_last_error_msg().'<br>';
$quer0 = "select * from information_schema.columns where table_schema='".$database."' and table_name='".$Tabla."'";
//echo $quer0;
$resul0 = mysqli_query($link,$quer0);

$query = "insert into ".$Tabla." (";
$campos = "";
$valores = "";
$inicio = true;
while($ro0 = mysqli_fetch_array($resul0)) {
	$indice = $ro0["COLUMN_NAME"];
	$type = $ro0["DATA_TYPE"];
	if ($type == 'varchar' || $type == 'char' || $type == 'date' || $type == 'datetime' || $type == 'timestamp' || $type == 'bit') {
		$comillas = "'";
	} else {
		$comillas = "";
	}
	if ($inicio) {
		$union = "";
		$inicio = false;
	} else {
		$union = ",";
	}
	$key = $indice;
	$value = $aRegistros["registro"][$indice];
	$campos .= $union.$key;
	$valores .= $union.$comillas.$value.$comillas;
	// $valores .= $union.$bit.$comillas.$value.$comillas;
}
$query .= $campos.") values (".$valores.")";
echo $query;
if ($result = mysqli_query($link,$query)) {
	echo 'Registro exitoso.';
} else {
	echo 'Falló el registro.<br>';
	echo mysqli_error($link);
}
?>