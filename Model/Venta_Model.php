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

}
?>