<?php session_start();
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
    <meta http-equiv="refresh" content="15" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title>Itecsoft | </title>

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
          <p id="p1">blahblahbla</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- /MODAL -->


  <div id='oculto' style='display:none;text-align:center;"' class='alert alert-danger alert-dismissable'  >
<strong  >ALERTA MADAFAKAAA</strong>
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
                  <li><a href="index.php"><i class="fa fa-home"></i> Pagina Principal </a></li>
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
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
                                <a data-toggle='modal' data-target='#myModal'>
                                  <span class='image'><img src='images/img.jpg' alt='Profile Image' /></span>
                                  <span class='message'>".$value[0]."</span>
                                </a>
                              </li>";
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

        <!-- /top navigation -->        
        <div class="right_col" role="main">
        
          <div class=""> 
          <br><br><br><br>
          
          <?php 
          $alertas = $database->prepare("select * from Alerta where cliente_Rut = ".$_SESSION['RUT']." ");
          $alertas->execute();
          $visto = 0;
          $alerta = $alertas->fetchall();
          foreach ($alerta as $key => $value) {
            # code...
            ?>

            <li>
                      <a href='#' onclick="mostrar('Hay Un Parametro cuyo nivel está fuera de los rango preestablecidos')" data-toggle='modal' data-target='#myModal'>                        
                    <?php   

            
            echo "<div class='content-box-blue' id='".$value[0]."'>
            <br>
                        <span class='image'><img src='https://vignette4.wikia.nocookie.net/legogames/images/c/c4/Icone_alerta.png/revision/latest?cb=20151021231536&path-prefix=es' alt='Profile Image' width='50px'/></span> 
                        <span class='message'>".$value[1]." </span> <br><br>
            
          
            </div>
  
            ";


            echo " </a> <br><br>" ;
          } 



          ?>;
          
          </div>
          
          <style>
            .content-box-blue {
            background-color: #E0F8E0;
            border: 1px solid black;
            }
            li{
              list-style: none;
            }
          </style>
          
          <script>
          function mostrar(id){
            
            
            document.getElementById("p1").innerHTML = id;
            }
          </script>
          
        <!-- page content -->
        
          </div>
        </div>
        <!-- /page content -->
        </div>


        
      

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  
  </body>
</html>