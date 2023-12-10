<?php
class Direccion_Model{
    private $dataBase;
    private $Direccion;

    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Direccion = [];
    }

    public function setDireccion($id,$distrito,$direccion,$referencia){
        $consulta_Registro = $this->dataBase->query("INSERT INTO direccion_envio(id_Cliente,distrito,direccion,referencia,estado) VALUES ('$id','$distrito','$direccion','$referencia','Activo')");
        if($consulta_Registro){
            return true;
        }else{
            return false;
        }
    }

    public function getDireccion_Cliente($id){
        $consulta_Direccion = $this->dataBase->query("SELECT *FROM direccion_envio WHERE id_Cliente = '$id'");
        $i = 0;
        while($fila = $consulta_Direccion->fetch_assoc()){
            $this->Direccion[$i]=$fila;
        }

        if($this->Direccion != NULL){
            return $this->Direccion;
        }else{
            return false;
        }
    }

}
?>