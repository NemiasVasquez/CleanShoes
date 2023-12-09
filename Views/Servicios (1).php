<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <link rel="stylesheet" href="Style/Servicios_Style.css">

    <title>Servicios / Clean Shoes</title>
</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>
    <main>
        <div class="row caja-General">
            <div class="bloque_Imagenes">
                <div class="col-3 col-s-6 col-m-6 col-l-3 caja-zapatilla-1">
                    <img src="Imagenes/Servicios/zapatilla.png" alt="Zapatilla azul con rojo">
                </div>

                <div class="col-3 col-s-6 col-m-6 caja-zapatilla-l">
                    <img src="Imagenes/Servicios/zapatillas2-PhotoRoom.png-PhotoRoom.png" alt="Zapatilla roja">
                </div>

                <div class="col-3 col-s-6 col-m-6 caja-zapatilla-l">
                    <img src="Imagenes/Servicios/zapatillas3-PhotoRoom.png-PhotoRoom.png" alt="Zapatilla azul con rojo y fondo crema">
                </div>
            </div>

            <div class="bloque_Servicios">
                <?php foreach($data["Servicios_Principales"] as $SP) {?>
                    <div class="interior">
                        <div class="col-3 col-s-6 col-m-6 col-l-3 caja-servicio">
                            <div class="cajita-tituloLavado">
                                <h2><?php echo $SP["nombre"]; ?></h2>
                            </div>

                            <div class="cajitainfo-lavado">
                                <div class="cajita-precio">
                                    <h2> s/<?php echo $SP["precio"]; ?>.00</h2>
                                </div> 
                                <div class="cajita-descripcion">
                                    <p>
                                        <?php echo $SP["tiempo_estimado_entrega"] ?> días hábiles
                                    </p>
                                    <br>
                                    <p> ----------------------------------- </p>
                                    <br>
                                    <p>
                                        <?php echo $SP["descripcion_Simple"] ?>
                                    </p>
                                    <ul>
                                    <?php foreach ($SP["Descripcion"] as $P){  ?>
                                        <li> <?php echo $P["nombre"] ?></li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                
                            </div>
                            <div class="cajita-reservarServicio" >
                                <a href=""><h2>Reservar <br> Servicio</h2></a>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
            
        </div>

        <div class="row">
            <div class="interior seccion_adicionales">
                <div class="col-4 caja-imagenAdicional col-l-4">
                    <div class="cajita-adicional">
                        <img id="imagen-adicional" src="Imagenes/Servicios/adicionales.jpg" alt="">
                    </div>
                </div>
                <div class="col-8 caja-adicionales col-l-8">
                    <div class="cajita-tituloLavado-2">
                        <h2>SERVICIOS ADICIONALES</h2>
                    </div>
                    <div class="cajita-lista-adicional">
                        <table>
                            <?php foreach ($data["Servicios_Adicionales"] as $SA){ ?>
                                <tr>
                                    <td><li id="text-lista"><?php echo $SA["nombre"]." ". $SA["descripcion_Simple"]  ?></li></td>
                                    <td> ................................. </td>
                                    <td class="precio">s/<?php echo $SA["precio"] ?>.00</tr>
                                </tr>
                           <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <aside class="row">
            <?php include 'Plantillas/Enlaces.php'; ?>
        </aside>
    </main>
    <footer>
        <?php include 'Plantillas/Footer.php'; ?>
    </footer>
</body>
</html>