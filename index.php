<?php session_start();
if(!isset($_SESSION['MAIL'])){
  include("login.html");
  exit;
}
  error_reporting(0);
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include("database.php");
     ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title>Itecsoft | </title>
    
    <link rel="stylesheet" href="css/default.css">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body class="nav-md">


<!-- Modal -->


  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ALERTA/NOTIFICACION</h4>
        </div>
        <div class="modal-body">
          
          <p id="p1">hola</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- /MODAL -->


  <div id='oculto' style='display:none;text-align:center;"' class='alert alert-danger alert-dismissable'  >
<strong  >ALERTA , ALGO ESTÁ MAL </strong>
</div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-cubes"></i> <span>    Itecsoft!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">

                <span><?php

                echo"Bienvenido";
                ?>
                <h2><?php                
                echo $_SESSION['NAME'];
                ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php">  <i class="fa fa-home"></i> Pagina Principal </a></li>
                  <li><a><i class="fa fa-file-archive-o"></i> Reportes </a></li>
                  <li><a href="mapa.php"><i class="fa fa-map-marker"></i> Mapa </a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings" href="config.php">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="cerrar.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>


        <!-- top navigation 2-->
        <?php               
              $alertas = $database->prepare("Select count(*) from Alerta where Cliente_Rut = '".$_SESSION['RUT']."' and Visto = 0");
              $alertas->execute();
              $cant = $alertas->fetchall();
              $cantidad = $cant[0][0];
              $alertas = $database->prepare("Select Descripcion,Visto  from Alerta where Cliente_Rut = '".$_SESSION['RUT']."'");
              $alertas->execute();
              $cant = $alertas->fetchall();
                         
         ?>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $_SESSION['NAME'] ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
          
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>

                </li>

                

                                  
                  
              
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green"><?php echo $cantidad ?></span>
                  </a>
                  
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <?php 

                    foreach ($cant as $key => $value) {
                      # code...
                      if($value[1]==0){
                      echo " <li>
                                <a data-toggle='modal' data-target='#myModal' onclick='cambiar(".$key.")'>
                                  <span class='image'><img src='images/img.jpg' alt='Profile Image' /></span>
                                  <span class='message'>".$value[0]."</span>
                                </a>
                              </li>";
                              $_SESSION["a".$key] = $value[0];
                      }
                    }

                   ?>
                  
                    <li>
                      <div class="text-center">
                        <a href="alertas.php">
                          <strong>Ver todas las alertas</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->



        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->

          <script type="text/javascript">
          function mostrar(){
          document.getElementById('oculto').style.display = 'block';}

<?php echo "
        function cambiar(x){
          ";                    
          
          
          echo "
          document.getElementById('p1').innerHTML = '".$_SESSION["a1"]."';
        }

"; 

?>
          
          </script>
          <!-- /top tiles -->

<br><br><br>
      



            <div class="chart-container">
                <div>
                  <canvas id="line-chartcanvas"></canvas>
                </div>
                
              </div>

              <!-- javascript -->
                
                <script src="js/Chart.min.js"></script>

                <script src="js/jquery.min.js"></script>
                <script src="js/linea.js"></script>



          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2> Variables actuales</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">


                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4> Mas nuevos</h4>
                  <div class="widget_summary">

                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Presion</span>
                    </div>

                    <div class="w_right w_20">
                      <span>
                        <?php
                        $Presion = $database->prepare(" SELECT Magnitud FROM Medicion WHERE Id=2" );
                        $Presion->execute();
                        $unidad = $database->prepare("SELECT Unidad from Medicion where Id=2");
                        $unidad->execute();
                        $contador = $database->prepare("SELECT count(*) from Medicion where Id=2");
                        $PreMin = $database->prepare("SELECT PresionMin from Rango where Modo_Estacion='".$_SESSION['MODE']."'  ");                      
                        $PreMax = $database->prepare("SELECT PresionMax from Rango where Modo_Estacion='".$_SESSION['MODE']."'");
                        $PreMin->execute();
                        $PreMax->execute();
                        $contador->execute();
                        $temp = $unidad->fetchall();
                        $valor = $Presion->fetchall();
                        $con = $contador->fetchall();
                        $Min = $PreMin->fetchall();
                        $Max = $PreMax->fetchall();
                        $i = $con[0][0];
                        $Minimo = $Min[0][0];
                        $Maximo = $Max[0][0];
                        $resultado =$valor[$i-1][0];

                    //    $contar = $i->fetchall();

                        if($resultado<$Minimo||$resultado>$Maximo){
                          
                          echo "<span class='badge bg-red'>".$resultado." ".$temp[$i-1][0]."</span>";
                          echo "<script>";
                          echo "mostrar();";
                          echo "</script>";

                          if($_SESSION['FLAG']==0){                     
                          $alerta = $database->prepare("insert into Alerta (Descripcion,Visto,Cliente_Rut) values (?,?,?)");
                          $alerta->execute(array('La Presion esta en un nivel fuera de los rangos',0,$_SESSION['RUT']));
                          }
                         

                        }else{
                          echo "<span class='badge bg-green'>".$resultado." ".$temp[$i-1][0]."</span>";

                        }
                        

                       ?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Temperatura</span>
                    </div>

                    <div class="w_right w_20">
                      <span>
                        <?php
                        $Temperatura = $database->prepare(" SELECT Magnitud FROM Medicion WHERE Id=1" );
                        $Temperatura->execute();
                        $unidad = $database->prepare("SELECT Unidad from Medicion where Id=1");
                        $unidad->execute();
                        $contador = $database->prepare("SELECT count(*) from Medicion where Id=1");
                        $tempMin = $database->prepare("SELECT TemperaturaMin from Rango where Modo_Estacion='".$_SESSION['MODE']."'");
                        $tempMin->execute();
                        $tempMax = $database->prepare("SELECT TemperaturaMax from Rango where Modo_Estacion='".$_SESSION['MODE']."'");
                        
                        $tempMax->execute();
                        $contador->execute();
                        $temp = $unidad->fetchall();
                        $valor = $Temperatura->fetchall();
                        $con = $contador->fetchall();
                        $Min = $tempMin->fetchall();
                        $Max = $tempMax->fetchall();
                        $i = $con[0][0];
                        $Minimo = $Min[0][0];
                        $Maximo = $Max[0][0];
                        $resultado =$valor[$i-1][0];

                    //    $contar = $i->fetchall();

                        if($resultado<$Minimo||$resultado>$Maximo){
                          
                          echo "<span class='badge bg-red'>".$resultado." ".$temp[$i-1][0]."</span>";
                          echo "<script>";
                          echo "mostrar();";
                          echo "</script>";

                          if($_SESSION['FLAG']==0){
                          $alerta = $database->prepare("insert into Alerta (Descripcion,Visto,Cliente_Rut) values (?,?,?)");
                          $alerta->execute(array('La Temperatura esta en un nivel fuera de los rangos',0,$_SESSION['RUT']));
                          }
                          
                        }else{
                          echo "<span class='badge bg-green'>".$resultado." ".$temp[$i-1][0]."</span>";

                        }
                        

                       ?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Humedad</span>
                    </div>

                    <div class="w_right w_20">
                      <span>
                        <?php
                        $Humedad = $database->prepare(" SELECT Magnitud FROM Medicion WHERE Id=3" );
                        $Humedad->execute();
                        $unidad = $database->prepare("SELECT Unidad from Medicion where Id=3");
                        $unidad->execute();
                        $contador = $database->prepare("SELECT count(*) from Medicion where Id=3");
                        $HumMin = $database->prepare("SELECT HumedadMin from Rango where Modo_Estacion='".$_SESSION['MODE']."'");
                        $HumMin->execute();
                        $HumMax = $database->prepare("SELECT HumedadMax from Rango where Modo_Estacion='".$_SESSION['MODE']."'");
                        
                        $HumMax->execute();
                        $contador->execute();
                        $temp = $unidad->fetchall();
                        $valor = $Humedad->fetchall();
                        $con = $contador->fetchall();
                        $Min = $HumMin->fetchall();
                        $Max = $HumMax->fetchall();
                        $i = $con[0][0];
                        $Minimo = $Min[0][0];
                        $Maximo = $Max[0][0];
                        $resultado =$valor[$i-1][0];

                    //    $contar = $i->fetchall();

                        if($resultado<$Minimo||$resultado>$Maximo){
                          
                          echo "<span class='badge bg-red'>".$resultado." ".$temp[$i-1][0]."</span>";
                          echo "<script>";
                          echo "mostrar();";
                          echo "</script>";

                          if($_SESSION['FLAG']==0){
                          $alerta = $database->prepare("insert into Alerta (Descripcion,Visto,Cliente_Rut) values (?,?,?)");
                          $alerta->execute(array('La Humedad esta en un nivel fuera de los rangos',0,$_SESSION['RUT']));
                          }
                          
                        }else{
                          echo "<span class='badge bg-green'>".$resultado." ".$temp[$i-1][0]."</span>";

                        }
                        

                       ?>
                      </span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-3 col-xs-12 widget widget_tally_box">
                        <div class="x_panel fixed_height_390">
                          <div class="x_title">
                            <h2>Uso de quimicos</h2>
                            <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>

                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                              </li>
                            </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">

                            <div style="text-align: center; margin-bottom: 17px">
                              <ul class="verticle_bars list-inline">
                                <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-dark" role="progressbar" data-transitiongoal="65"></div>
                                  </div>
                                </li>
                                <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-gray" role="progressbar" data-transitiongoal="85"></div>
                                  </div>
                                </li>
                                <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="45"></div>
                                  </div>
                                </li>
                                <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="75"></div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <div class="divider"></div>

                            <ul class="legend list-unstyled">
                              <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square dark"></i></span> <span class="name">Quimico uno</span>
                                </p>
                              </li>
                              <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square grey"></i></span> <span class="name">Sustancia dos</span>
                                </p>
                              </li>
                              <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square blue"></i></span> <span class="name">Quimico tres</span>
                                </p>
                              </li>
                              <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square green"></i></span> <span class="name">Quimico cuatro</span>
                                </p>
                              </li>
                            </ul>

                          </div>
                        </div>
                      </div>



            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Uso del Agua</h2>

                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>5 principales</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Destino</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Cantidad</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Sector 2 </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Sector 1 </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Regadio </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Sector 5 </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Otro </p>
                            </td>
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>





            <div class="col-md-8 col-sm-8 col-xs-12">



              
              <div class="row">




              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js">  </script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>
