<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <script type="text/javascript" src="JavaScript/Portal_Pagos_Ajax.js"></script>

    <link rel="stylesheet" href="Style/Portal_Pago_Style.css">
    <link rel="stylesheet" href="Style/Pedidos_Style.css">

    <title>Portal Pago - Clean Shoes</title>

</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>
    <main>
        <div class="interior|">
            <div id="contenedorPedidos">
                 <div id="titulo_Portal">
                        <h1>Portal de Pago</h1>
                </div>
                <?php foreach($data["Pedidos"] as $P){ ?>
                    <div class="bloque_Pedido">
                       
                        <div class="bloque_Barra_Lateral">
                            <div class="seccion1">
                                <div class="seccion1_parte1">
                                    <p><?php echo "Orden: ".$P["id_Orden"]; ?></p>
                                    <p><?php echo date("Y-m-d",strtotime($P["fecha_creacion"])); ?></p>
                                    
                                    <p><?php echo "Total: "."S/.".$P["total"]; ?></p>
                                </div>
                                <div class="seccion1_parte1">
        
                                    <p><?php echo "Despacho: ".$P["tipoDespacho"]; ?></p>
                                    <p><?php echo $P["estado_orden"]; ?></p>
                                </div>
                                <div class="seccion1_parte1">
                                    <?php if(isset($P["Direccion"])){?>
                                        <p><?php echo "Envío: ".$P["Direccion"]." - ".$P["Distrito"]; ?></p>
                                    <?php } ?>
                                </div>

                                <?php if(isset($P["tipoPago"])){ ?>
                                    <div class="seccion1_parte1">
                                        <p><?php echo $P["tipoPago"]; ?></p>
                                        <p><?php echo $P["tipoPago"]; ?></p>
                                    </div>
                                <?php } ?>
                                <?php if(isset($P["tipoPago"])){ ?>
                                    <div class="seccion1_parte1">
                                        <p><?php echo $P["tiempoTotalEntrega"]; ?></p>
                                    </div>
                                <?php } ?>  
                                
                                <div class="seccion1_parte1">
                                    <?php if($P["estado_orden"]=="Pendiente"){ ?>
                                        <button class="btn_Cancelar" value="<?php echo $P["id_Orden"]; ?>">Cancelar</button>
                                    <?php } ?>

                                </div> 
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
            <div id="bloque_MetodoPago">
                <div id="seccion_Pago">
                    <form id="form_Pago" method="POST">
                        <div>
                            <label for="select_TipoPago">Método de pago: </label>
                            <select id="select_TipoPago" name="select_TipoPago">
                                <option value="NA">Seleccione un método de pago</option>
                                <option value="Tarjeta de débito">Tarjeta de débito</option>
                                <option value="Yape">Yape</option>
                            </select>
                        </div>
                        <div id="bloque_TarjetaDebito">
                            <div id="bloque_img">
                                <img id="tarjeta" src="Imagenes/Portal_Pago/tarjetaCredito.png" alt="Tarjeta de débito">
                            </div>
                            <div id="seccion_datos_tarjeta">
                                <div class="bloqueDatos">
                                    <label for="numeroDebito">Número de tarjeta: </label>
                                    <input type="text" name="numeroDebito" id="numeroDebito">
                                </div>
                                
                                <div id="fecha_tarjeta" class="bloqueDatos" >
                                    <label for="fechaDebito">Fecha: </label>
                                    <input type="text" name="fechaDebito" id="fechaDebito"></input>
                                </div>
                                <div id="csv_tarjeta" class="bloqueDatos" >
                                    <label for="csvDebito">CSV: </label>
                                    <input type="text" name="csvDebito" id="csvDebito"></input>
                                </div>
                                
                                <div class="bloqueDatos">
                                    <label for="nombreDebito">Nombre: </label>
                                    <input type="text" name="nombreDebito" id="nombreDebito"></input>
                                </div>

                                <div class="bloqueDatos">
                                    <label for="apellidosDebito">Apellidos: </label>
                                    <input type="text" name="apellidosDebito" id="apellidosDebito"></input>
                                </div>
                            </div>
                        </div>

                        <div id="bloque_Yape">
                            <div id="bloque_img_Yape">
                                <img id="yape" src="Imagenes/Portal_Pago/yape.jpg" alt="QR Yape">
                            </div>
                            <div id="bloque_codigo">
                                <label for="codigoPago_Yape">Codigo de pago: </label>
                                <input type="text" name="codigoPago_Yape" id="codigoPago_Yape"></input>
                            </div>
                        </div>
                        <div id="bloque_btnPago">
                            <button type="submit" id="btn_Pagar" name="btn_Pagar" value="<?php echo $data["Pedidos"][0]["id_Orden"];?>">Pagar</button>
                        </div>
                    </form>
                </div>
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