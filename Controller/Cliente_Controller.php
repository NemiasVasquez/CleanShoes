<?php
class Cliente_Controller{
    private $Cliente_Modelo;
    public function __construct(){
        session_start();
        require_once "Model/Cliente_Model.php";
        $this->Cliente_Modelo = new Cliente_Model();
    }

    public function index(){
        /* Requiere vista del Menu General de Clean Shoes */
        $Inicio=true;
        require_once "Views/Principal.php";
    }

    public function QuienesSomos(){
        $QuienesSomos = true;
        require_once "Views/QuienesSomos.php";
    }

    public function Resultados(){
        $Resultados = true;
        require_once "Views/Resultados.php";
    }

    public function RegistrarNuevo(){
        require_once "Views/Registro.php";
    }

    public function LoginViews(){
        require_once "Views/Login.php";
    }

    public function Login(){
        $usuario = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["usuario"]);
        $contraseña = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["contraseña"]);
        $validacion = $this->Cliente_Modelo->ValidarUsuario($usuario,$contraseña);
        
        if($validacion == "NO"){
            $datos = ["mensaje"=>"Credenciales erróneas."];
        }else{
            $datos = ["mensaje"=>"Inicio de sesion exitoso."];
            $_SESSION["id_Cliente"]= $validacion[0]["id_Cliente"];
            $_SESSION["nombres"] = $validacion[0]["nombres"];
            $_SESSION["apellidos"]=$validacion[0]["apellidos"];
            $_SESSION["estado"] = $validacion[0]["estado"];
            $_SESSION["roles"] = $validacion[0]["rol"];
        }
  
        header('Content-Type: application/json');
        echo json_encode($datos);
        exit;
    }

    public function PerfilCliente(){
        $data["Cliente"]=$this->Cliente_Modelo->BuscarCliente($_SESSION["id_Cliente"]);
        require_once "Views/Perfil_Usuario_Views.php";
    }

    public function ListarClientes(){
        $data["Cliente"]=$this->Cliente_Modelo->getClientes();
        if($data["Cliente"]==false){
            $mensaje="Lista de clientes vacía.";
        }
        require_once ""; /* Vista donde se llama la lista de clientes */
    }

  

    public function Registrar(){
        $nombre = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["nombres"]);
        $apellidos = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["apellidos"]);
        $dni = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["dni"]);
        $correo = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["correo"]);
        $celular = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["celular"]);
        $contraseña = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["contraseña"]);

        $consulta_Registro = $this->Cliente_Modelo->setCliente($nombre,$apellidos,$dni,$correo,$celular,$contraseña);
        
        if($consulta_Registro == true){
            $respuesta = ["mensaje"=>"Registro completado."];
        }else{
            $respuesta = ["mensaje"=>"Error en el registro."];
        }
        
        header('Content-Type: application/json');
        echo json_encode($respuesta);
        exit;
    }

    public function DesactivarActivarCliente($id){
        $consulta = $this->Cliente_Modelo->DesactivarActivarCliente($id);
        if($consulta){
            return $mensaje ="Estado cambiado";
        }else{
            return $mensaje ="Ha ocurrido un error, estado no cambiado";
        }
    }

    public function BuscarCliente(){
        if($_POST[""]!=""){
            $id_Buscador = $_POST[""];/* Como esté definida en la Vista */
            $consulta_Buscar = $this->Cliente_Modelo->BuscarCliente($id_Buscador);
            if($consulta_Buscar ==false){
                $mensaje = "El cliente no ha sido encontrado.";
            }
            require_once ""; /* Vista donde se está llamando la búsqueda */
        }else{
            return $mensaje = "Debe ingresar un código de cliente para buscar.";
        }
    }

    public function cerrarSesion() {
        // Destruye la sesión y redirige al usuario a la página de inicio de sesión.
        session_destroy();
        header("Location: index.php?");
        exit();
    }

    public function ActualizarCliente(){
        $nombre = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["nombres"]);
        $apellidos = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["apellidos"]);
        $correo = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["correo"]);
        $usuario = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["usuario"]);
        $celular = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["celular"]);
        $contraseña = mysqli_real_escape_string($this->Cliente_Modelo->getDataBase(),$_POST["contraseña"]);

        $consulta = $this->Cliente_Modelo->ActualizarCliente($_SESSION["id_Cliente"],$nombre,$apellidos,$correo,$usuario,$celular,$contraseña);
        
        if($consulta ==true){
            $respuesta = ["mensaje"=>"Actualización completada."];
        }else{
            $respuesta = ["mensaje"=>"Error en la actualización."];
        }
        
        header('Content-Type: application/json');
        echo json_encode($respuesta);
        exit;
    }

}
?>