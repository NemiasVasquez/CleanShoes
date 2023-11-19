<?php
class Cliente_Controller{
    private $Cliente_Modelo;
    public function __construct(){
        session_start();
        require_once "Model/Cliente_Model.php";
        $this->Cliente_Modelo = new Cliente_Model();
    }

    public function ValidarRegistro($nombre,$apellidos,$dni,$celular,$fechaNac,$usuario,$contraseña, $rol){
        if($nombre==""){
            return $mensaje="Debe ingresar un nombre"; 
        }
        if($apellidos==""){
            return $mensaje ="Debe ingresar los apellidos";
        }
        if(strlen($dni)!=8){
            return $mensaje= "Debe  ingresar un DNI válido";
        }
        if(strlen($celular)!=9){
            return $mensaje ="Debe ingresar un número de celular válido";
        }
        if($fechaNac == ""){
            return $mensaje ="Debe ingresar una fecha de nacimiento";
        }
        if($usuario ==""){
            return $mensaje ="Debe ingresar un usuario";
        }
        if($contraseña==""){
            return $mensaje ="Debe ingresar una contraseña.";
        }else{
            if(strlen($contraseña)<8){
                return $mensaje ="Debe ser mayor a 8 caracteres";
            }else{
                if(!preg_match('/\d/',$contraseña)){
                    return $mensaje="Debe tener almenos un número";
                }
            }
        }
        if($rol =="NA"){
            return $mensaje="Debe seleccionar un roll.";
        }
        return $mensaje="";
    }

    public function Registrar($nombre,$apellidos,$dni,$correo,$celular,$fechaNac,$usuario,$contraseña, $rol){
        $mensaje=$this->ValidarRegistro($nombre,$apellidos,$dni,$celular,$fechaNac,$usuario,$contraseña, $rol);
        if($mensaje!=""){
            /* Debe estar un Require_One para llamar al formulario y pasar el mensaje de alerta */

        }else{
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $dni = $_POST["dni"];
            $correo = $_POST["correo"];
            $celular = $_POST["celular"];
            $fechaNac= $_POST["fechaNac"];
            $usuario  = $_POST["usuario"];
            $contraseña = $_POST["contraseña"];
            $rol = $_POST["rol"];

            $consulta_Registro = $this->Cliente_Modelo->setCliente($nombre,$apellidos,$dni,$correo,$celular,$fechaNac,$usuario,$contraseña, $rol);
            
            if($consulta_Registro){
                $mensaje="Registro exitoso.";
                /* Require_once Registrar */
            }else{
                $mensaje="No se ha logrado registrar el cliente.";
                /* Require_once Registrar */
            }
        }
    }

}
?>