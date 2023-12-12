<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <link rel="stylesheet" href="Style/Carrito_Style.css">
    <script type="text/javascript" src="JavaScript/Carrito_Ajax.js"></script>
    <title>Carrito de comnpras - CleanShoes</title>
</head>
<body>

    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>

    <main>
        <div>
            <?php if(isset($data["ServicioVenta"]) && $data["ServicioVenta"] != false ){ ?>
                <div id="bloque_TablaVenta">
                    <div id="bloque_Titulo">
                        <h2>Carrito de compras</h2>
                    </div>
                    <table class="table  text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>CATEGORÍA</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO UNI.</th>
                                <th>SUBTOTAL</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <?php $contador=1 ?>
                
                        <?php foreach ($data["ServicioVenta"] as $S): ?>
                                <tr class="tabla_elementos">
                                    <th scope="row"><?php echo $contador ?></th>
                                    <th><?php echo $S["id_Servicio"]; ?></th>
                                    <td><?php echo $S["nombre"]; ?></td>
                                    <td><?php echo $S["categoria"]; ?></td>
                                    <td><?php echo $S["cantidad"]; ?></td>
                                    <td><?php echo $S["precio"]; ?></td>
                                    <td><?php echo ($S["precio"]*$S["cantidad"]); ?></td>
                                    <td id="celda_Acciones">
                                        <img src="Imagenes/Carrito/restar.png" alt="Imagen para restar servicios">
                                        <p id="contadorServicios"></p>
                                        <img src="Imagenes/Carrito/sumar.png" alt="Imagen para sumar servicios">
                                        <img src="Imagenes/Carrito/eliminar.png" alt="Imagen para eliminar un producto">
                                    </td>
                                </tr>
                                <?php $contador++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div id="seccion_detalleVenta">
                    <div id="bloque_Indicaciones">
                        <div>
                            <label>INDICACIONES ADICIONALES (opcional)</label>
                            <textarea name="textarea_Indicaciones" rows="10" cols="50">Déjanos un mensaje</textarea>
                        </div>
                    </div>
                    <div id="bloque_DetalleTotal">
                        <div>
                            <div class="bloque_Precio">
                                <p class="texto_Valor">SUB TOTAL:</p>
                                <p class="bloque_Valor" id="subTotalPago"></p>
                            </div>
                            <div class="bloque_Precio">
                                <p class="texto_Valor">IGV:</p>
                                <p class="bloque_Valor" id="IGV"></p>
                            </div>
                            <div class="bloque_Precio">
                                <p class="texto_Valor">TOTAL A PAGAR:</p>
                                <p class="bloque_Valor" id="totalPago"></p>
                            </div>
                        </div>
                       
                        <div id="bloque_btn_Reservar">
                            <button name="btn_Reservar" id="btn_Reservar">Reservar</button>
                        </div>
                    </div>
                    
                </div>
            <?php } else { ?>
                <div id="bloque_CarroVacio">
                    <div>
                        <h3>No tiene productos en su carrito</h3>
                    </div>
                    <div>
                        <img src="Imagenes/Carrito/carro-vacio.png" alt="Carrito Vacío.">
                    </div>
                </div>
               
            <?php }?>
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