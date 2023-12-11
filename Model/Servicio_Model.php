<?php
class Servicio_Model{
    private $dataBase;
    private $Servicio;

    public function __construct(){
        $this->dataBase = Conexion::Conexion();
        $this->Servicio = [];
    }

    public function getDataBase(){
        return $this->dataBase;
    }


    public function setServicio($nombre,$precio,$tiempo_entrega,$categoria,$estado){
        $consulta_Registro = $this->dataBase->query("INSERT INTO servicio(nombre,precio,tiempo_estimado_entrega,categoria,estado) VALUES('$nombre','$precio','$tiempo_entrega','$categoria','$estado')");
        if($consulta_Registro){
            return true;
        }else{
            return false;
        }
    }

    public function FiltrarServicios($Principal, $Secundario, $Orden, $Minimo, $Maximo){
        $consulta = array();
        
        if(($Principal == true && $Secundario == true)|| ($Principal == false && $Secundario == false)){
            $consulta["Principal"] = $this->getServiciosPagina("Principal");
            $consulta["Adicional"] = $this->getServiciosPagina("Adicional");
        } else if($Secundario == true){
            $consulta["Adicional"] = $this->getServiciosPagina("Adicional");
        } else if($Principal == true  ){
            $consulta["Principal"] = $this->getServiciosPagina("Principal");   
        }
    
        if ($Minimo !== null && $Maximo !== null && is_numeric($Minimo) && is_numeric($Maximo)) {
            $consulta = $this->filtrarPorRango($consulta, $Minimo, $Maximo);
        }

        if ($Orden && ($Orden == 'Menor' || $Orden == 'Mayor')) {
            $consulta = $this->ordenarServicios($consulta, $Orden);
        }
    
        $response = array(
            'status' => 'success',
            'data' => $consulta
        );
    
        return $response;
    }
    
    private function filtrarPorRango($consulta, $minimo, $maximo) {
        foreach ($consulta as &$categoria) {
            $categoria = array_values(array_filter($categoria, function($servicio) use ($minimo, $maximo) {
                $precio = (int)$servicio['precio'];
                return $precio >= $minimo && $precio <= $maximo;
            }));
        }
        return $consulta;
    }

    private function ordenarServicios($consulta, $orden) {
        foreach ($consulta as &$categoria) {
            usort($categoria, function($a, $b) use ($orden) {
                $precioA = (int)$a['precio'];
                $precioB = (int)$b['precio'];
    
                return $orden == 'Menor' ? $precioA - $precioB : $precioB - $precioA;
            });
        }
        return $consulta;
    }

    public function getServicio(){
        $consulta_Servicio = $this->dataBase->query("SELECT * FROM servicio");
       
        $i=0;
        while($fila = $consulta_Servicio->fetch_assoc()){

            $this->Servicio[$i]=$fila;
            $codigo = $this->Servicio[$i]['id_Servicio'];
            $consulta_detalle_Descripcion = $this->dataBase->query("SELECT descripcion.nombre FROM detalle_descripcion
            INNER JOIN descripcion ON detalle_descripcion.id_Descripcion = descripcion.id_Descripcion
            WHERE  detalle_descripcion.id_Servicio = $codigo ");

            $j=0;
            while ($fila2 = $consulta_detalle_Descripcion->fetch_assoc()){
                $this->Servicio[$i]["Descripcion"][$j]=$fila2;
                $j++;
            }

            $i++;
        }

        if($this->Servicio != NULL){
            return $this->Servicio;
        }else{
            return false;
        }
    }

    public function getServiciosPagina($Categoria){
        $consulta_Servicio = $this->dataBase->query("SELECT * FROM servicio WHERE estado = 'Activo' AND categoria = '$Categoria'");
       
        $i=0;
        while($fila = $consulta_Servicio->fetch_assoc()){

            $this->Servicio[$i]=$fila;
            $codigo = $this->Servicio[$i]['id_Servicio'];
            $consulta_detalle_Descripcion = $this->dataBase->query("SELECT descripcion.nombre FROM detalle_descripcion
            INNER JOIN descripcion ON detalle_descripcion.id_Descripcion = descripcion.id_Descripcion
            WHERE  detalle_descripcion.id_Servicio = $codigo ");

            $j=0;
            while ($fila2 = $consulta_detalle_Descripcion->fetch_assoc()){
                $this->Servicio[$i]["Descripcion"][$j]=$fila2;
                $j++;
            }

            $i++;
        }

        if($this->Servicio != NULL){
            return $this->Servicio;
        }else{
            return false;
        }
    }

    public function BuscarServicio($id){
        $consulta_Servicio = $this->dataBase->query("SELECT * FROM servicio WHERE id_Servicio = '$id'");
        if($fila = $consulta_Servicio->fetch_assoc()){
            return $this->Servicio = $fila; 
        }else{
            return false;
        }
    }

    public function ActivarDesactivarServicio($id){
        $estado_Consulta = $this->dataBase->query("SELECT estado FROM servicio WHERE id_servicio = '$id'");
        if($fila = $estado_Consulta->fetch_assoc()){
            $estado_Base = $fila["estado"];
        }
        if($estado_Base == "Activo"){
            $nuevo_estado = "Inactivo";
        }else{
            $nuevo_estado="Activo";
        }
        $consulta = $this->dataBase->query("UPDATE servicio SET estado ='$nuevo_estado' WHERE id_servicio = '$id'");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }
}
?>