<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <link rel="stylesheet" href="Style/Servicios_Style.css">

    <title>Promociones / Clean Shoes</title>
</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>
    <main>
        <div class="row caja-General_Promociones">
            <div class="bloque_Servicios_Promociones">
                <?php foreach($data["Promociones"] as $SP) {?>
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
                                <a href=""><h2>Reservar <br> Promoción</h2></a>
                            </div>
                        </div>
                    </div>
                <?php }?>
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