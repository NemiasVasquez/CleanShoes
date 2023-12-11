<?php 
class Venta_Controller{
    private $Venta_Modelo;
    public function __construct(){
        session_start();
        require_once "Model/Venta_Model.php";
        $this->Venta_Modelo = new Venta_Model();
    }

    public function Carrito_Views(){
        require_once "Views/Carrito_Views.php";
    }
}

?>