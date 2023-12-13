<?php

class Venta_Controller
{
    private $Venta_Modelo;
    private $orden = false;

    public function __construct()
    {
        session_start();
        require_once "Model/Venta_Model.php";
        $this->Venta_Modelo = new Venta_Model();
    }

    public function Carrito_Views()
    {
        if(isset($_SESSION["id_Cliente"])){
            $codigo_Cliente = $_SESSION["id_Cliente"];
            $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente);
        }
       
        require_once "Views/Carrito_Views.php";
    }

    public function AgregarServicio()
    {
        $codigo_Cliente = $_SESSION["id_Cliente"];
        $estado = "Creación";
        $id_Servicio = isset($_POST["idServicio"]) ? $_POST["idServicio"] : null; // Verifica si idServicio está definido

        if ($this->orden == false) {
            $this->orden = true;
            $consulta = $this->Venta_Modelo->setOrdenInicial($codigo_Cliente, $estado);
        }

        $id_Orden = $this->Venta_Modelo->get_Id_Orden_Creacion($codigo_Cliente, $estado);

        $consulta2 = $this->Venta_Modelo->set_Detalle_Servicio($id_Servicio, $id_Orden);

        if ($consulta2) {
            $datos = ["mensaje" => "Producto agregado al carrito."];
        } else {
            $datos = ["mensaje" => "Producto NO ha sido agregado al carrito."];
        }

        header('Content-Type: application/json');
        echo json_encode($datos);
        exit;
    }

    public function EliminarServicioCarrito(){
        $id_DetalleServicio = $_POST["idDetalleServicio"];
        $consulta = $this->Venta_Modelo->EliminarServicioCarrito($id_DetalleServicio);
        if($consulta){
            $data=["mensaje"=>"Elimardo con exito."];
            $codigo_Cliente = $_SESSION["id_Cliente"];
            $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente);
        }else{
            $data=["mensaje"=>"No se logró eliminar"];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function SumarDetalleServicio(){
        $id_DetalleServicio = $_POST["idDetalleServicio"];
        $consulta = $this->Venta_Modelo->SumarDetalleServicio($id_DetalleServicio);
        if($consulta){
            $data=["mensaje"=>"Sumado con exito."];
            $codigo_Cliente = $_SESSION["id_Cliente"];
            $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente);
        }else{
            $data=["mensaje"=>"No se logró Sumar la cantidad del servicio"];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function RestarDetalleServicio(){
        $id_DetalleServicio = $_POST["idDetalleServicio"];
        $consulta = $this->Venta_Modelo->RestarDetalleServicio($id_DetalleServicio);
        if($consulta){
            $data=["mensaje"=>"Restado con exito."];
            $codigo_Cliente = $_SESSION["id_Cliente"];
            $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente);
        }else{
            $data=["mensaje"=>"No se logró Restar la cantidad del servicio"];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function CalcularTotales(){
        $codigo_Cliente = $_SESSION["id_Cliente"];
        $ServicioVenta = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente);
        
        $total = 0;
    
        foreach ($ServicioVenta as $S) {
            $total += $S["precio"] * $S["cantidad"];
        }
    
        $igv = $total * 0.18;
        $subtotal = $total - $igv;
    
        $data = [
            "subtotal" => $subtotal,
            "igv" => $igv,
            "total" => $total
        ];
    
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

  
}

?>
