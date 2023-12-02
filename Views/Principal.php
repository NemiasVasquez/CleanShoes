<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="JavaScript/JsInicio.Js"></script>

    <link rel="stylesheet" href="Style/Plantilla_Style.css">
    <link rel="stylesheet" href="Style/Principal_Style.css">
    <title>Clean Shoes</title>
</head>
<body>

    <header>
        <?php include 'Plantillas/Header.html'; ?>
    </header>

    <main>
        <section id="section1" class="row">
            <div id="contenedorSec1">
                <div id="bloqueSection1" class="slider-container">
                        <div class="slick-slide"><img src="Imagenes/Inicio/seccion1/4.png" alt="Imagen 1"></div>
                        <div class="slick-slide"><img src="Imagenes/Inicio/seccion1/2.png" alt="Imagen 2"></div>
                        <div class="slick-slide"><img src="Imagenes/Inicio/seccion1/3.png" alt="Imagen 3"></div>
                        <div class="slick-slide"><img src="Imagenes/Inicio/seccion1/4.png" alt="Imagen 4"></div>
                        <div class="slick-slide"><img src="Imagenes/Inicio/seccion1/5.png" alt="Imagen 4"></div>
                        <div class="slick-slide"><img src="Imagenes/Inicio/seccion1/6.png" alt="Imagen 4"></div>
                </div>
                <div id="contenidoImagenInicio">
                    <div id="textoSect1" class="col-">
                        <h2>Somos Clean Shoes</h2>
                        <h2>Especialistas en lavado de todo <br> tipo de zapatillas</h2>
                    </div>
                    <div id="btnReservarInicio" class="col-">
                        <a href="ReservarServicio.html">Reservar Servicio</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="section2" class="row">
            <div id="s2_grupoImagenes" class="col-6">
                <div id="s2_img1">
                    <img src="Imagenes/Inicio/seccion2/2.jpg" alt="Imagen pequeña zapatillas">
                </div>
                <div id="s2_textoPromo">
                    <p>¡ 3x2 !</p>
                </div>
            </div>
            <div id="s2_oferta" class="col-6" style="text-align: center;">
                <div id="s2_cajaOferta" class="col-">
                    <h5>3x2 EN LAVADOS</h5>
                </div>
                <div>
                    <p>Descubre nuestras</p>
                    <p>MEJORES PROMOCIONES</p>
                </div>
                <div id="btn_s2">
                    <a href="Promociones.html">INGRESA AQUÍ</a>
                </div>
            </div>
        </section>
        <section id="section3" >
            <div id="s3_fondo"  class="row">
                <div class="col-">
                    <h1>¿Cómo funciona?</h1>
                </div>
                <div id="grupoCajas_s3">
                    <div class="caja_s3 col-3">
                        <div>
                            <img src="Imagenes/Inicio/seccion3/icons8-calendario-100.png" alt="Imagen calendario">
                            <h2>RESERVAR EL SERVICIO</h2>
                        </div>
                        <p>Contáctanos a través de nuestra web o déjanos un mensaje en nuestras redes sociales.</p>
                    </div>
                    <div class="caja_s3 col-3">
                        <div>
                            <img src="Imagenes/Inicio/seccion3/icons8-scooter-100.png" alt="Imagen Moto Lineal">
                            <h2>RECOJO DEL CALZADO</h2>
                        </div>
                        <p>Confirmanos la reserva y enviamos personal a recoger tus pares o los recibimos en la tienda.</p>
                    </div>
                    <div class="caja_s3 col-3">
                        <div>
                            <img src="Imagenes/Inicio/seccion3/icons8-zapatos-veganos-100.png" alt="Limpieza Zapatilla">
                            <h2>LIMPIEZA</h2>
                        </div>
                        <p>Uno de nuestros colaboradores especializados realiza la limpieza de calidad del par.</p>
                    </div>
                    <div class="caja_s3 col-3">
                        <div>
                            <img src="Imagenes/Inicio/seccion3/icons8-caja-128.png" alt="Icono Entrega">
                            <h2>ENTREGA</h2>
                        </div>
                        <p>Tus pares limpios serán empaquetados y entregados por nuestro personal, previa coordinación.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <aside>
        <?php include 'Plantillas/Enlaces.html'; ?>
    </aside>
    <footer>
        <?php include 'Plantillas/Footer.html'; ?>
    </footer>
</body>
</html>