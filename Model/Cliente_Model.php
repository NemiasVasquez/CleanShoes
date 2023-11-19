<?php
class Cliente_Model{
    private $dataBase;
    private $Cliente;

    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Cliente=[];
    }

    public function Registrar($nombre,$apellidos,$dni,$correo,$celular,$fechaNac){
        /* CODIGO LLENO */
    }
}
?>