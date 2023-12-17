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
    <main class="interior"></main>
        <div id="bloque_Pedidos">
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
            <div id="bloque_Tabla">
                <table id="tabla_Pedidos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID ORDEN</th>
                            <th>TIPO ENVIO</th>
                            <th>DIRECCION</th>
                            <th>TOTAL</th>
                            <th>FECHA CREACIÓN</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <?php $contador=1; ?>
                    <?php foreach($data["Pedidos"] as $P){ ?>
                        <tr class="tabla_elementos">
                            <th scope="row"><?php echo $contador ?></th>
                            <th><?php echo $P["id_Orden"]; ?></th>
                            <th><?php echo $P["tipoDespacho"]; ?></th>
                            <?php if(isset($P["Direccion"])){?>
                                <th><?php echo $P["Direccion"]." - ".$P["Distrito"]; ?></th>
                            <?php } else { ?>
                                <th> - </th>
                            <?php } ?>
                            <th><?php echo $P["total"]; ?></th>
                            <th><?php echo $P["fecha_creacion"]; ?></th>
                            <th><?php echo $P["estado_orden"]; ?></th>
                            <!--
                            <td id="celda_Acciones">
                                <button class="btn_RestarUnidadServicio" value="<?php ?>"><img src="Imagenes/Carrito/restar.png" alt="Imagen para restar servicios"></button>
                                <p id="contadorServicios"></p>
                                <button class="btn_SumarUnidadServicio" value="<?php ?>"><img src="Imagenes/Carrito/sumar.png" alt="Imagen para sumar servicios"></button>
                                <button class="btn_EliminarServicioCarrito" value="<?php ?>" ><img src="Imagenes/Carrito/eliminar.png" alt="Imagen para eliminar un producto"></button>
                            </td>
                            <!-->
                        </tr>
                        <?php $contadorS =1; ?>
                        <?php foreach($P["Servicios"] as $S ){ ?>
                            <th scope="row"><?php echo $contadorS ?></th>
                            <th><?php echo $S["nombre"]; ?></th>
                            <th><?php echo $S["precio"]; ?></th>
                            <th><?php echo $S["categoria"]; ?></th>
                            <th><?php echo $S["cantidad"]; ?></th>
                            <th><?php echo $S["subTotal"]; ?></th>
                            <?php $contadorS++; ?>
                        <?php } ?>

                        <?php $contador++; ?>
                    <?php } ?>

                </table>
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