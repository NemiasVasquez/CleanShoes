<?php
class Cliente_Controller{
    private $Cliente_Modelo;
    public function __construct(){
        session_start();
        require_once "Model/Cliente_Model.php";
        $this->Cliente_Modelo = new Cliente_Model();
    }

    public function Registrar($nombre,$apellidos,$dni,$correo,$celular,$fechaNac,$usuario,$contraseña, $rol){
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $dni = $_POST["dni"];
        $correo = $_POST["correo"];
        $celular = $_POST["celular"];
        $fechaNac= $_POST["fechaNac"];
        $usuario  = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        $rol = $_POST["rol"];
        $this->Cliente_Modelo->setCliente($nombre,$apellidos,$dni,$correo,$celular,$fechaNac,$usuario,$contraseña, $rol);

    }

}
?>