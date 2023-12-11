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

    public function getDirecionesCliente(){
        $id_Cliente = $_SESSION["id_Cliente"];
        $consulta = $this->Direccion_Modelo->getDireccion_Cliente($id_Cliente);

        header('Content-Type: application/json');
        echo json_encode($consulta);
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

    public function BuscarDireccion() {
        if (isset($_POST['id_Direccion'])) {
            $id_Direccion = $_POST['id_Direccion'];

            $informacionDireccion = $this->Direccion_Modelo->buscarDireccion($id_Direccion);

            header('Content-Type: application/json');
            echo json_encode($informacionDireccion);
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array('error' => 'Parámetro id_Direccion no proporcionado.'));
        }
    }

    public function ActualizarDireccion(){
        $id_Direccion = $_POST["Selector_Direccion"];
        $direccion = $_POST["direccion_actualizar"];
        $referencia = $_POST["referencia_actualizar"];
        $distrito = $_POST["distrito_actualizar"];

        $consulta = $this->Direccion_Modelo->ActualizarDireccion($id_Direccion,$direccion,$distrito,$referencia);
        if($consulta ){
            $respuesta = ["mensaje"=>"Actualización correcta."];
        }else{
            $respuesta = ["mensaje"=>"Actualización fallida."];
        }
        header('Content-Type: application/json');
        echo json_encode($respuesta);
        exit;
    }
}

?>