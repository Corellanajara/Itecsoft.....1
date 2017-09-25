<?php
  
  date_default_timezone_set("America/Chile");
  if($_SESSION['autorizado']!=1){
    header("Location: login.html");
  }
?>