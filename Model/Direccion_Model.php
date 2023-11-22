<?php
class Direccion_Model{
    private $dataBase;
    private $Direccion;

    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Direccion = [];
    }

    public function setDireccion($id,$departamento,$provincia,$distrito,$direccion,$referencia){
        $consulta_Registro = $this->dataBase->query("INSERT INTO direccion_envio VALUES ('$id','$departamento','$provincia','$distrito','$direccion','$referencia','Activo')");
        if($consulta_Registro){
            return true;
        }else{
            return false;
        }
    }

    
}
?>