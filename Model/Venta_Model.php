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

    public function OrdenesCliente($codigo_Cliente){
        $consulta = $this->dataBase->query("SELECT id_Orden, DS.id_Servicio, servicio.nombre, servicio.precio FROM orden 
                                            INNER JOIN detalle_servicio AS DS ON DS.id_Orden = orden.id_Orden
                                            INNER JOIN servicio ON servicio.id_Servicio = DS.id_Servicio
                                            WHERE orden.id_Cliente = '$codigo_Cliente'");
                                            
        while($fila = $consulta->fetch_assoc()){
            $this->venta = $fila;
        }

        if($this->Venta != NULL){
            return $this->venta;
        }else{
            return false;
        }
        
    }
    
}
?>