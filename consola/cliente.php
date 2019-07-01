<?php
echo '<form action="integracion.php" method="post" enctype="multipart/form-data">';
$aJson = array( tabla => 'usuario', registro =>
	array( 
		id => "1", 
		sesion => "1", 
		tipo => "AAA", 
		usuario => "AAA", 
		referencia => "AAA", 
		clave => "AAA", 
		pregunta => "AAA", 
		respuesta => "AAA", 
		nombre => "AAA", 
		apellido => "AAA", 
		direccion => "AAA", 
		fechaNacimiento => "2018-04-04", 
		datos => "AAA", 
		acumulado => "2", 
		operador => "AAA", 
		centro => "AAA", 
		fechaRegistro => "2018-04-04", 
		fechaModificacion => "2018-04-04"
	)
);
$cJson = json_encode($aJson);
echo $cJson;
echo '<input type="hidden" name="cJson" value='.$cJson.'>';
echo '<input type="submit" name="" value="enviar">';
echo '</form>';
?>