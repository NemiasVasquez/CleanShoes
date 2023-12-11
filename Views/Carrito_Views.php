<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>

    <link rel="stylesheet" href="Style/Carrito_Style.css">
    <title>Carrito de comnpras - CleanShoes</title>
</head>
<body>

    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>

    <main>
        <?php if(isset($data["ServicioVenta"]) && $data["ServicioVenta"] != false ){ ?>
            <div id="bloque_TablaVenta">
            <table class="table  text-center">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">NOMBRE</th>
                        <th class="text-center" scope="col">CATEGORÍA</th>
                        <th class="text-center" scope="col">CANTIDAD</th>
                        <th class="text-center" scope="col">PRECIO UNI.</th>
                        <th class="text-center" scope="col">SUBTOTAL</th>
                        <th class="text-center" scope="col">ACCIONES</th>
                        <th class="text-center" scope="col"></th>
                    </tr>
                </thead>
                <?php $contador=1 ?>
           
                <?php foreach ($data["ServicioVenta"] as $S): ?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo $contador ?></th>
                            <td><?php echo $S["id_Servicio"]; ?></td>
                            <td><?php echo $S["nombre"]; ?></td>
                            <td><?php echo $S["categoria"]; ?></td>
                            <td><?php echo $S["cantidad"]; ?></td>
                            <td><?php echo $S["precio"]; ?></td>
                            <td><?php echo ($S["precio"]*$S["cantidad"]); ?></td>
                            <td>botoncitos rojos</td>
                        </tr>
                        <?php $contador++; ?>
                <?php endforeach; ?>
            </table>
            </div>
            <div id="seccion_detalleVenta">
                <div id="bloque_Indicaciones">
                    <label>INDICACIONES ADICIONALES (OPCIONAL)</label>
                    <textarea name="textarea_Indicaciones" rows="10" cols="50">Déjanos un mensaje</textarea>
                </div>
                <div id="bloque_DetalleTotal">
                    <div>
                        <h2>SUB TOTAL:</h2>
                        <h2 id="subTotalPago"></h2>
                    </div>
                    <div>
                        <h2>IGV:</h2>
                        <h2 id="IGV"></h2>
                    </div>
                    <div>
                        <h2>TOTAL A PAGAR:</h2>
                        <h2 id="totalPago"></h2>
                    </div>
                </div>
                <div>
                    <button name="btn_Pagar" id="btn_Pagar">Ir a pagar</button>
                </div>
            </div>
        <?php } else { ?>
            <div>
                <h3>No tiene productos en su carrito</h3>
            </div>
        <?php }?>

    </main>
    <aside>
        <?php include 'Plantillas/Enlaces.php'; ?>
    </aside>
    <footer>
        <?php include 'Plantillas/Footer.php'; ?>
    </footer>
</body>
</html>