<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <link rel="stylesheet" href="Style/Login_Style.css">

    <script src="JavaScript/Login_Ajax.js"></script>

    <title>Login - CleanShoes</title>
</head>
<body>
    <main>
        <div id="bloque_ImgCleanShoes">
            <div>
                <a href="index.php"><img src="Imagenes/Login/login.png" alt="Imagen de Clean Shoes"></a>
            </div> 
        </div>
        <div id="bloque_Login">
            <div id="bloqueGeneral_Form">
                <form id="form_Login" method="post"> 
                    <div id="bloque_ImgUsuarios">
                        <img src="Imagenes/Login/Usuarios.png" alt="Usuarios">
                    </div>
                    <div class="bloqueForm">
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" id="usuario" placeholder="Ingrese su usuiaro">
                    </div>
                    
                    <div class="bloqueForm">
                        <label for="contraseña">Contraseña:</label>
                        <input type="password" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña">
                    </div>
                    <div>
                        <input type="submit" name="btn_Login" id="btn_Login" value="Iniciar Sesión">
                    </div>
                    <div>
                    <p>¿No tienes una cuenta?</p>
                        <a href="index.php?c=Cliente_Controller&a=RegistrarNuevo">¡Regístate!</a>
                    </div>
                </form>

            </div>
            
        </div>
    </main>
</body>
</html>