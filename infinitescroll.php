<?php
header("Content-Type: text/html; charset=UTF-8");
$mysqli = @new mysqli("localhost", "root", "", "CatBank");


if ($mysqli->connect_errno) {
 
    die();
}


$inicio = $_POST["inicia"];
$cuanto = $_POST["cuantos"];


$cadena = "SELECT Descripcion FROM Alerta ORDER BY Id ASC LIMIT $inicio, $cuanto";

$resultado = $mysqli->query($cadena);

while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {

$img = $row["Descripcion"];

echo <<< RESPUESTA
<div><img src="$img" alt="" /></div>\n
RESPUESTA;

}

$resultado->free();
$mysqli->close();
?>