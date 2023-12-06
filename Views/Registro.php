<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>
    
    <link rel="stylesheet" href="Style/Login_Style.css">
    <title>Registro - Clean Shoes</title>

</head>
<body>

    <main>
        <div>
            <div id="bloque_img">
                <img src="Imagenes/Login/login.png" alt="Imagen de la empresa CleanShoes">
            </div>
            <div id="bloque_Formulario">
                <form id="form_Registro" method="post" >
                    <div class="bloqueForm">
                        <h2> Regístrate</h2>
                    </div>
                    <div class="bloqueForm">
                        <div >
                            <label for="nombres">Nombres:</label>
                            <input type="text" name="nombres" id="nombres" placeholder="Ingrese sus nombres">
                        </div>
                        <div>
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos">
                        </div>
                    </div>
                    <div class="bloqueForm">
                        <div>
                            <label for="dni">Dni:</label>
                            <input type="text" name="dni" id="dni" placeholder="Ingrese su DNI">
                        </div>
                        <div>
                            <label for="celular">Celular:</label>
                            <input type="text" name="celular" id="celular" placeholder="Ingrese su celular">
                        </div>
                    </div>
                    <div class="bloqueForm">
                        <div class="input_Completo">
                            <label for="correo">Correo:</label>
                            <input type="email" name="correo" id="correo" placeholder="Ingrese su correo">
                        </div>
                    </div>
                    <div class="bloqueForm">
                        <div class="input_Completo">
                            <label for="direccion">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" placeholder="Ingrese su dirección">
                        </div>
                    </div>
                    <div class="bloqueForm">
                        <div>
                            <label for="referencia">Referencia:</label>
                            <input type="text" name="referencia" id="referencia" placeholder="Ingrese una referencia">
                        </div>
                        <div>
                            <label for="distrito">Distrito:</label>
                            <input type="text" name="distrito" id="distrito" placeholder="Ingrese su distrito">
                        </div>
                    </div>
                    <div class="bloqueForm">
                        <div>
                            <label for="contraseña">Contraseña:</label>
                            <input type="password" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña">
                        </div>
                        <div>
                            <label for="contraseña2">Confirmar contraseña:</label>
                            <input type="password" name="contraseña2" id="contraseña2" placeholder="Confirme su contraseña">
                        </div>
                    </div>
                    <div >
                        <input type="submit" name="btn_Registrar" id="btn_Registrar" value="Registrarme">
                    </div>
                </form>
            </div>
        </div>
    </main>
  
</body>
</html>