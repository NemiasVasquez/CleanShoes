<?php
class Cliente_Model{
    private $dataBase;
    private $Cliente;
    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Cliente=[];
    }
}
?>