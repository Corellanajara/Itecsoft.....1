<?php

   require('db_config.php');
   echo $_GET['last_id'];
   $sql = "SELECT * FROM Alerta WHERE id < '".$_GET['last_id']."' ORDER BY id DESC LIMIT 8"; 

   $result = $mysqli->query($sql);

   $json = include('data.php');

   echo json_encode($json);
?>