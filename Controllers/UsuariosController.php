<?php
class UsuariosController
{
  private $data;
  public function __construct()    
  {
    $this->data=new DataAcccess();
  }
    public function CrearPost($usuario,$nivel,$contraseña,$alias,&$tipo,&$msg)
    {
      $usuario =$this->data->BuscarUsuarios(0,$usuario);
      $msg="";
      $tipo =0;
      if($usuario==null)
      {
        $this->data->InsertarUsuario($usuario,$nivel,md5($contraseña),$alias);
        $tipo=1;
        $msg="El usuario se ha registrado correctamente";
      }
      else{
        $tipo=2;
        $msg="El usuario ya se encuentra registrado";
      }
    }
    public function login($usuario,$contraseña,&$tipo,&$msg)
    {
        $id=$this->data->login($usuario,md5($contraseña));
        $msg="";
        if($id==0)
        {
          $msg="Usuario o contraseña invalido";
          $tipo=2;
        }
        else
        {
          $usuario=$this-> data-> BuscarUsuarios($id,'');  
          $_SESSION["usuario"]=serialize($usuario) ;                            
        }
    }
    public function CambiarContraseñaGet ($id)    
    {
      $usuario=$this->data->BuscarUsuarios($id,'');
      return $usuario;
    }
    public function CambiarContraseñaPost ($id,$viejacontraseña,$NuevaContraseña,&$tipo,&$msg)
    {
        $usuario =$this->data->BuscarUsuarios($id,"");
        $msg="";
        $tipo =0;
        if($usuario!=null)
        {
            $oldpwd=$usuario->contraseña;
            if($oldpwd== md5($viejacontraseña))
            {
              $this->data->cambiarContraseña($usuario->usuario,md5( $NuevaContraseña));
              $tipo=1;
              $msg="la contraseña ha sido cambiada con exito";
            }
            else
            {
              $tipo=2;
              $msg="las contraseñas no coinciden";


            }
        }
        else
        {
            $msg="El usuario no existe";
            $tipo =2;
        }
    }
}
