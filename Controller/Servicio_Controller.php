<?php
class Servicio_Controller{
    private $Servicio_Modelo;

    public function __construct(){
        session_start();
        require_once "Model/Servicio_Model.php";
        $this->Servicio_Modelo = new Servicio_Model();
    }

    public function Servicios(){
        $Servicios = true;
        $data["Servicio"]=$this->Servicio_Modelo->getServicios();
        require_once "Views/Servicios.php";
    }

    public function ListarServicios(){
        $data["Servicio"]=$this->Servicio_Modelo->getServicios();
        if($data["Servicio"]==false){
            $mensaje ="No se ha encontrado servicios registrados.";
        }
        require_once ""; /* Vista del servicio llamado */
    }

    public function ValidarRegistro($nombre,$precio,$descripcion,$tiempo_entrega,$estado){
        if($nombre==""){
            return $mensaje="Debe ingresar un nombre del servicio."; 
        }
        if($precio==""){
            return $mensaje ="Debe ingresar el precio.";
        }
        if(strlen($descripcion)!=8){
            return $mensaje= "Debe  ingresar una descripcion.";
        }
        if(strlen($tiempo_entrega)!=9){
            return $mensaje ="Debe ingresar el tiempo de entrega aproximada.";
        }
        if($estado =="NA"){
            return $mensaje ="Debe seleccionar un estado.";
        }
        return $mensaje="";
    }

    public function Registrar(){
        $mensaje = $this->ValidarRegistro($_POST["nombre"],$_POST["precio"],$_POST["descripcion"],$_POST["tiempo_entrega"],$_POST["estado"]);
        if($mensaje ==""){
            $nombre = $_POST["nombre"];
            $precio = $_POST["precio"];
            $descripcion = $_POST["descripcion"];
            $tiempo_Entrega = $_POST["tiempo_entrega"];
            $estado = $_POST["estado"];
    
            $consulta = $this->Servicio_Modelo->setServicio($nombre,$precio,$descripcion,$tiempo_Entrega,$estado);
            if($consulta){
                $mensaje ="Registro exitoso.";
            }else{
                $mensaje ="Ha ocurrido un error en el registro.";
            }      
        }
        require_once ""; /* Vista donde es llamado. */  
    }

    public function BuscarServicio(){
        if($_POST[""]){
            $id_Buscador = $_POST[""]; /* Como se defina la variable en la vista */
            $data["Servicio"] =$this->Servicio_Modelo->BuscarServicio($id_Buscador);
            if($data["Servicio"]==false){
                $mensaje ="No se ha encontrado el servicio buscado.";
            }
        }else{
            $mensaje = "Debe ingresar el código del servicio.";
        }
        require_once ""; /* Vista donde es llamado. */
    }

    public function ActivarDesactivarServicio($id){ /* Boton para activar  / desactivar */
        $consulta =$this->Servicio_Modelo->ActivarDesactivarServicio($id);
        if($consulta ==true){
            $mensaje ="Estado cambiado con exito.";
        }else{
            $mensaje ="Ha ocurrido un error en la sentencia.";
        }
        header("Location: index.php?c=Servicio_Controller&a=ListarServicios");
    }
}

?>