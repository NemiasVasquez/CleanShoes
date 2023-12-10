<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <link rel="stylesheet" href="Style/Servicios_Style.css">

    <script type="text/javascript" src="JavaScript/Servicios_Ajax.js"></script>

    <title>Servicios / Clean Shoes</title>
</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>
    <main>
        <div class="row caja-General">
            <div id="bloque_Filtros">
                <div id="contenedor_Filtros">
                    <div>
                        <h1>Filtros</h1>
                    </div>
                    <form id="form_Filtro" method="POST">
                        <div class="bloque_Filtro">
                            <h2>Categorias:</h2>
                            <div >
                                <label for="check_Principal">Principales</label>
                                <input type="checkbox" name="check_Principal" id="check_Principal">
                            </div>
                            <div>
                                <label for="check_Secundario">Secundarios</label>
                                <input type="checkbox" name="check_Secundario" id="check_Secundario">
                            </div>
                        </div>
                        <div class="bloque_Filtro">
                            <h2>Ordenar Servicios</h2>
                            <select name="select_Orden" id="select_Orden">
                                <option value="NA">Elija un orden.</option>
                                <option value="Menor">Menor a mayor precio.</option>
                                <option value="Mayor">Mayor a menor precio.</option>
                            </select>
                        </div>
                        <div class="bloque_Filtro">
                            <h2>Establecer precios</h2>
                            <div>
                                <label for="rango_Minimo">Valor mínimo:</label>
                                <input type="range" name="rango_Minimo" id="rango_Minimo" min="15" max="60" step="5" value="15"/>
                                <output for="rango_Minimo" name="indicador_Minimo" id="indicador_Minimo"></output>
                            </div>
                            <div>
                                <label for="rango_Maximo">Valor Máximo:</label>
                                <input type="range" name="rango_Maximo" id="rango_Maximo" min="15" max="60" step="5" value="60"/>
                                <output for="rango_Maximo" name="indicador_Maximo" id="indicador_Maximo"></output>
                            </div>
                        </div>
                        <div id="bloque_btn">
                            <input type="submit" value="Aplicar" name="btn_Aplicar" id="btn_Aplicar">
                        </div>
                    </form>
                </div>
            </div>
            <div id="contenido_Servicios">
                <div class="bloque_Titulo_Seccion">
                    <h2>Servicios Principales:</h2>
                </div>
                <div class="bloque_Servicios">
                    <?php foreach($data["Servicios_Principales"] as $SP) {?>
                        <div class="caja-servicio">
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
                                    <p> ----------------------------- </p>
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
                    <?php }?>
                </div>
                <div class="bloque_Titulo_Seccion">
                    <h2>Servicios Secundarios:</h2>
                </div>
                <div class="bloque_Servicios">
                    <?php foreach($data["Servicios_Adicionales"] as $SS) {?>
                        <div class="caja-servicio">
                            <div class="cajita-tituloLavado">
                                <h2>Servicio Adicional</h2>
                            </div>
                            <div class="cajitainfo-Servicio_Adicional">
                                <div class="cajita-nombre">
                                    <h2><?php echo $SS["nombre"]; ?></h2>
                                </div>
                                <div class="cajita-descripcion">
                                    <p>
                                        <?php echo $SS["descripcion_Simple"] ?>
                                    </p> 
                                </div>
                                <div class="cajita-precio_Servicio_Adicional">
                                    <h2> s/<?php echo $SS["precio"]; ?>.00</h2>
                                </div> 
                            </div>
                            <div class="cajita-reservarServicio" >
                                <a href=""><h2>Reservar <br> Servicio</h2></a>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>  
        </div>
    </main>
    <aside class="row">
        <?php include 'Plantillas/Enlaces.php'; ?>
    </aside>
    <footer>
        <?php include 'Plantillas/Footer.php'; ?>
    </footer>
</body>
</html>