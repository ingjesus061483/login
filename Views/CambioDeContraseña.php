<?php
session_start();
$titulo="";
require_once("../Model/Usuario.php");
require_once("../Data/DataAccess.php");
require_once("../Controllers/UsuariosController.php");
if (!isset($_SESSION['usuario']))
{
  header('Location:../login.php');
}
$id=0;

if(isset($_GET["id"]))
{
    $id=unserialize( $_GET["id"]);
}

$usuariocnt=new UsuariosController();
$usuario=$usuariocnt->CambiarContraseñaGet($id);
$msg="";
$tipo=0;
if (isset($_POST["Registrar"]))
{
    $id=$_POST["id"];     
    $oldpwd=$_POST["oldpwd"]; 
    $newpwd=$_POST["newpwd"];     
    $usuariocnt->CambiarContraseñaPost($id,$oldpwd,$newpwd,$tipo,$msg);    
    $id=0;
}
echo"<input type='hidden' id='msg' value ='$msg'>";
echo"<input type='hidden' id='tipo' value ='$tipo'>";
echo"<input type='hidden' id='id' value ='$id'>";
?>
<!doctype html>
<!-- Representa la raíz de un documento HTML o XHTML. Todos los demás elementos deben ser descendientes de este elemento. -->
<html lang="es">    
    <head>
        
        <meta charset="utf-8">
        
        <title> Formulario de Acceso </title>    
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="author" content="Videojuegos & Desarrollo">
        <meta name="description" content="Muestra de un formulario de acceso en HTML y CSS">
        <meta name="keywords" content="Formulario Acceso, Formulario de LogIn">
        
        <link rel="stylesheet" href="../alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="../alertifyjs/css/alertify.min.css">
    <link rel="stylesheet" href="../alertifyjs/css/alertify.rtl.css">
    <link rel="stylesheet" href="../alertifyjs/css/alertify.rtl.min.css">
    <script type="text/javascript" src="../alertifyjs/alertify.js"></script>
    <script type="text/javascript" src="../alertifyjs/alertify.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
        
        <!-- Link hacia el archivo de estilos css -->
        <link rel="stylesheet" href="../Content/login.css">
        
        <style type="text/css">
            
        </style>
        
        <script type="text/javascript">
        
        </script>
        
    </head>
    
    <body>        
        <div id="contenedor">
            <div id="central">
                <div id="login">
                    <div class="titulo">
                        Cambiar contraseña
                    </div>
                    <form id="loginform" action="CambioDeContraseña.php" method="post" onsubmit="return validacion();" >
                        <input type="hidden" name="id" value="<?php if($id!=0){echo  $id;}   ?>">
                        <input id="user" disabled="disebled" type="text" value="<?php if($id!=0){echo  $usuario->usuario;}   ?>" 
                        name="usuario" placeholder="Usuario" required>
                        <input id="oldpwd" type="password" name="oldpwd" placeholder="Vieja contraseña" required>                    
                        <input id="pwd" type="password" placeholder="Nueva Contraseña" name="newpwd" required>
                        
                        <button type="submit" title="Registrar" name="Registrar">Registrar</button>
                    </form>
                </div>
                <div class="inferior">
                    <a href="../index.php">Volver</a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
 	 var msg=document.getElementById('msg');
     var tipo=document.getElementById('tipo');
     var id=document.getElementById('id');
		if(tipo.value==1)
		{
            alertify.success(msg.value);			            
		}
        if(tipo.value==2)
        {
            alertify.error(msg.value);
        }    
        setTimeout(function(){
            if (id.value ==0)
            {
                window.location.href="../index.php";
            }

        }, 5000);
            

       // if(id.value!=0)
        //{
          //  setTimeout(function() {window.location.href="Index.php";}, 5000);
        //}
		function validacion()
		{
			frm=document.getElementById('loginform');
			user=document.getElementById('user');
			pwd=document.getElementById('pwd');
            if(user.value=="")
			{
				alertify.error("Campo invalido");
				return false;			
			}
            if(pwd.value=="")
            {
                alertify.error("Campo invalido");
                return false ;
            }
            frm.submit();

        }  
        </script>   
    </body>
</html>