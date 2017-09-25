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
          <p>blahblahbla</p>
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

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Configurar parametros</h3>
              </div>

              
            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">


                    <!-- Smart Wizard -->
                    
                    
                      <?php 
                      $modos=$database->prepare("SELECT * FROM Modo");
                      $modos->execute();
                      $modo = $modos->fetchall();
                      $Rangos=$database->prepare("SHOW COLUMNS FROM Rango " );
                      $Rangos->execute();
                      $Rango = $Rangos->fetchall();
                      
                      
                      $tmin = $Rango[0][0];
                      $hmin = $Rango[1][0];
                      $pmin = $Rango[2][0];

                      $tmax = $Rango[4][0];
                      $hmax = $Rango[5][0];
                      $pmax = $Rango[6][0];
                 
                       
                      
                      foreach ($modo as $key => $value) {
                        # code...                      
                        echo "
                        <div name='modos' id='modos' >
                          
                          <h3 >
                            <span class='glyphicon glyphicon-option-horizontal'></span> ".$value[0]." 
                            <span class='' >
                                              Modo ".$value[1]."<span class='glyphicon glyphicon-option-horizontal'></span>
                                              <br /> 
                                              <small >Editar Datos</small>
                                          </span>
                          </h3>
                        
                        </div>

                        ";
                        echo "
                        <br><br>
                        <br><br>
                          <div id='step-".$value[0]."'>
                        <form class='form-horizontal form-label-left' action='modo.php' method='post'>

                              <input type='number' id='modo' name='modo' hidden='true' value='".$value[0]."'>
                            <div class='item form-group'>
                              <label class='control-label col-md-3 col-sm-3 col-xs-12' for='".$tmin."'>Rangos Temperatura<span class='required'>*</span>
                              </label>
                              <div class='col-md-2 col-sm-2 col-xs-3'>
                              <input type='number' id='".$tmin."' name='".$tmin."' required='required' data-validate-minmax='0,100' class='form-control col-md-2 col-xs-3' placeholder='Minimo'>                            
                              </div>
                              
                              
                              <div class='col-md-2 col-sm-2 col-xs-3'>
                              <input type='number' id='".$tmax."' name='".$tmax."' required='required' data-validate-minmax='0,100' class='form-control col-md-2 col-xs-3' placeholder='Maximo'>                            
                              </div>
                            </div>
                            
                            <div class='item form-group'>
                              <label class='control-label col-md-3 col-sm-3 col-xs-12' for='".$pmin."'>Rangos Presion<span class='required'>*</span>
                              </label>
                              <div class='col-md-2 col-sm-2 col-xs-3'>
                              <input type='number' id='".$pmin."' name='".$pmin."' required='required' data-validate-minmax='0,100' class='form-control col-md-2 col-xs-3' placeholder='Minimo'>                            
                              </div>
                              
                              
                              <div class='col-md-2 col-sm-2 col-xs-3'>
                              <input type='number' id='".$pmax."' name='".$pmax."' required='required' data-validate-minmax='0,100' class='form-control col-md-2 col-xs-3' placeholder='Maximo'>                            
                              </div>

                                                    
<br><br>

                              <div class='item form-group'>
                              <label class='control-label col-md-3 col-sm-3 col-xs-12' for='".$hmin."'>Rangos Humedad<span class='required'>*</span>
                              </label>
                              <div class='col-md-2 col-sm-2 col-xs-3'>
                              <input type='number' id='".$hmin."' name='".$hmin."' required='required' data-validate-minmax='0,100' class='form-control col-md-2 col-xs-3' placeholder='Minimo'>                            
                              </div>
                              
                              
                              <div class='col-md-2 col-sm-2 col-xs-3'>
                              <input type='number' id='".$hmax."' name='".$hmax."' required='required' data-validate-minmax='0,100' class='form-control col-md-2 col-xs-3' placeholder='Maximo'>                            
                              </div>
                            </div>
                            
                            </div>
                                
                            <input type='submit' value='Cambiar' id='boton'>
                            <br>

                        </form>
                              "
                              ;

                              
                      }
                       ?>

                      <style>
                        #modos{
                          position:absolute;
                          top: 2%
                          right: 50%;
                          left: 25%;
                        }
                        #boton{
                          position:absolute;
                          
                          left: 60%;
                        }
                      </style>                      


<!--
                      </div>
                      <div id="step-2">
                        <h2 class="StepTitle">Step 2 Content</h2>
                        <p>
                          mensajee
                        </p>
                      </div>
                      <div id="step-3">
                        <h2 class="StepTitle">Step 3 Content</h2>
                        <p>otro mensaje</p>
                      </div>
                      <div id="step-4">
                        <h2 class="StepTitle">Step 4 Content</h2>
                        <p>mensaje</p>
                      </div>
                      <div id="step-5">
                        <h2 class="StepTitle">Step 5 Content</h2>
                        <p>mensaje</p>
                      </div>


                    </div>
                    <!-- End SmartWizard Content -->





                    
                </div>
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