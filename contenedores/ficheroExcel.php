<?php
header("Content-type: application/vnd.ms-excel; charset=utf-8; name='excel'");
header("Content-Disposition: filename=Resultado.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo utf8_decode($_POST['datos_a_enviar']); //Necesaria la funcion utf8_decode() para representar las tildes

