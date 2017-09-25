<?php 

include("database.php");
    $tempMin = $database->prepare("SELECT TemperaturaMin from Rango where Modo_Estacion=2");
    $tempMin->execute();
    $tempMax = $database->prepare("SELECT TemperaturaMax from Rango where Modo_Estacion=2");
    
    $tempMax->execute();
    
    
    $Min = $tempMin->fetchall();
    $Max = $tempMax->fetchall();
    $minimo = $Min[0][0];
    echo " <font color=  'red'>  minimo : ".$minimo."</font> ";

 ?>