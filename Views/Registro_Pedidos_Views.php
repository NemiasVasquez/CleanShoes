<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <title>Pedidos Pendientes - Clean Shoes</title>

    <link rel="stylesheet" href="Style/Pedidos_Pendientes_Style.css">
    <script type="text/javascript" src="JavaScript/Pedidos_Pendientes_Ajax.js"></script>
</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>
    <main>
    <div class="interior">
        <?php if($data["Pedidos"]!= false){ ?>
            <div id="contenedor_Pedidos">
                <div id="bloque_Buscar">
                    <form id="form_Buscar" name="form_Buscar">
                        <div>
                            <label for="select_TipoPedido">Seleccione el tipo de pedido:</label>
                        </div>
                        <div>
                            <select id="select_TipoPedido" name="select_TipoPedido">
                                <option value="NA">Todos los pedidos Pendientes</option>
                                <option value="Rechazado">Pedidos Rechazados.</option>
                                <option value="Pendiente">Pedidos pendientes.</option>
                                <option value="Aceptado">Pedidos pendiente de pago.</option>
                                <option value="Pagado">Pedidos pagados.</option>
                            </select>
                        </div>
                        <div id="bloque_BtnBuscar" name="bloque_BtnBuscar">
                            <input type="submit" value="Buscar" id="btn_Buscar_Pedidos" name="btn_Buscar_Pedidos">
                        </div>
                    </form>
                </div>
                <div id="contenedorPedidos">
                    <?php foreach($data["Pedidos"] as $P){ ?>
                        <div class="bloque_Pedido">
                            <div class="bloque_Barra_Lateral">
                                <div class="seccion1">
                                    <div class="seccion1_parte1">
                                        <p><?php echo "Orden: ".$P["id_Orden"]; ?></p>
                                        <p><?php echo $P["estado_orden"]; ?></p>
                                        <p><?php echo "Total: "."S/.".$P["total"]; ?></p>
                                    </div>
                                    <div class="seccion1_parte1">
                                        <p><?php echo $P["nombres"]." ".$P["apellidos"] ?></p>
                                        <p><?php echo $P["dni"] ?></p>
                                    </div>
                                    <div class="seccion1_parte1">
            
                                        <p><?php echo "Despacho: ".$P["tipoDespacho"]; ?></p>
                                        <p><?php echo date("Y-m-d",strtotime($P["fecha_creacion"])); ?></p>
                                        
                                    </div>
                                    <div class="seccion1_parte1">
                                        <?php if(isset($P["Direccion"])){?>
                                            <p><?php echo "Envío: ".$P["Direccion"]." - ".$P["Distrito"]; ?></p>
                                        <?php } ?>
                                    </div>

                                    <?php if(isset($P["tipoPago"])){ ?>
                                        <div class="seccion1_parte1">
                                            <p><?php echo $P["tipoPago"]; ?></p>
                                            <p><?php echo "Estado de pago: ".$P["estado_pago"]; ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($P["tiempoTotalEntrega"])){ ?>
                                        <div class="seccion1_parte1">
                                            <p><?php echo $P["tiempoTotalEntrega"]; ?></p>
                                        </div>

                                    <?php } ?>  
                                    <?php if($P["estado_orden"]!="Aceptado"){ ?>
                                        <div class="seccion1_parte1">
                                        
                                            <button class="btn_Rechazar" value="<?php echo $P["id_Orden"]; ?>">Rechazar</button>
                                    
                                            <button class="btn_Aceptar"  value="<?php echo $P["id_Orden"]; ?>">Aceptar</button>
                                        
                                        </div> 
                                    <?php } ?>
                                    <?php if($P["estado_orden"]=="Aceptado"){ ?>
                                        <div class="seccion1_parte1">
                                            <p>Pago: <?php echo $P["estado_pago"]; ?></p>
                                            
                                        </div> 
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="bloque_DetallePedido">
                                <?php $contadorS = 1; ?>
                                <div>
                                    <h3>Detalle del pedido:</h3>
                                </div>
                                <div class="bloque_tabla">
                                    <table class="tabla_Servicios">
                                        <thead>
                                            <tr class="cabecera">
                                                <th>#</th>
                                                <th>NOMBRE</th>
                                                <th>CATEGORIA</th>
                                                <th>PRECIO</th>
                                                <th>CANT.</th>
                                                <th>SUBTOTAL</th>
                                            </tr>
                                        </thead>
                                        <?php foreach($P["Servicios"] as $S ){ ?>
                                            <tr>
                                                <td><?php echo $contadorS ?></td>
                                                <td><?php echo $S["nombre"]; ?></td>
                                                <td><?php echo $S["categoria"]; ?></td>
                                                <td><?php echo "S/".$S["precio"]; ?></td>
                                                <td><?php echo $S["cantidad"]; ?></td>
                                                <td><?php echo "S/".$S["subTotal"]; ?></td>
                                            
                                            </tr>
                                            <?php $contadorS++; ?>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php } else {?>
                <div id="bloque_PedidoVacio">
                    <div>
                        <h3>No tiene pedidos pendientes</h3>
                    </div>
                    <div>
                        <img src="Imagenes/Pedidos/pedido.png" alt="Carrito Vacío.">
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <aside>
    <?php include 'Plantillas/Enlaces.php'; ?>
    </aside>
    <footer>
        <?php include 'Plantillas/Footer.php'; ?>
    </footer>
</body>
</html>