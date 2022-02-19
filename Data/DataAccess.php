<?php
class DataAcccess
{ 	private $con,$host,$user,$pwd,$db,$result;
	public function __construct()
	{
		$this->host='localhost';
		$this ->user="root";
		$this->pwd="";
		$this->db="login";
	}
	private function CerrarConexion()
	{
		mysqli_free_result($this-> result);
		mysqli_close($this->con);
	}

	private function AbrirConexion()	
	{
		$this->con=mysqli_connect($this->host,$this->user,$this->pwd,$this->db) or die ($this-> mensaje(mysqli_error($this->con)));
	}
	public function mensaje($msg)
	{
		$style="    margin: 0 auto;  
		width: 50%;
	  background-color: red;
	  text-align: center;
	  color:white;
	  text-align: center;
	  font-weight: bold;
	  font-size: 20px;
	  padding: 20px;";
	  return "<div style='$style'>$msg</div>";

	}
	public function Login($usuario,$pwd)
	{  			
		$this->AbrirConexion();
		$consulta="select id from usuario where  usuario= '$usuario' and contraseña='$pwd'";		
		$this->result=mysqli_query($this->con,$consulta) or die ( $this-> mensaje(mysqli_error($this->con)));
		$num =mysqli_num_rows($this->result);		
		$id=0;
		if( $num!=0)
		{					
			while ($fila =mysqli_fetch_array($this->result, MYSQLI_ASSOC))
			{
                $id= $fila["id"];			
			}			
		}
		$this->CerrarConexion();
		return $id;
	}
	public function BuscarUsuarios($id,$usuario)
	{		
		$this->AbrirConexion();
		$consulta="select * from usuario where id=$id or usuario='$usuario'";	
		$this-> result=mysqli_query($this->con,$consulta) or die ($this-> mensaje(mysqli_error($this->con)));
		$num =mysqli_num_rows($this-> result);
		$usuario =NULL;
		if( $num!=0)
		{
			$usuario=new Usuario();			
			while ($fila =mysqli_fetch_array($this-> result, MYSQLI_ASSOC))
			{
                $usuario->id=$fila["id"];
				$usuario->nivel=$fila["nivel"];
				$usuario->usuario=$fila["usuario"];
				$usuario->contraseña=$fila["contraseña"];
				$usuario->alias=$fila["alias"];  
			}
		}
		$this->CerrarConexion();	
		return $usuario;
	}
    public function  InsertarUsuario($usuario,$nivel,$contraseña,$alias)
    {
        $this->AbrirConexion();
        $consulta ="insert into usuario (usuario ,contraseña ,nivel ,alias) values('$usuario',
        '$contraseña',$nivel,'$alias')";
        $this->result=mysqli_query($this->con,$consulta) or die ( $this-> mensaje(mysqli_error($this->con)));
        mysqli_close($this->con);      


    }
	public function cambiarContraseña($usuario,$contraseña)
	{
		$this->AbrirConexion();
		$consulta="update usuario set contraseña='$contraseña' where usuario ='$usuario'";
		$this->result=mysqli_query($this->con,$consulta) or die ( $this-> mensaje(mysqli_error($this->con)));
        mysqli_close($this->con);      
	}

}
?>