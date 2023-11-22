<?php
class Trabajador_Model{
    private $dataBase;
    private $Trabajador;

    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Trabajador=[];
    }

    public function getTrabajadores(){
        $consulta_Trabajadors = $this->dataBase->query("SELECT persona.nombres,persona.apellidos,persona.dni,usuario.usuario,usuario.rol,usuario.estado,Trabajador.id_Trabajador FROM Trabajador
        INNER JOIN persona ON persona.id_persona = trabajador.id_persona
        INNER JOIN usuario ON usuario.id_usuario = trabajador.id_usuario");
        
        $i =0;
        while($fila = $consulta_Trabajadors->fetch_assoc()){
            $this->Trabajador[$i]=$fila
            $i++;
        }

        if($fila != NULL){
            return $this->Trabajador;
        }else{
            return false;
        }
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

    public function setTrabajador($nombre,$apellidos,$dni,$correo,$celular,$fechaNac,$usuario,$contraseña, $rol){

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

        $Registro_Trabajador = $this->dataBase->query("INSERT INTO trabajador(id_Persona,id_Usuario,estado) VALUES ('$codigo_Persona','$codigo_Usuario','Activo')");
        
        if($this->ValidarRegistro($Registro_Trabajador,$Registro_Persona,$Registro_Usuario)){
            return true;
        }else{
            return false;
        }
    }

    public function DesactivarActivarTrabajador($id){
        $consulta_idUsuario_Estado = $this->dataBase->query("SELECT usuario.estado Trabajador.id_usuario FROM Trabajador 
        INNER JOIN usuario ON Trabajador.id_usuario = usuario.id_usuario 
        WHERE id_Trabajador = '$id'");
        while($fila = $consulta_idUsuario_Estado->fetch_assoc()){
            $idUsuario_estado[]=$fila;
        }
        $estado_Actualizado = "Activo";
        if($idUsuario_estado[0]["estado"]=="Activo"){
            $estado_Actualizado = "Inactivado";
        }
        $consulta_Cambio = $this->dataBase->query("UPDATE usuario SET estado ='$estado_Actualizado' WHERE id_usuario = '$idUsuario_estado[0]["id_usuario"]'");
        if($consulta_Cambio){
            return true;
        }else{
            return false;
        }
    }

    public function BuscarTrabajador($id){
        $consulta_Trabajador = $this->dataBase->query("SELECT persona.nombres,persona.apellidos,persona.dni,usuario.usuario,usuario.rol,usuario.estado,Trabajador.id_Trabajador FROM Trabajador
        INNER JOIN persona ON persona.id_persona = Trabajador.id_persona
        INNER JOIN usuario ON usuario.id_usuario = Trabajador.id_usuario
        WHERE Trabajador.id_Trabajador = '$id'");
        if($fila = $consulta_Trabajador->fetch_assoc()){
            return $this->Trabajador[]=$fila;
        }else{
            return false;
        }
    }
}
?>