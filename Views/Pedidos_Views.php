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
        <div id="bloque_Pedidos"></div>
            <div id="bloque_Tabla"></div>
                <table>
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