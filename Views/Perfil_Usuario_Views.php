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
    <div id="bloque_Main">
        <main>  
            <div id="bloque_Datos">
                <div>
                    <img src="Imagenes/Perfil_Usuario/Usuario.png" alt="Imagen del usuario">
                </div>
                <div>
                    <P >Nombres:</P>
                    <p id="nombre_Perfil"><?php echo $data["Cliente"]["nombres"] ?></p>
                </div>
                <div>
                    <P>Apellidos:</P>
                    <p id="apellidos_Perfil" ><?php echo $data["Cliente"]["apellidos"] ?></p>
                </div>
                <div>
                    <P>Usuario:</P>
                    <p id="usuario_Perfil"><?php echo $data["Cliente"]["usuario"] ?></p>
                </div>
    
            </div>
            <div id="bloque_General_Actualizar">
                <div id="bloque_ActualizaDatos">
                    <div>
                        <h2>Actualiza tus datos</h2>
                    </div>
                    <div id="bloque_Formulario_ActualizaDatos">
                        <form id="form_ActualizarDatos" method="post" >
                            <div id="bloque_Seccion_form">
                                <div>
                                    <div class="bloqueForm">
                                        <div class="input_Completo" >
                                            <label for="nombres">Nombres:</label>
                                            <input type="text" name="nombres" id="nombres" value="<?php if($data["Cliente"]["nombres"]){ echo $data["Cliente"]["nombres"];} ?>">
                                        </div>
                                    </div>

                                    <div class="bloqueForm">
                                        <div class="input_Completo">
                                            <label for="apellidos">Apellidos:</label>
                                            <input type="text" name="apellidos" id="apellidos" value="<?php if($data["Cliente"]["apellidos"]){ echo $data["Cliente"]["apellidos"];} ?>">                           
                                        </div>
                                    </div>
                                    
                                    <div class="bloqueForm">
                                        <div class="input_Completo">
                                            <label for="celular">Celular:</label>
                                            <input type="text" name="celular" id="celular" value="<?php if($data["Cliente"]["celular"]){ echo $data["Cliente"]["celular"];} ?>">
                                        </div>
                                    </div>
                                    <div class="bloqueForm">
                                        <div class="input_Completo">
                                            <label for="correo">Correo:</label>
                                            <input type="email" name="correo" id="correo" value="<?php if($data["Cliente"]["correo"]){ echo $data["Cliente"]["correo"];} ?>">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="bloqueForm">
                                        <div class="input_Completo">
                                            <label for="usuario">Usuario:</label>
                                            <input type="text" name="usuario" id="usuario" value="<?php if($data["Cliente"]["usuario"]){ echo $data["Cliente"]["usuario"];} ?>">
                                        </div>
                                    </div>
                                
                                    <div class="bloqueForm">
                                        <div class="input_Completo">
                                            <label for="contraseña">Contraseña:</label>
                                            <input type="password" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña">
                                        </div>
                                    </div>

                                    <div class="bloqueForm">
                                        <div class="input_Completo">
                                            <label id="label_Contraseña2" for="contraseña2">Confirmar contraseña:</label>
                                            <input type="password" name="contraseña2" id="contraseña2" placeholder="Confirme su contraseña">
                                        </div>
                                    </div>
                                    <div class="bloqueForm">
                                        <div id="bloque_btn_actualizarDatos" >
                                            <input type="submit" class="btn" name="btn_Actualizar" id="btn_Actualizar" value="Actualizar Datos">
                                        </div>
                                    </div>
                                       
                                </div>
                               
                            </div>

                        </form>
                    </div>
                </div>

                <div id="bloque_2Seccion">
                    <div id="bloque_actualizaDireccion">
                        <div>
                            <h2>Actualiza tu dirección</h2>
                        </div>
                        
                        <form id="form_ActualizarDireccion" method="post" >
                            <div>
                                <label for="Selector_Direccion">Seleccione su dirección:</label>
                                <select name="Selector_Direccion" id="Selector_Direccion">
                                    <option value="NA">Elija una dirección</option>
                                </select>
                            
                            </div>
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
                            <div class="bloque_SubmitForm">
                                <input type="submit"  class="btn" name="btn_actualizarDirecion" id="btn_actualizarDirecion" value="Actualizar dirección">
                            </div>
                        </form>
                    </div>

                    <div id="bloque_Formulario_Direcciones">
                        <div>
                            <h2>Añadir nueva Dirección</h2>
                        </div>
                        <div id="bloque_btn_AgregarDireccion">
                            <button class="btn_agregarOcultar" name="btn_AgregarDireccion" id="btn_AgregarDireccion" >Agregar</button>
                            <button class="btn_agregarOcultar" name="btn_OcultarDireccion" id="btn_OcultarDireccion" >Ocultar</button>
                        </div>
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
                                <input type="submit"  class="btn" name="btn_añadir" id="btn_añadir" value="Añadir Nueva dirección">
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        

        </main>
    </div>
    <aside class="interior"></aside>
        <?php include 'Plantillas/Enlaces.php'; ?>
    </aside>
    <footer>
        <?php include 'Plantillas/Footer.php'; ?>
    </footer>
</body>
</html>