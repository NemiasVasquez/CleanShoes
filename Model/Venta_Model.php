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

    public function getPedidosCliente_Orden_Estado($id_Cliente,$tipoPedido){
        $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion FROM orden
        WHERE (orden.id_Cliente = '$id_Cliente' AND orden.estado_orden = '$tipoPedido' AND orden.estado_pago = 'Pendiente') ORDER BY orden.id_Orden DESC");
        $i=0;
        $ordenes=[];
        while($fila = $consultaPedidos->fetch_assoc()){
        $codigo_Orden = $fila["id_Orden"];
        $ordenes[$i]=$fila;

        if($fila["id_Direccion"]!= NULL){
        $id_Direccion = $fila["id_Direccion"];
        $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
        if($fila_Direc = $consulta_Direccion->fetch_assoc()){
        $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
        $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
        }
        }

        $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
        $j=0;
        while($fila2 = $consultaServicios->fetch_assoc()){
        $ordenes[$i]["Servicios"][$j] = $fila2;
        $j++; 
        }
        $i++;
        }

        if(count($ordenes) > 0){
        return $ordenes;
        }else{
        return false;
        }
    }

    public function getPedidosCliente_Estado($id_Cliente,$estado){
        $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion FROM orden
                                                    WHERE (orden.id_Cliente = '$id_Cliente' AND orden.estado_orden = '$estado' ) ORDER BY orden.id_Orden DESC");
        $i=0;
        $ordenes=[];
        while($fila = $consultaPedidos->fetch_assoc()){
            $codigo_Orden = $fila["id_Orden"];
            $ordenes[$i]=$fila;
            
            if($fila["id_Direccion"]!= NULL){
                $id_Direccion = $fila["id_Direccion"];
                $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
                if($fila_Direc = $consulta_Direccion->fetch_assoc()){
                    $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
                    $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
                }
            }

            $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                                                       INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                                                       WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
            $j=0;
            while($fila2 = $consultaServicios->fetch_assoc()){
                $ordenes[$i]["Servicios"][$j] = $fila2;
                $j++; 
            }
            $i++;
        }
        
        if(count($ordenes) > 0){
            return $ordenes;
        }else{
            return false;
        }
    }

    public function getPedidosCliente_Pago_Estado($id_Cliente,$estado){
            $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion FROM orden
                                                       WHERE (orden.id_Cliente = '$id_Cliente' AND orden.estado_pago = '$estado') ORDER BY orden.id_Orden DESC");
            $i=0;
            $ordenes=[];
            while($fila = $consultaPedidos->fetch_assoc()){
                $codigo_Orden = $fila["id_Orden"];
                $ordenes[$i]=$fila;

                if($fila["id_Direccion"]!= NULL){
                    $id_Direccion = $fila["id_Direccion"];
                    $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
                    if($fila_Direc = $consulta_Direccion->fetch_assoc()){
                        $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
                        $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
                    }
                }

                $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                        INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                        WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
                $j=0;
                while($fila2 = $consultaServicios->fetch_assoc()){
                    $ordenes[$i]["Servicios"][$j] = $fila2;
                    $j++; 
                }
                $i++;
            }

            if(count($ordenes) > 0){
                return $ordenes;
            }else{
                return false;
            }
    }

    public function getPedidosCliente($id_Cliente){
        $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion FROM orden
                                                    WHERE (orden.id_Cliente = '$id_Cliente' AND orden.estado_orden != 'Creación') ORDER BY orden.id_Orden DESC");

        $i=0;
        $ordenes=[];
        while($fila = $consultaPedidos->fetch_assoc()){
            $codigo_Orden = $fila["id_Orden"];
            $ordenes[$i]=$fila;
            
            if($fila["id_Direccion"]!= NULL){
                $id_Direccion = $fila["id_Direccion"];
                $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
                if($fila_Direc = $consulta_Direccion->fetch_assoc()){
                    $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
                    $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
                }
            }

            $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                                                       INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                                                       WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
            $j=0;
            while($fila2 = $consultaServicios->fetch_assoc()){
                $ordenes[$i]["Servicios"][$j] = $fila2;
                $j++; 
            }
            $i++;
        }
        
        if(count($ordenes) > 0){
            return $ordenes;
        }else{
            return false;
        }
    }

    public function getPedidos(){
        $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion, persona.nombres,persona.apellidos,persona.dni FROM orden
                                                    INNER JOIN cliente ON cliente.id_Cliente = orden.id_Cliente
                                                    INNER JOIN persona ON persona.id_Persona = Cliente.id_Persona
                                                    WHERE orden.estado_orden != 'Creación' AND  orden.estado_orden != 'Cancelado' AND  orden.estado_orden != 'Rechazado'
                                                    ORDER BY orden.id_Orden DESC");

        $i=0;
        $ordenes=[];
        while($fila = $consultaPedidos->fetch_assoc()){
            $codigo_Orden = $fila["id_Orden"];
            $ordenes[$i]=$fila;
            
            if($fila["id_Direccion"]!= NULL){
                $id_Direccion = $fila["id_Direccion"];
                $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
                if($fila_Direc = $consulta_Direccion->fetch_assoc()){
                    $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
                    $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
                }
            }

            $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                                                       INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                                                       WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
            $j=0;
            while($fila2 = $consultaServicios->fetch_assoc()){
                $ordenes[$i]["Servicios"][$j] = $fila2;
                $j++; 
            }
            $i++;
        }
        
        if(count($ordenes) > 0){
            return $ordenes;
        }else{
            return false;
        }
    }

    public function getOrden($id_Orden){
        $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion, persona.nombres,persona.apellidos,persona.dni FROM orden
                                                    INNER JOIN cliente ON cliente.id_Cliente = orden.id_Cliente
                                                    INNER JOIN persona ON persona.id_Persona = Cliente.id_Persona
                                                    WHERE orden.id_Orden = '$id_Orden' ");
        $i=0;
        $ordenes=[];
        while($fila = $consultaPedidos->fetch_assoc()){
            $codigo_Orden = $fila["id_Orden"];
            $ordenes[$i]=$fila;
            
            if($fila["id_Direccion"]!= NULL){
                $id_Direccion = $fila["id_Direccion"];
                $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
                if($fila_Direc = $consulta_Direccion->fetch_assoc()){
                    $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
                    $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
                }
            }

            $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                                                       INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                                                       WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
            $j=0;
            while($fila2 = $consultaServicios->fetch_assoc()){
                $ordenes[$i]["Servicios"][$j] = $fila2;
                $j++; 
            }
            $i++;
        }
        
        if(count($ordenes) > 0){
            return $ordenes;
        }else{
            return false;
        }
    }


    public function getPedidos_Estado_Neutro($estado){
        $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion,persona.nombres,persona.apellidos,persona.dni FROM orden
                                                    INNER JOIN cliente ON cliente.id_Cliente = orden.id_Cliente
                                                    INNER JOIN persona ON persona.id_Persona = cliente.id_Persona
                                                    WHERE orden.estado_orden = '$estado' ORDER BY orden.id_Orden DESC");

        $i=0;
        $ordenes=[];
        while($fila = $consultaPedidos->fetch_assoc()){
            $codigo_Orden = $fila["id_Orden"];
            $ordenes[$i]=$fila;
            
            if($fila["id_Direccion"]!= NULL){
                $id_Direccion = $fila["id_Direccion"];
                $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
                if($fila_Direc = $consulta_Direccion->fetch_assoc()){
                    $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
                    $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
                }
            }

            $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                                                       INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                                                       WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
            $j=0;
            while($fila2 = $consultaServicios->fetch_assoc()){
                $ordenes[$i]["Servicios"][$j] = $fila2;
                $j++; 
            }
            $i++;
        }
        
        if(count($ordenes) > 0){
            return $ordenes;
        }else{
            return false;
        }
    }


    public function getPedidos_Estado($estado){
        $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion,persona.nombres,persona.apellidos,persona.dni FROM orden
                                                    INNER JOIN cliente ON cliente.id_Cliente = orden.id_Cliente
                                                    INNER JOIN persona ON persona.id_Persona = cliente.id_Persona
                                                    WHERE orden.estado_orden = '$estado' AND orden.estado_pago ='Pendiente' ORDER BY orden.id_Orden DESC");

        $i=0;
        $ordenes=[];
        while($fila = $consultaPedidos->fetch_assoc()){
            $codigo_Orden = $fila["id_Orden"];
            $ordenes[$i]=$fila;
            
            if($fila["id_Direccion"]!= NULL){
                $id_Direccion = $fila["id_Direccion"];
                $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
                if($fila_Direc = $consulta_Direccion->fetch_assoc()){
                    $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
                    $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
                }
            }

            $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                                                       INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                                                       WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
            $j=0;
            while($fila2 = $consultaServicios->fetch_assoc()){
                $ordenes[$i]["Servicios"][$j] = $fila2;
                $j++; 
            }
            $i++;
        }
        
        if(count($ordenes) > 0){
            return $ordenes;
        }else{
            return false;
        }
    }

    public function getPedidos_Pago_Estado($estado){
        $consultaPedidos = $this->dataBase->query("SELECT orden.id_Orden, orden.id_Cliente, orden.total, orden.tipoDespacho, orden.estado_orden,orden.estado_pago,orden.tipoPago,orden.id_Direccion,orden.fecha_creacion,persona.nombres,persona.apellidos,persona.dni FROM orden
        INNER JOIN cliente ON cliente.id_Cliente = orden.id_Cliente
        INNER JOIN persona ON persona.id_Persona = cliente.id_Persona
        WHERE  orden.estado_pago ='$estado' ORDER BY orden.id_Orden DESC");

        $i=0;
        $ordenes=[];
        while($fila = $consultaPedidos->fetch_assoc()){
        $codigo_Orden = $fila["id_Orden"];
        $ordenes[$i]=$fila;

        if($fila["id_Direccion"]!= NULL){
        $id_Direccion = $fila["id_Direccion"];
        $consulta_Direccion= $this->dataBase->query("SELECT direccion, distrito FROM direccion_envio WHERE id_Direccion_Envio = '$id_Direccion'");
        if($fila_Direc = $consulta_Direccion->fetch_assoc()){
        $ordenes[$i]["Direccion"]=$fila_Direc["direccion"];
        $ordenes[$i]["Distrito"]=$fila_Direc["distrito"];
        }
        }

        $consultaServicios=$this->dataBase->query("SELECT detalle_servicio.*, servicio.nombre,servicio.precio,servicio.categoria  FROM detalle_servicio 
                INNER JOIN servicio ON servicio.id_Servicio = detalle_servicio.id_Servicio
                WHERE detalle_servicio.id_Orden = '$codigo_Orden'");
        $j=0;
        while($fila2 = $consultaServicios->fetch_assoc()){
        $ordenes[$i]["Servicios"][$j] = $fila2;
        $j++; 
        }
        $i++;
}

if(count($ordenes) > 0){
return $ordenes;
}else{
return false;
}
    }

    public function setOrdenInicial($id_Cliente,$estado){
        $consulta = $this->dataBase->query("INSERT INTO orden(id_Cliente,estado_Orden) VALUES ('$id_Cliente','$estado')");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function get_Id_Orden_Creacion($id_Cliente,$estado){
        $consulta = $this->dataBase->query("SELECT *FROM orden WHERE id_Cliente = '$id_Cliente' AND estado_orden = '$estado'");
        if($fila = $consulta->fetch_assoc()){
            $id = $fila["id_Orden"];
        }
        if(isset($id)){
            return $id;
        }else{
            return false;
        }
    }

    public function set_Detalle_Servicio($id_Servicio, $id_Orden){
        $consulta_Precio = $this->dataBase->query("SELECT precio FROM servicio WHERE id_Servicio = '$id_Servicio'");
        if($fila = $consulta_Precio->fetch_assoc()){
            $total = $fila["precio"];
        }
        $consulta = $this->dataBase->query("INSERT INTO detalle_servicio(id_Servicio,id_Orden,cantidad,subTotal) VALUES('$id_Servicio','$id_Orden','1','$total')");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function OrdenesCliente($codigo_Cliente,$estado){
        $consulta = $this->dataBase->query("SELECT orden.id_Orden,DS.id_DetalleServicio ,DS.id_Servicio,DS.cantidad, servicio.nombre, servicio.precio, servicio.categoria, DS.subTotal FROM orden 
                                            INNER JOIN detalle_servicio AS DS ON DS.id_Orden = orden.id_Orden
                                            INNER JOIN servicio ON servicio.id_Servicio = DS.id_Servicio
                                            WHERE orden.id_Cliente = '$codigo_Cliente' AND orden.estado_orden = '$estado'");

        while($fila = $consulta->fetch_assoc()){
            $this->Venta[] = $fila;
        }

        return $this->Venta;  
    }

    public function EliminarServicioCarrito($id_DetalleServicio){
        $consulta =$this->dataBase->query("DELETE FROM detalle_servicio WHERE id_DetalleServicio = '$id_DetalleServicio'");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function SumarDetalleServicio($id_DetalleServicio){
        $consulta_cantidad = $this->dataBase->query("SELECT cantidad , S.precio FROM detalle_servicio INNER JOIN servicio AS S ON S.id_Servicio = detalle_servicio.id_Servicio WHERE id_DetalleServicio = '$id_DetalleServicio'");
        if($fila = $consulta_cantidad->fetch_assoc()){
            $cantidad = $fila["cantidad"];
            $precio = $fila["precio"];
        }

        $cantidad++;
        $total = $cantidad * $precio;
        $consulta =$this->dataBase->query("UPDATE detalle_servicio SET cantidad ='$cantidad', subTotal = '$total' WHERE id_DetalleServicio = '$id_DetalleServicio'");
        
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function RestarDetalleServicio($id_DetalleServicio){
        $consulta_cantidad = $this->dataBase->query("SELECT cantidad , S.precio FROM detalle_servicio INNER JOIN servicio AS S ON S.id_Servicio = detalle_servicio.id_Servicio WHERE id_DetalleServicio = '$id_DetalleServicio'");
        if($fila = $consulta_cantidad->fetch_assoc()){
            $cantidad = $fila["cantidad"];
            $precio = $fila["precio"];
        }

        $cantidad--;
        $total = $cantidad * $precio;
        if($cantidad != 0){
            $consulta =$this->dataBase->query("UPDATE detalle_servicio SET cantidad ='$cantidad', subTotal = '$total' WHERE id_DetalleServicio = '$id_DetalleServicio'");
        }else{
            $consulta = $this->dataBase->query("DELETE FROM detalle_servicio WHERE id_DetalleServicio = '$id_DetalleServicio'");
        }
        
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function getDirecciones($id_Cliente){
        $consulta = $this->dataBase->query("SELECT * FROM direccion_envio WHERE id_Cliente = '$id_Cliente'");
        $i=0;
        while($fila = $consulta->fetch_assoc()){
            $direcciones[$i] = $fila;
            $i++;
        }
        return $direcciones; 
    }
    
    public function Reservar($id_Orden,$tipoDespacho,$Id_Direccion,$indicaciones,$total){
        $consulta = $this->dataBase->query("UPDATE orden SET id_Direccion = '$Id_Direccion',total = '$total',tipoDespacho='$tipoDespacho', estado_orden ='Pendiente', fecha_creacion = NOW() WHERE id_Orden = '$id_Orden'");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

    public function CambiarEstadoPedido($id_Orden , $estado){
        $consulta = $this->dataBase->query("UPDATE orden SET estado_orden = '$estado' WHERE id_Orden ='$id_Orden' ");
        if($consulta){ 
            return true;
        }else{
            return false;
        }
    }

    public function CambiarEstadoPedidoAceptado($id_Orden ,$estado,$estadoPago){
        $consulta = $this->dataBase->query("UPDATE orden SET estado_orden = '$estado', estado_pago ='$estadoPago' 
                                            WHERE id_Orden ='$id_Orden' ");
        if($consulta){ 
            return true;
        }else{
            return false;
        }
    }

    public function pagar($id_Orden,$estado_Pago,$tipoPago){
        $consulta = $this->dataBase->query("UPDATE orden SET estado_pago = '$estado_Pago', tipoPago = '$tipoPago'
                                            WHERE id_Orden ='$id_Orden' ");
        if($consulta){
            return true;
        }else{
            return false;
        }
    }

}
?>