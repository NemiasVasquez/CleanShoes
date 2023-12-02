<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel = "icon" type="image/x-icon" href="/img/favicon.ico">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="JavaScript/JsQuienesSomos.js"></script>

    <link rel="stylesheet" href="Style/Plantilla_Style.css">
    <link rel="stylesheet" href="Style/QuienesSomos_Style.css">

    <title>¿Quiénes Somos?</title>

</head>
<body>
    <div class ="contenedor">
        <header>
            <?php include 'Plantillas/Header.php'; ?>
        </header>

        <main>
            <div id="seccion1" class="row">
                <div class="interior">
                    <div class="col-6">
                        <div id="cajaTexto">
                            <h2>¿Quiénes Somos?</h2>
                            <p>Somos una empresa 100% peruana que tuvo sus inicios en el año 2019, dedicada al lavado y cuidado de calzado casual y deportivo. Especializados en el tratamiento de zapatillas.</p>
                            <p>Contamos con personal experto y entrenado para el cuidado de tu calzado con múltiples servicios a cómodos precios en nuestras dos sedes.</p>
                        </div>
                    </div>
        
                    <div class="col-6" id="cajaImg">
                        <img src="Imagenes/QuienesSomos/cuidadoZapatillas.png" alt="Lavado de Zapatillas"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="interior">
                    <div class="cajaJQ">
                        <ul class="tabs">
                            <li><a href="#tab1">Misión</a></li>
                            <li><a href="#tab2">Visión</a></li>
                            <li><a href="#tab3">Valores</a></li>
                        </ul>
        
                        <div class="tabs-seccion">
                            <article id="tab1">
                                <img src="Imagenes/QuienesSomos/mision-u1180.png" class="flotar"/>
                                <p class="txtJQ">Lograr la completa satisfacción de nuestros clientes, cubriendo sus necesidades ante la limpieza de calzado brindando el mejor servicio y haciendo uso de productos de calidad, teniendo en cuenta el cuidado del medio ambiente.</p>
                            </article>

                            <article id="tab2">
                                <img src="Imagenes/QuienesSomos/vision.png" class="flotar"/>
                                <p class="txtJQ">Convertirse en la empresa líder en servicio de limpieza, mantenimiento y cuidado de calzado a nivel nacional, ser reconocidos por brindar un servicio de atención personalizada y ofrecer una experiencia de calidad al momento de la entrega de su calzado.</p>
                            </article>

                            <article id="tab3">
                                <img src="Imagenes/QuienesSomos/valores.png" class="flotar"/>
                                <div class="txtJQ">
                                    <div class="col-6">
                                        <li>Honestidad</li>
                                        <li>Compromiso</li>
                                        <li>Respeto</li>
                                        <li>Confianza</li>
                                    </div>

                                    <div class="col-6">
                                        <li>Respeto</li>
                                        <li>Trabajo en Equipo</li>
                                        <li>Ética</li>
                                        <li>Responsabilidad</li>
                                    </div>
                                </div>
                        
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </main>
       
        <aside class="row">
            <?php include 'Plantillas/Enlaces.php'; ?>
        </aside>
        <footer >
            <?php include 'Plantillas/Footer.php'; ?>
        </footer>
    </div>
</body>
</html>