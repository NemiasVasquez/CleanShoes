<?php
class Trabajador_Controller{
    private $Trabajador_Modelo;

    public function __construct(){
        session_start();
        require_once "Model/Trabajador_Model.php";
        $this->Trabajador_Modelo = new Trabajador_Model();
    }

    public function ListarTrabajadores(){
        $data["Trabajador"]=$this->Trabajador_Modelo->getTrabajadores();
        if($data["Trabajador"]==false){
            $mensaje="Lista de Trabajadors vacía.";
        }
        require_once "";
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
        if($this->Trabajador_Modelo->ValidarDNI($dni)){
            $Mensaje = "Debe ingresar un DNI NUEVO";
        }
        if($mensaje!=""){
            /* Debe estar un Require_One para llamar al formulario y pasar el mensaje de alerta */
            require_once "";
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

            $consulta_Registro = $this->Trabajador_Modelo->setTrabajador($nombre,$apellidos,$dni,$correo,$celular,$fechaNac,$usuario,$contraseña, $rol);
            
            if($consulta_Registro){
                $mensaje="Registro exitoso.";
                /* Require_once Registrar */
            }else{
                $mensaje="No se ha logrado registrar el Trabajador.";
                /* Require_once Registrar */
            }
        }
    }

    public function DesactivarActivarTrabajador($id){
        $consulta = $this->Trabajador_Modelo->DesactivarActivarTrabajador($id);
        if($consulta){
            return $mensaje ="Estado cambiado";
        }else{
            return $mensaje ="Ha ocurrido un error, estado no cambiado";
        }
    }

    public function BuscarTrabajador(){
        if($_POST[""]!=""){
            $id_Buscador = $_POST[""];/* Como esté definida en la Vista */
            $consulta_Buscar = $this->Trabajador_Modelo->BuscarTrabajador($id_Buscador);
            if($consulta_Buscar ==false){
                $mensaje = "El Trabajador no ha sido encontrado.";
            }
            require_once ""; /* Vista donde se está llamando la búsqueda */
        }else{
            return $mensaje = "Debe ingresar un código de Trabajador para buscar.";
        }
    }

}
?>