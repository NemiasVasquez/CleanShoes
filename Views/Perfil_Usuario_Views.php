<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>
    <title><?php echo $_SESSION["nombres"].$_SESSION["apellidos"]; ?> - Clean Shoes</title>

    <script type="text/javascript" src="JavaScript/Actualizacion_Ajax.js"></script>
    
</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>

    <main>
        <h1>Usuario: <?php echo $_SESSION["nombres"].$_SESSION["apellidos"]; ?></h1>
        <?php var_dump($data["Cliente"]); ?>
    </main>
    

    <footer>
        <?php include 'Plantillas/Footer.php'; ?>
    </footer>
</body>
</html>