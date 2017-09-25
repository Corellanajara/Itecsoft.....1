<?php 

	include("database.php");

	
		try {
			$rango=$database->prepare("INSERT into Rango (TemperaturaMin,TemperaturaMax,HumedadMin,HumedadMax,PresionMin,PresionMax,Modo_Estacion) values ('".$_POST['TemperaturaMin']."','".$_POST['temperaturaMax']."','".$_POST['HumedadMin']."','".$_POST['HumedadMax']."','".$_POST['PresionMin']."','".$_POST['PresionMax']."','".$_POST['modo']."') ");

			$rango->execute();	
		} catch (Exception $e) {
			$rango=$database->prepare("UPDATE Rango SET		TemperaturaMin='".$_POST['TemperaturaMin']."',TemperaturaMax='".$_POST['temperaturaMax']."',HumedadMin='".$_POST['HumedadMin']."',HumedadMax='".$_POST['HumedadMax']."',PresionMin='".$_POST['PresionMin']."',PresionMax='".$_POST['PresionMax']."' WHERE Modo_Estacion='".$_POST['modo']."' ");
			$rango->execute();	
		}
	
	
	include("config.php");

 ?>