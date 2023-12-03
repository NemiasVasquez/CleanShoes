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
        $data["Servicio"]=$this->Servicio_Modelo->getServiciosPagina();

        require_once "Views/Servicios.php";
    }

    public function ListarServicios(){
        $data=$this->Servicio_Modelo->getServicios();
        if($data["Servicio"]==false){
            $mensaje ="No se ha encontrado servicios registrados.";
        }
        require_once ""; /* Vista del servicio llamado */
    }

    public function Registrar(){
    
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $tiempo_Entrega = $_POST["tiempo_entrega"];
        $estado = $_POST["estado"];
        $categoria = $_POST["categoria"];

        $consulta = $this->Servicio_Modelo->setServicio($nombre,$precio,$tiempo_Entrega,$categoria,$estado);     
        
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