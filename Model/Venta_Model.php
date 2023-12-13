<?php
class Venta_Model{
    private $dataBase;
    private $Venta;
    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Venta = [];
    }

    public function getDataBase(){
        return $this->dataBase;
    }

    public function setOrdenInicial($id_Cliente,$estado){
        $consulta = $this->dataBase->query("INSERT INTO orden(id_Cliente,estado_Orden) VALUES ('$id_Cliente','$estado')");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function get_Id_Orden_Creacion($id_Cliente,$estado){
        $consulta = $this->dataBase->query("SELECT *FROM orden WHERE id_Cliente = '$id_Cliente' AND estado_orden = '$estado'");
        if($fila = $consulta->fetch_assoc()){
            $id = $fila["id_Orden"];
        }
        return $id;
    }

    public function set_Detalle_Servicio($id_Servicio, $id_Orden){
        $consulta_Precio = $this->dataBase->query("SELECT precio FROM servicio WHERE id_Servicio = '$id_Servicio'");
        if($fila = $consulta_Precio->fetch_assoc()){
            $total = $fila["precio"];
        }
        $consulta = $this->dataBase->query("INSERT INTO detalle_servicio(id_Servicio,id_Orden,cantidad,subTotal) VALUES('$id_Servicio','$id_Orden','1','$total')");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function OrdenesCliente($codigo_Cliente){
        $consulta = $this->dataBase->query("SELECT orden.id_Orden,DS.id_DetalleServicio ,DS.id_Servicio,DS.cantidad, servicio.nombre, servicio.precio, servicio.categoria, DS.subTotal FROM orden 
                                            INNER JOIN detalle_servicio AS DS ON DS.id_Orden = orden.id_Orden
                                            INNER JOIN servicio ON servicio.id_Servicio = DS.id_Servicio
                                            WHERE orden.id_Cliente = '$codigo_Cliente'");

        while($fila = $consulta->fetch_assoc()){
            $this->Venta[] = $fila;
        }

        return $this->Venta;  
    }

    public function EliminarServicioCarrito($id_DetalleServicio){
        $consulta =$this->dataBase->query("DELETE FROM detalle_servicio WHERE id_DetalleServicio = '$id_DetalleServicio'");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function SumarDetalleServicio($id_DetalleServicio){
        $consulta_cantidad = $this->dataBase->query("SELECT cantidad , S.precio FROM detalle_servicio INNER JOIN servicio AS S ON S.id_Servicio = detalle_servicio.id_Servicio WHERE id_DetalleServicio = '$id_DetalleServicio'");
        if($fila = $consulta_cantidad->fetch_assoc()){
            $cantidad = $fila["cantidad"];
            $precio = $fila["precio"];
        }

        $cantidad++;
        $total = $cantidad * $precio;
        $consulta =$this->dataBase->query("UPDATE detalle_servicio SET cantidad ='$cantidad', subTotal = '$total' WHERE id_DetalleServicio = '$id_DetalleServicio'");
        
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function RestarDetalleServicio($id_DetalleServicio){
        $consulta_cantidad = $this->dataBase->query("SELECT cantidad , S.precio FROM detalle_servicio INNER JOIN servicio AS S ON S.id_Servicio = detalle_servicio.id_Servicio WHERE id_DetalleServicio = '$id_DetalleServicio'");
        if($fila = $consulta_cantidad->fetch_assoc()){
            $cantidad = $fila["cantidad"];
            $precio = $fila["precio"];
        }

        $cantidad--;
        $total = $cantidad * $precio;
        if($cantidad != 0){
            $consulta =$this->dataBase->query("UPDATE detalle_servicio SET cantidad ='$cantidad', subTotal = '$total' WHERE id_DetalleServicio = '$id_DetalleServicio'");
        }else{
            $consulta = $this->dataBase->query("DELETE FROM detalle_servicio WHERE id_DetalleServicio = '$id_DetalleServicio'");
        }
        
        if($consulta){
            return true;
        }else{
            return false;
        }
    }
    
}
?>