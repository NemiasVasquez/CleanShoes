<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'Plantillas/Favicon.php'; ?>
    <?php include 'Plantillas/Links.php'; ?>
    <title><?php echo $_SESSION["nombres"]." ".$_SESSION["apellidos"]; ?> - Clean Shoes</title>

    <link rel="stylesheet" href="Style/Perfil_Usuario_Style.css">
    <script type="text/javascript" src="JavaScript/Perfil_Usuario_Ajax.js"></script>
    
</head>
<body>
    <header>
        <?php include 'Plantillas/Header.php'; ?>
    </header>

    <main>
        <h1>Usuario: <?php echo $_SESSION["nombres"]." ".$_SESSION["apellidos"]; ?></h1>
        <?php var_dump($data["Cliente"]); ?>


        <div id="bloque_ActualizaDatos"></div>
            <div>
                <h2>Actualiza tus datos</h2>
            </div>
            <div id="bloque_Formulario_ActualizaDatos">
                <form id="form_ActualizarDatos" method="post" >
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
                            <input type="text" name="dni" id="dni" disabled placeholder="Ingrese su DNI">
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
                        <input type="submit" name="btn_Actualizar" id="btn_Actualizar" value="Actualizar Datos">
                    </div>
                </form>
            </div>
        </div>
        <div id="bloque_Direccion"></div>
            <div>
                <h2>Añadir nueva Dirección</h2>
            </div>
            <div id="bloque_Formulario_Direcciones">
                <form id="form_AñadirDireccion" method="post" >
                    <div class="bloqueForm">
                        <div class="input_Completo">
                            <label for="direccion_añadir">Dirección:</label>
                            <input type="text" name="direccion_añadir" id="direccion_añadir" placeholder="Ingrese su dirección">
                        </div>
                    </div>
                    <div class="bloqueForm">
                        <div>
                            <label for="referencia_añadir">Referencia:</label>
                            <input type="text" name="referencia_añadir" id="referencia_añadir" placeholder="Ingrese una referencia">
                        </div>
                        <div>
                            <label for="distrito_añadir">Distrito:</label>
                            <input type="text" name="distrito_añadir" id="distrito_añadir" placeholder="Ingrese su distrito">
                        </div>
                    </div>
                    <div>
                        <input type="submit" name="btn_añadir" id="btn_añadir" value="Añadir Nueva dirección">
                    </div>
                </form>

            </div>
            <div>
                <div>
                    <h2>Actualiza tu dirección</h2>
                </div>
                <label for="Selector_Direccion">Seleccione su dirección:</label>
                <select name="Selector_Direccion" id="Selector_Direccion">
                    <option value="NA">Elija una dirección</option>
                </select>
                <form id="form_ActualizarDireccion" method="post" >
                    <div class="bloqueForm">
                        <div class="input_Completo">
                            <label for="direccion_actualizar">Dirección:</label>
                            <input type="text" name="direccion_actualizar" id="direccion_actualizar" placeholder="Ingrese su dirección">
                        </div>
                    </div>
                    <div class="bloqueForm">
                        <div>
                            <label for="referencia_actualizar">Referencia:</label>
                            <input type="text" name="referencia_actualizar" id="referencia_actualizar" placeholder="Ingrese una referencia">
                        </div>
                        <div>
                            <label for="distrito_actualizar">Distrito:</label>
                            <input type="text" name="distrito_actualizar" id="distrito_actualizar" placeholder="Ingrese su distrito">
                        </div>
                    </div>
                    <div>
                        <input type="submit" name="btn_actualizarDirecion" id="btn_actualizarDirecion" value="Actualizar dirección">
                    </div>
                </form>
            </div>
        </div>

    </main>

    <footer>
        <?php include 'Plantillas/Footer.php'; ?>
    </footer>
</body>
</html>