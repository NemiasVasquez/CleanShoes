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
        $consulta = $this->dataBase->query("INSERT INTO detalle_servicio(id_Servicio,id_Orden,cantidad) VALUES('$id_Servicio','$id_Orden','1')");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function OrdenesCliente($codigo_Cliente){
        $consulta = $this->dataBase->query("SELECT orden.id_Orden,DS.id_DetalleServicio ,DS.id_Servicio,DS.cantidad, servicio.nombre, servicio.precio, servicio.categoria FROM orden 
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

    
}
?>