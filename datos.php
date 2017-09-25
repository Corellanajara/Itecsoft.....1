<?php // content="text/plain; charset=utf-8"
include("database.php");

$data = $database->prepare("SELECT Magnitud FROM Medicion where Id = 1  ORDER BY Magnitud DESC limit 7");


$data->execute();
$x = $data->fetchall();

$date = $database->prepare("SELECT dayname(Hora) FROM Medicion WHERE Id=1  ORDER BY Magnitud DESC limit 7");
$date->execute();
$y = $date->fetchall();

foreach ($x as $key => $value) {
  $Temperatura[] = $value[0];
}

foreach ($y as $key => $value) {
  $Dias[] = $value[0];
}

//print_r($Temperatura); 
echo json_encode($Temperatura);

?>

