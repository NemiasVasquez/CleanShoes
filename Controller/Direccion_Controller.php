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

    public function AñadirDireccion(){
        $direccion= $_POST["direccion_añadir"];
        $referencia = $_POST["referencia_añadir"];
        $distrito = $_POST["distrito_añadir"];
        $id_Cliente = $_SESSION["id_Cliente"];

        $consulta = $this->Direccion_Modelo->setDireccion($id_Cliente,$distrito,$direccion,$referencia);
        if($consulta ){
            $respuesta = ["mensaje"=>"Registro correcto."];
        }else{
            $respuesta = ["mensaje"=>"Registro fallido."];
        }

        header('Content-Type: application/json');
        echo json_encode($respuesta);
        exit;
    }

    public function ListarDireccionCliente($id){
        $data["Direccion"] = $this->Direccion_Modelo->getDireccion_Cliente($id);

        if($data["Direccion"] != NULL){
            $respuesta = ["mensaje"=>"Registro completado."];
            $respuesta = ["data" => $data["Direccion"]];
        }else{
            $respuesta = ["mensaje"=>"Error en el registro."];
        }
        
        header('Content-Type: application/json');
        echo json_encode($respuesta);
        exit;
    }
    
}
?>