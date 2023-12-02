<?php
class Servicio_Model{
    private $dataBase;
    private $Servicio;

    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Servicio = [];
    }

    public function setServicio($nombre,$precio,$descripcion,$tiempo_entrega,$estado){
        $consulta_Registro = $this->dataBase->query("INSERT INTO servicio(nombre,precio,descripcion,tiempo_estimado_entrega,estado) VALUES('$nombre','$precio','$descripcion','$tiempo_entrega','$estado')");
        if($consulta_Registro){
            return true;
        }else{
            return false;
        }
    }

    public function getServicios(){
        $consulta_Servicio = $this->dataBase->query("SELECT * FROM servicio ");
        $consulta_detalle_Descripcion = $this->dataBase->query();
        $i=0;
        while($fila = $consulta_Servicio->fetch_assoc()){
            $this->Servicio[$i]=$fila;
            $consulta_Descrip[$i]=$fila["descripcion"];
            $i++;
        }


        if($this->Servicio != NULL){
            return $this->Servicio;
        }else{
            return false;
        }
    }

    public function BuscarServicio($id){
        $consulta_Servicio = $this->dataBase->query("SELECT * FROM servicio WHERE id_Servicio = '$id'");
        if($fila = $consulta_Servicio->fetch_assoc()){
            return $this->Servicio = $fila; 
        }else{
            return false;
        }
    }

    public function ActivarDesactivarServicio($id){
        $estado_Consulta = $this->dataBase->query("SELECT estado FROM servicio WHERE id_servicio = '$id'");
        if($fila = $estado_Consulta->fetch_assoc()){
            $estado_Base = $fila["estado"];
        }
        if($estado_Base == "Activo"){
            $nuevo_estado = "Inactivo";
        }else{
            $nuevo_estado="Activo";
        }
        $consulta = $this->dataBase->query("UPDATE servicio SET estado ='$nuevo_estado' WHERE id_servicio = '$id'");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }
}
?>