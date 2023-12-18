<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <link rel="stylesheet" href="Style/Pedidos_Style.css">

    <title>Mis Pedidos - Clean Shoes</title>
</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>
    <main class="interior">
        <div class="interior">
            <div id="contenedor_Pedidos">
                <div id="bloque_Buscar">
                    <form id="form_Buscar" name="form_Buscar">
                        <div>
                            <label for="select_TipoPedido">Seleccione el tipo de pedido:</label>
                        </div>
                        <div>
                            <select id="select_TipoPedido" name="select_TipoPedido">
                                <option value="NA">Elija un tipo de pedido para buscar</option>
                                <option value="Reserva">Pedidos en reserva.</option>
                                <option value="Pendiente">Pedidos pendiente de pago.</option>
                                <option value="Pagado">Pedidos pagados.</option>
                            </select>
                        </div>
                        <div id="bloque_BtnBuscar" name="bloque_BtnBuscar">
                            <input type="submit" value="Buscar" id="btn_Buscar" name="btn_Buscar">
                        </div>
                    </form>
                </div>
                <?php $contador=1; ?>
                <?php foreach($data["Pedidos"] as $P){ ?>
                    <div class="bloque_Pedido">
                        <div class="bloque_Barra_Superior">
                            <div class="bloque_detalles_Boton">
                                <div class="seccion1">
                                    <div class="seccion1_parte1">
                                        <p><?php echo "Fecha: ".date("Y-m-d",strtotime($P["fecha_creacion"])); ?></p>
                                        <p><?php echo "Estado".$P["estado_orden"]; ?></p>
                                        <p><?php echo "Total: "."S/.".$P["total"]; ?></p>
                                    </div>
                                    <div class="seccion1_parte1">
                                        <p><?php echo $contador ?></p>
                                        <p><?php echo "Orden: ".$P["id_Orden"]; ?></p>
                                        <p><?php echo "Despacho: ".$P["tipoDespacho"]; ?></p>
                                    </div>
                                </div>
  
                                <div>
                                    <?php if($P["estado_orden"] == "Pendiente"){ ?>
                                        <button id="<?php echo $P["id_Orden"]; ?>">Cancelar</button>
                                    <?php } else{ ?>
                                        <button id="<?php echo $P["id_Orden"]; ?>">Pagar</button>
                                    <?php } ?>
                                </div>    
                            </div>

                            <div class="seccion2">
                                <?php if(isset($P["Direccion"])){?>
                                    <p><?php echo "Dirección: ".$P["Direccion"]." - ".$P["Distrito"]; ?></p>
                                <?php } ?>
                            </div>

                            <?php if(isset($P["tipoPago"])){ ?>
                                <div class="seccion2">
                                    <p><?php echo $P["tipoPago"]; ?></p>
                                    <p><?php echo $P["tipoPago"]; ?></p>
                                </div>
                            <?php } ?>
                            <?php if(isset($P["tipoPago"])){ ?>
                                <div class="seccion2">
                                    <p><?php echo $P["tiempoTotalEntrega"]; ?></p>
                                </div>
                            <?php } ?>
                           
                        </div>
                        <?php $contadorS = 1; ?>
                        <table class="tabla_Servicios">
                            <thead>
                                <tr class="cabecera">
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>PRECIO</th>
                                    <th>CATEGORIA</th>
                                    <th>CANTIDAD</th>
                                    <th>SUBTOTAL</th>
                                </tr>
                            </thead>
                            <?php foreach($P["Servicios"] as $S ){ ?>
                                
                                    <td><?php echo $contadorS ?></td>
                                    <td><?php echo $S["nombre"]; ?></td>
                                    <td><?php echo "S/".$S["precio"]; ?></td>
                                    <td><?php echo $S["categoria"]; ?></td>
                                    <td><?php echo $S["cantidad"]; ?></td>
                                    <td><?php echo "S/".$S["subTotal"]; ?></td>
                                
                                </tr>
                                <?php $contadorS++; ?>
                            <?php } ?>
                        </table>

                        <?php $contador++; ?>
                    </div>
                <?php } ?>
            </div>
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