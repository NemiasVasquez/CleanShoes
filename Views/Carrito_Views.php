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
            <?php if(isset($_SESSION["id_Cliente"]) && isset($data["ServicioVenta"]) && $data["ServicioVenta"] != false ){ ?>
                <div id="bloque_Titulo">
                        <h2>Carrito de compras</h2>
                </div>
                <div id="bloque_TablaVenta">
                  
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
                                    <td><?php echo "S/".$S["precio"]; ?></td>
                                    <td><?php echo "S/".$S["subTotal"]; ?></td>
                                    <td id="celda_Acciones">
                                        <button class="btn_RestarUnidadServicio" value="<?php echo $S["id_DetalleServicio"] ?>"><img src="Imagenes/Carrito/restar.png" alt="Imagen para restar servicios"></button>
                                        <p id="contadorServicios"></p>
                                        <button class="btn_SumarUnidadServicio" value="<?php echo $S["id_DetalleServicio"] ?>"><img src="Imagenes/Carrito/sumar.png" alt="Imagen para sumar servicios"></button>
                                        <button class="btn_EliminarServicioCarrito" value="<?php echo $S["id_DetalleServicio"] ?>" ><img src="Imagenes/Carrito/eliminar.png" alt="Imagen para eliminar un producto"></button>
                                    </td>
                                </tr>
                                <?php $contador++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <form id="form_Pedido">
                    <div id="bloque_DespachoDireccion">
                        <div class="bloque_Select" id="selectTipoDespacho">
                            <label for="selector_TipoDespacho">Tipo de despacho:</label>
                            <select id="selector_TipoDespacho" name="selector_TipoDespacho">
                                <option value="NA">Seleccione el tipo de despacho.</option>
                                <option value="Domicilio">Despacho en domicilio.</option>
                                <option value="Tienda">Retiro en tienda.</option>
                            </select>
                        </div>
                        

                        <div class="bloque_Select" id="selectDireccion">
                            <label for="Selector_Direccion">Seleccione su dirección :</label>
                            <select name="Selector_Direccion" id="Selector_Direccion">
                                <option value="NA">Elija una dirección</option>
                                <?php $contador=1; ?>
                                <?php foreach($data["Direccion"] as $D){ ?>
                                    <option value="<?php echo $D["id_Direccion_Envio"] ?>">
                                        <?php echo $contador. " -> ".$D["direccion"]." - ".$D["distrito"];?>
                                    </option>
                                    <?php $contador++; ?>
                                <?php } ?>
                            </select>
                        </div>
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
                                <input type="submit" name="btn_Reservar" id="btn_Reservar" value="Reservar"></input>
                            </div>
                        </div>
                    </div>
                </form>
                  


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