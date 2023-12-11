<?php 
class Venta_Controller{
    private $Venta_Modelo;
    public function __construct(){
        session_start();
        require_once "Model/Venta_Model.php";
        $this->Venta_Modelo = new Venta_Model();
    }

    public function Carrito_Views(){
        $codigo_Cliente = $_SESSION["id_Cliente"];
        $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente);

        require_once "Views/Carrito_Views.php";
    }
}

?>