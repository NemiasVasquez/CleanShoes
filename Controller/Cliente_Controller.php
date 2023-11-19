<?php
class Cliente_Controller{
    private $Cliente_Modelo;
    public function __construct(){
        session_start();
        require_once "Model/Cliente_Model.php";
        $this->Cliente_Modelo = new Cliente_Model();
    }

    
}
?>