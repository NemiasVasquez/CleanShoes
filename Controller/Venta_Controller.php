<?php

class Venta_Controller
{
    private $Venta_Modelo;


    public function __construct()
    {
        session_start();
        require_once "Model/Venta_Model.php";
        $this->Venta_Modelo = new Venta_Model();
    }

    public function Pedidos_Views(){
        $Pedidos = true;
        $id_Cliente = $_SESSION["id_Cliente"];
        $data["Pedidos"] = $this->Venta_Modelo->getPedidosCliente($id_Cliente);

        require_once "Views/Pedidos_Views.php";
    }

    public function Carrito_Views()
    {
        if(isset($_SESSION["id_Cliente"])){
            $codigo_Cliente = $_SESSION["id_Cliente"];
            $data["Direccion"]=$this->Venta_Modelo->getDirecciones($codigo_Cliente);
            $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente,'Creación');
        }
       
        require_once "Views/Carrito_Views.php";
    }

    public function AgregarServicio()
    {
        $codigo_Cliente = $_SESSION["id_Cliente"];
        $estado = "Creación";
        $id_Servicio = isset($_POST["idServicio"]) ? $_POST["idServicio"] : null; // Verifica si idServicio está definido
        
        /* SE tiene que validar si existen ordenes en Creacion */
        $id_Orden = $this->Venta_Modelo->get_Id_Orden_Creacion($codigo_Cliente, $estado);
       
        if($id_Orden == false){
            $consulta = $this->Venta_Modelo->setOrdenInicial($codigo_Cliente, $estado);
            $id_Orden = $this->Venta_Modelo->get_Id_Orden_Creacion($codigo_Cliente, $estado);
        }

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
            $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente,'Creación');
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
            $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente,'Creación');
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
            $data["ServicioVenta"] = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente,'Creación');
        }else{
            $data=["mensaje"=>"No se logró Restar la cantidad del servicio"];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function CalcularTotales(){
        $codigo_Cliente = $_SESSION["id_Cliente"];
        $ServicioVenta = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente,'Creación');
        
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

    public function Reservar(){
        $tipoDespacho = $_POST["selector_TipoDespacho"];

        $Id_Direccion= ($_POST["Selector_Direccion"]=="NULL") ? null:$_POST["Selector_Direccion"];

        $indicaciones = isset($_POST["textarea_Indicaciones"]) ? $_POST["textarea_Indicaciones"] : null;

        $codigo_Cliente = $_SESSION["id_Cliente"];

        $ServicioVenta = $this->Venta_Modelo->OrdenesCliente($codigo_Cliente,'Creación');
        
        $total = 0;
    
        foreach ($ServicioVenta as $S) {
            $total += $S["precio"] * $S["cantidad"];
        }
        
        $id_Orden = $this->Venta_Modelo->get_Id_Orden_Creacion($codigo_Cliente, 'Creación');

        $Reservar = $this->Venta_Modelo->Reservar($id_Orden,$tipoDespacho,$Id_Direccion,$indicaciones,$total);
        
        if($Reservar){
            $respuesta = ["mensaje"=>"Pedido Reservado, espere la confirmación de la empresa."];
        }else{
            $respuesta = ["mensaje"=>"Error en la reserva."];
        }

        header('Content-Type: application/json');
        echo json_encode($respuesta);
        exit;

    }

    public function FiltrarPedidos(){
        $id_Cliente = $_SESSION["id_Cliente"];
        if($_POST["select_TipoPedido"] != "NA"){
            $tipoPedido = $_POST["select_TipoPedido"];
            $data["Pedidos"] = $this->Venta_Modelo->getPedidosCliente_Estado($id_Cliente,$tipoPedido);
        }else{
            $data["Pedidos"] = $this->Venta_Modelo->getPedidosCliente($id_Cliente);
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function CancelarPedido(){
        $id_orden = $_POST["idOrden"];
        $estado = "Cancelado";
        $id_Cliente = $_SESSION["id_Cliente"];
        $consulta = $this->Venta_Modelo->CambiarEstadoPedido($id_orden,$estado);
        if($consulta){
            $data=["mensaje"=>"Orden cancelada."];
        }else{
            $data=["mensaje"=>"ERROR!, La orden no ha podido ser cancelada."];
        }

        $data["Pedidos"] = $this->Venta_Modelo->getPedidosCliente($id_Cliente);

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /* Pedidos Pendientes */
    public function Pedidos_Pendientes(){
        $Pedidos_Pendientes = true;
        $data["Pedidos"]=$this->Venta_Modelo->getPedidos();
        require_once "Views/Registro_Pedidos_Views.php";
    }

    public function RechazarPedido(){
        $id_Orden = $_POST["idOrden"];
        $estado = "Rechazado";
        $consulta = $this->Venta_Modelo->CambiarEstadoPedido($id_Orden,$estado);
        if($consulta){
            $data=["mensaje"=>"Pedido Rechazado."];
            $data["Pedidos"] = $this->Venta_Modelo->getPedidos();
        }else{
            $data=["mensaje"=>"ERROR!,el pedido no ha sido rechazado."];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function AceptarPedido(){
        $id_Orden = $_POST["idOrden"];
        $estado = "Aceptado";
        $estadoPago = "Pendiente";
        $consulta = $this->Venta_Modelo->CambiarEstadoPedidoAceptado($id_Orden,$estado,$estadoPago);
        if($consulta){
            $data=["mensaje"=>"Pedido Aceptado."];
            $data["Pedidos"] = $this->Venta_Modelo->getPedidos();
        }else{
            $data=["mensaje"=>"ERROR!,el pedido no ha sido aceptado."];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}

?>
