<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Closing and Approval of Sales - SpartaX</title>
    <link rel="shortcut icon" href="<?php echo RUTA_HTTP; ?>/assets/dist/img/icono.png"> 
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/fonts/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/dist/css/skins/_all-skins.css">
    <?php if ((time()-$_SESSION["Tiempo"])>28800) { ?>
      <script>

          setInterval(() => {
          
            $('#myModal').modal({show:true}); 
            console.log(new Date().toLocaleTimeString());




          
 
 
          }, 60000); // 8 horas
 
      </script>


 
     <?php } ?>
      

    
     
 

       <!-- jQuery 2.1.4 -->
    <script src="<?php echo RUTA_HTTP; ?>/assets/plugins/jQuery/jquery-1.12.0.min.js"></script>
  <!-- datatables -->
    <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/plugins/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/plugins/datatables/extensions/FixedColumns/css/dataTables.fixedColumns.min.css">

    <!-- highcharts -->
  
    <script src="<?php echo RUTA_HTTP; ?>/assets/plugins/highcharts/js/highcharts.js"></script>
    <script src="<?php echo RUTA_HTTP; ?>/assets/plugins/highcharts/js/highcharts-more.js"></script>
    <script src="<?php echo RUTA_HTTP; ?>/assets/plugins/highcharts/js/modules/data.js"></script>
    <script src="<?php echo RUTA_HTTP; ?>/assets/plugins/highcharts/js/modules/exporting.js"></script>
    <!-- bootstrap validator -->
    <script src="<?php echo RUTA_HTTP; ?>/assets/bootstrap/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="<?php echo RUTA_HTTP; ?>/assets/bootstrap/js/bootstrapv.min.js" type="text/javascript"></script>

    <!-- app -->
    <script src="<?php echo RUTA_HTTP; ?>/assets/js/app.js"></script>
    <!-- tabletojson -->
    <script src="<?php echo RUTA_HTTP; ?>/assets/dist/js/jquery.tabletojson.min.js"></script>
    <script src="<?php echo RUTA_HTTP; ?>/assets/dist/js/bootbox.min.js" type="text/javascript"></script>
    <!-- jquery-ui-timepicker -->
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo RUTA_HTTP; ?>/assets/plugins/jQuery-Timepicker/css/jquery-ui.css" />
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo RUTA_HTTP; ?>/assets/plugins/jQuery-Timepicker/css/jquery-ui-timepicker-addon.css" />

    <!-- style Sistema -->
     <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/css/style.css">

   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
  </head>
 <?php 
  $UsuarioSession = new UsuarioController();
  $info_Persona=$UsuarioSession->Consultar_informacion_usuario($_SESSION['Usuario_Actual']);
  
 ?>
  <body class="hold-transition skin-red sidebar-mini sidebar-collapse">

      <!-- Modal iniio-->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal contenido-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1 class="modal-title">¿Desea seguir conectado?</h1>
                </div>
                <div class="modal-body">

                  <div class="form-group has-feedback text-center"  >
                    <button type="submit" name="idEntrar" id="idEntrar" class="btn btn-success" name="btn-ingresar" data-dismiss="modal" ><b><i class="fa fa-refresh fa-spin fa-3x fa-fw" aria-hidden="true"></i> <h3>Seguir Conectado</h3></b></button>
                    <button type="submit" name="idSalir" id="idSalir" class="btn btn-danger" name="btn-salir" style="width:120px" ><b><i class="fa fa-sign-out fa-3x fa-fw" aria-hidden="true"></i> <h3>Salir</h3></b></button>
                  </div>
        
                </div>
                
            </div>
          </div>
        </div>
     <!-- Modal Fin-->


    <div class="wrapper">
 
      <header class="main-header">
 
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">CSA <b>SpartaX</b></span>


         
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CSA</b> SpartaX</span>
        </a>
       
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu" style="display:none;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo RUTA_HTTP; ?>/assets/dist/img/logo.png" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                      
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu" style="display:none;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>                      
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu" style="display:none;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->                      
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo RUTA_HTTP; ?>/assets/dist/img/user-<?php echo $info_Persona['sexo']; ?>.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $info_Persona['primer_nombre'].' '.$info_Persona['apellido_paterno'].' '.$info_Persona['apellido_materno'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo RUTA_HTTP; ?>/assets/dist/img/user-<?php echo $info_Persona['sexo']; ?>.png" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $info_Persona['primer_nombre'].' '.$info_Persona['apellido_paterno'].' '.$info_Persona['apellido_materno'] ?>
                      <small><?php echo $info_Persona['perfil']; ?></small>                     
                      
                    </p>
                  </li>
                  <!-- Menu Body -->
                
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="index.php?c=Usuario&a=CerrarSesion" class="btn btn-default btn-flat"> <b><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión </b></a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
              
              </li>
            </ul>
          </div>

        </nav>



      </header>      
    <?php include('sidebar.php'); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

     
        <script> 
            $('#idSalir').on('click',function(){
        
                $.ajax({ 
                    type: "GET",
                    url: 'index.php?c=Usuario&a=CerrarSesion'  
                });
                $.ajax({ 
                    type: "GET",
                    url: 'index.php'  
                });
                location.reload(true);
                
            });
            $('#idEntrar').on('click',function(){
            
              
                $.ajax({ 
                      type: "GET",
                      url: 'index.php?c=Usuario&a=ContinuarSesion'  
                  });

                location.reload(true);    
           });


       /*   window.addEventListener("beforeunload", function (e) {
          var confirmationMessage = "\o/";

          (e || window.event).returnValue = confirmationMessage; //Gecko + IE
          return confirmationMessage;                            //Webkit, Safari, Chrome
          });

*/



        </script>

     