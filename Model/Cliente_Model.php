<?php
class Cliente_Model{
    private $dataBase;
    private $Cliente;

    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Cliente=[];
    }

    public function getDataBase(){
        return $this->dataBase;
    }

    public function getClientes(){
        $consulta_Clientes = $this->dataBase->query("SELECT persona.nombres,persona.apellidos,persona.dni,usuario.usuario,usuario.rol,usuario.estado,cliente.id_cliente FROM cliente
        INNER JOIN persona ON persona.id_persona = cliente.id_persona
        INNER JOIN usuario ON usuario.id_usuario = cliente.id_usuario");
        
        $i =0;
        while($fila = $consulta_Clientes->fetch_assoc()){
            $this->Cliente[$i]=$fila;
            $i++;
        }

        if($fila != NULL){
            return $this->Cliente;
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

    public function setCliente($nombre,$apellidos,$dni,$correo,$celular,$fechaNac,$usuario,$contraseña){

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

    public function DesactivarActivarCliente($id){
        $consulta_idUsuario_Estado = $this->dataBase->query("SELECT usuario.estado cliente.id_usuario FROM cliente 
        INNER JOIN usuario ON cliente.id_usuario = usuario.id_usuario 
        WHERE id_cliente = '$id'");
        if($fila = $consulta_idUsuario_Estado->fetch_assoc()){
            $idUsuario_estado=$fila["id_usuario"];
        }
        $estado_Actualizado = "Activo";
        if($idUsuario_estado == "Activo"){
            $estado_Actualizado = "Inactivado";
        }
        $consulta_Cambio = $this->dataBase->query("UPDATE usuario SET estado ='$estado_Actualizado' WHERE id_usuario = '$idUsuario_estado'");
        if($consulta_Cambio){
            return true;
        }else{
            return false;
        }
    }

    public function BuscarCliente($id){
        $consulta_Cliente = $this->dataBase->query("SELECT persona.nombres,persona.apellidos,persona.dni,usuario.usuario,usuario.rol,usuario.estado,cliente.id_cliente FROM cliente
        INNER JOIN persona ON persona.id_persona = cliente.id_persona
        INNER JOIN usuario ON usuario.id_usuario = cliente.id_usuario
        WHERE cliente.id_cliente = '$id'");
        if($fila = $consulta_Cliente->fetch_assoc()){
            return $this->Cliente[]=$fila;
        }else{
            return false;
        }
    }
}
?>