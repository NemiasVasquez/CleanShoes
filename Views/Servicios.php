<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <link rel="stylessheet" href="Style/Servicios_Style.css">

    <title>Servicios / Clean Shoes</title>
</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>
    <main>
<?php echo var_dump($data["Servicio"]) ?>      
            <div class="row caja-General">
                <div>
                <div class="col-3 col-s-6 col-m-6 col-l-3 caja-zapatilla-1">
                        <div class="caja-zapatilla" id="imagen-zapatilla">
                            <img src="Imagenes/Servicios/zapatilla.png" alt="">
                        </div>
                    </div>

                    <div class="col-3 col-s-6 col-m-6 caja-zapatilla-l">
                        <div class="caja-zapatilla" id="imagen-zapatilla">
                            <img src="Imagenes/Servicios/zapatillas2-PhotoRoom.png-PhotoRoom.png" alt="">
                        </div>
                    </div>

                    <div class="col-3 col-s-6 col-m-6 caja-zapatilla-l">
                        <div class="caja-zapatilla" id="imagen-zapatilla ">
                            <img src="Imagenes/Servicios/zapatillas3-PhotoRoom.png-PhotoRoom.png" alt="">
                        </div>
                </div>

                <?php foreach($data["Servicio"] as $S) {?>

                    <div class="interior">
                        <div class="col-3 col-s-6 col-m-6 col-l-3 caja-servicios">
                            <div class="cajita-tituloLavado">
                                <h2><?php echo $S["nombre"]; ?></h2>
                            </div>

                            <div class="cajitainfo-lavado">
                                <div class="cajita-precio">
                                    <h2> s/<?php echo $S["precio"]; ?>.00</h2>
                                </div> 
                                <div class="cajita-descripcion">
                                    <p> <?php echo $S["descripcion"] ?></p>
                                </div>
                                
                            </div>
                            <div class="cajita-reservarServicio" >
                                <a href=""><h2>Reservar <br> Servicio</h2></a>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
    
            <div class="row">
                <div class="interior">
                    <div class="col-4 caja-imagenAdicional col-l-4">
                        <div class="cajita-adicional">
                            <img id="imagen-adicional" src="Imagenes/Servicios/adicionales.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-8 caja-adicionales col-l-8">
                        <div class="cajita-tituloLavado">
                            <h2>SERVICIOS ADICIONALES</h2>
                        </div>
                        <div class="cajita-lista-adicional">
                            <table>
                                <tr>
                                    <td><li id="text-lista">Blanqueamiento con UV de medida suela</li></td>
                                    <td>         </td>
                                    <td id="precio">S/20.00</tr>
                                </tr>
                                <tr>
                                    <td><li id="text-lista">Repintado de zapatillas (parte pequeña)</li></td>
                                    <td>         </td>
                                    <td id="precio">S/19.00</td>
                                </tr>
                                <tr>
                                    <td><li id="text-lista">Repintado de zapatillas (parte grande)</li></td>
                                    <td>         </td>
                                    <td id="precio">S/29.00</td>
                                </tr>
                                <tr>
                                    <td><li id="text-lista">Repintado de zapatilla (todo el calzado)</li></td>
                                    <td>         </td>
                                    <td id="precio">S/30.00</td>
                                </tr>
                                <tr>
                                    <td><li id="text-lista">Cambio de color</li></td>
                                    <td>         </td>
                                    <td id="precio">S/59.00</td>
                                </tr>
                                <tr>
                                    <td><li id="text-lista">Restauración de gamuza</li></td>
                                    <td>         </td>
                                    <td id="precio">S/10.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <footer>
        <?php include 'Plantillas/Footer.php'; ?>
    </footer>
</body>
</html>