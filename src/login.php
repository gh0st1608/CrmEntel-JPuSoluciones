<?php
require_once 'controller/usuario.controller.php';

$usuario = new UsuarioController();
$resultado="";




//verificar si ya se ha iniciado sesion anteriormente
if($usuario->Verificar_InicioSesion()==TRUE)
{
  $usuario->redirect('index.php');

}else{
  // verificar si se ha presionado el boton submit del formulario.
  if(isset($_POST['btn-ingresar']))
  {
    //almacenamos los datos enviados del formulario;
    $Login = $_POST['Usuario'];
    $Password = $_POST['Password'];

    $estado_usuario =  $usuario->Iniciar_Sesion($Login,$Password);
    //verificar si existe el usuario y la contraseña
 
    if ($_SESSION['Estado_usuario'] == 1 )
    { 
  
      //si existe redireccionar al index.php
      $usuario->redirect('index.php');  
    } 
    elseif($_SESSION['Estado_usuario'] == 2)
    {
      
       //si no existe mostrar el siguiente mensaje   
       $resultado = "Usuario Bloqueado";
    }
    else{
      $resultado = "Usuario o Contraseña Incorrecta";
    }
  }  
}
   
 

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iniciar Sesión</title>
    <link rel="shortcut icon" href="assets/dist/img/icono.png"> 
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">        
        <img src="assets/dist/img/logo.svg" alt="" style="width: 220px;">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingresa tus datos</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="Usuario" placeholder="Usuario">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="Password" placeholder="Contraseña">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="" class="text-danger"><?php echo $resultado; ?></label>
          </div>
        <?php if ($_SESSION['intentoSesion'] == 3  ) { 
                $_SESSION['intentoSesion'] = 0           ?>
          <div class="row" >
            <div class="col-md-12">
            <p class="openBtn2" style="text-align: right;"><a href="#">Recuperar Contraseña</a></p>
            </div>
          </div>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            <!-- Modal contenido-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Recuperar Contraseña</h4>
                </div>
                <div class="modal-body">
                <div class="form-group has-feedback">
                  <label>Ingresa Correo</label>
                  <input type="email" class="form-control" name="Correo" id="Correo"  placeholder="Ingresar Correo" required>
                  <span id="error" style="display:none;color:red;">Correo no válido</span>
                  <span id="success" style="display:none;color:green;">Correo válido</span>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <button type="submit" name="EnviarMail" id="EnviarMail" class="btn btn-default btn-block btn-flat" name="btn-ingresar"><b><i class="fa fa-envelope-o" aria-hidden="true"></i> Enviar Mail de Recuperación</b></button>
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" name="Regresar" id="Regresar" class="btn btn-default" data-dismiss="modal">Regresar</button>
                </div>
            </div>
            </div>
          </div>
          <?php }  ?>

          <div class="row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-default btn-block btn-flat" name="btn-ingresar"><b><i class="fa fa-sign-in" aria-hidden="true"></i> Iniciar Sesión</b></button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   
    <script>
        /* Llamando al fichero CargarContenido.php */
        $('.openBtn2').on('click',function(){
            $('.modal-body').load('RecuperarContraseña.php',function(){
                $('#myModal').modal({show:true});
            });
        });
    
      $('#Correo').on('keyup', function() {
          var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
          var buttonDisabled = $('#Correo').val().length == 0 ;
          if(!re) {
              $('#error').show();
              $('#success').hide();
          } else {
              $('#error').hide();
              $('#success').show();
              $('#EnviarMail').attr("disabled", buttonDisabled);
          }
      })

      $('#EnviarMail').on('click',function(){
          var parametro= "Correo="+$("#Correo").val();
          $.ajax({
              data: parametro,
              type: "POST",
              url: 'index.php?c=Usuario&a=v_RecuperarClave',
              //sync:false,        
              success: function(data) {
                alert(data);
              },
          });
      }
	

    </script>
  </body>
</html>
