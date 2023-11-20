<?php
class Cliente_Model{
    private $dataBase;
    private $Cliente;

    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Cliente=[];
    }

    /* Falta validar para que retorne TRUE en caso sea todo correcto o FALSE en caso algo haya fallado -> Evitar Anidaciones */
    public function ValidarRegistro($registro1,$registro2,$registro3){
        if($registro1==NULL){
            return false;
        }
        if($registro2 == NULL){
            return false;
        }
        if($registro3 == NULL){
            return false;
        }
        return true;
    } 

    public function ValidarDNI($dni){
        $consulta_lista_DNI = $this->dataBase->query("SELECT dni FROM persona WHERE persona.dni = '$dni'");
        while ($fila = $consulta_lista_DNI->fetch_assoc()) {
           $datos[]=$fila;
        } 
        if($datos!=NULL){
            return false;
        }else{
            return true;
        }
    }

    public function setCliente($nombre,$apellidos,$dni,$correo,$celular,$fechaNac,$usuario,$contraseña, $rol){

        $Registro_Persona = $this->dataBase->query("INSERT INTO persona(nombres,apellidos,dni,correo,celular,fecha_nac) VALUES ('$nombre','$apellidos','$dni','$correo','$celular','$fechaNac')");
        
        $Consulta_id_Persona = $this->dataBase->query("SELECT id_Persona FROM persona WHERE dni = '$dni'");
        while ($fila_persona = $Consulta_id_Persona->fetch_assoc()){
            $codigo_Persona = $fila_persona['id_Persona'];    
        }

        $Registro_Usuario = $this->dataBase->query("INSERT INTO usuario(usuario,password,rol,estado) VALUES ('$usuario','$contraseña','$rol','Activo')");
        
        $Consulta_id_Usuario = $this->dataBase->query("SELECT id_Usuario FROM usuario AS U WHERE (U.usuario = '$usuario' AND U.password='$contraseña'");
        while ($fila_Usuario = $Consulta_id_Usuario->fetch_assoc()){
            $codigo_Usuario = $fila_Usuario['id_Usuario'];    
        }

        $Registro_Cliente = $this->dataBase->query("INSERT INTO cliente(id_Persona,id_Usuario) VALUES ('$codigo_Persona','$codigo_Usuario')");
        
        if($this->ValidarRegistro($Registro_Cliente,$Registro_Persona,$Registro_Usuario)){
            return true;
        }else{
            return false;
        }
    }
}
?>