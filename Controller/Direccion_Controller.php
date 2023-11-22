<?php
class Direccion_Controller{
    private $Direccion_Modelo;
    public function __construct(){
        session_start();
        require_once "Model/Direccion_Model.php";
        $this->Direccion_Modelo = new Direccion_Model();
    }

    public function ValidarRegistro($departamento,$provincia,$distrito,$direccion,$referencia){
        if($departamento==""){
            return $mensaje="Debe seleccionar un departamento."; 
        }
        if($provincia==""){
            return $mensaje ="Debe ingresar la provincia.";
        }
        if($distrito==""){
            return $mensaje= "Debe  ingresar un distrito.";
        }
        if($direccion==""){
            return $mensaje ="Debe ingresar una dirección.";
        }
        if($referencia == ""){
            return $mensaje ="Debe ingresar una referencia a la dirección.";
        }
       
        return $mensaje="";
    }

    public function Registrar($id_cliente){
        $mensaje = $this->ValidarRegistro($_POST["departamento"],$_POST["provincia"], $_POST["distrito"],$_POST["direccion"],$_POST["referencia"]);
        if($mensaje != ""){
            $departamento = $_POST["departamento"];
            $provincia = $_POST["provincia"];
            $distrito = $_POST["distrito"];
            $direccion = $_POST["direccion"];
            $referencia = $_POST["referencia"];

            $consulta = $this->Direccion_Modelo->setDireccion($id_cliente,$departamento,$provincia,$distrito,$direccion,$referencia); 
            if($consulta != false){
                $mensaje ="Registro exitoso.";
            }else{
                $mensaje ="Ha ocurrido un error en el registro.";
            }
        }
        require_once ""; /* Vista donde se registra la Dirección */
    }
}
?>