<?php
session_start();
require_once("Model/Usuario.php");
require_once("Data/DataAccess.php");
require_once("Controllers/UsuariosController.php");
$id=0;
if(isset($_POST["enviar"]))
{
  unset($_SESSION['usuario']);
}
if (!isset($_SESSION['usuario']))
{
  header('Location:login.php');
}
$usuario= unserialize($_SESSION['usuario']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>usuarios</title>
<!-- INICIO LIBRERIAS-->
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
<link rel="stylesheet" href="Content/usuarios.css">
	<link rel="stylesheet" href="javascript/jquery-ui-1.10.3.custom/development-bundle/themes/start/jquery-ui.css">
	<script type="text/javascript" src="javascript/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="javascript/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
    <script language="JavaScript" type="text/javascript" src="codejscript/usuario.js"></script>
<!-- FIN LIBRERIAS-->
</head>
<body>
  <header>
     <nav>
       <ul>
           <li><a href="Views/Registrar.php">Registrar usuarios</a></li>
       </ul>
     </nav>
  </header>
  <div class='container'>
 <?php 
   if($usuario!=NULL)
   {   
       $id=serialize($usuario->id);
    echo"
        <div style='float: right;' class='card'>
          <div class='header'>
            Usuario conectado
          </div>
          <form id='frm' onsubmit='return validar()' method='post' action='index.php' >
            <div class='body'>            
                <p><strong>Usuario:</strong>  $usuario->usuario </p>
                <p><strong>Nivel:</strong>$usuario->nivel</p>
                <p><strong>alias:</strong> $usuario->alias</p>                
            </div>
            <div class='footer'>
              <button  class='button' type='submit' name ='enviar' >Cerrar sesion</button>
              <a  class='button' href='views/CambioDeContraseña.php?id=$id' >Cambiar contraseña</a>                 	
            </diV>
          </form>
        </div>";
   }
    ?>
  </div>
  <script type="text/javascript"> 	
     function validar()
     {
        permitir =false;                                   
        resp= confirm("Desea abandonar la sesion?");
        if(resp)
        {
            permitir =resp;                                   
        }
        return permitir;
     }	
  </script>
</body>
</html>
