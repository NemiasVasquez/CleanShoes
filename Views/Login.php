<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'Plantillas/Favicon.php'; ?>

    <title>Login - CleanShoes</title>
</head>
<body>
    <main>
        <div>
            <img src="Imagenes/Login/login.png" alt="Imagen de Clean Shoes">
        </div>
        <div>
            <form id="form_Login" method="post"> 
                <img src="Imagenes/Login/Usuarios.png" alt="Usuarios">
                <div>
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario">
                </div>
                
                <div>
                    <label for="contraseña">Contraseña:</label>
                    <input type="text" name="contraseña" id="contraseña">
                </div>
                <div>
                    <input type="submit" name="btn_Login" id="btn_Login" value="Iniciar Sesión">
                </div>
            </form>
            <div>
                <p>¿No tienes una cuenta?</p>
                <a href="index.php?c=Cliente_Controller&a=RegistrarNuevo">¡Regístate!</a>
            </div>
        </div>
    </main>
</body>
</html>