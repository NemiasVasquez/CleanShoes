<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'Plantillas/Favicon.php'; ?>

    <?php include 'Plantillas/Links.php'; ?>

    <link rel="stylesheet" href="Style/Resultados_Style.css">

    <title>Resultados / Clean Shoes</title>
</head>
<body>
    <div class ="contenedor">
        <header>
            <?php include 'Plantillas/Header.php'; ?>
        </header>
        <main id="resultado" class="contenedor interior">
            <input type="radio" name="filtroLavado" id="btnSimple" checked="yes">
            <input type="radio" name="filtroLavado" id="btnEstandar" >
            <input type="radio" name="filtroLavado" id="btnPremium">
            <div id=bloqueEtiquetasResultado class="row">
                <div id="bloqueSimple" class="bloqueEtiquetaR">
                    <label id="titutloSimple" class="etiquetaR" for="btnSimple">LAVADO SIMPLE</label>
                </div>
                <div id="bloqueEstandar" class="bloqueEtiquetaR">
                    <label id="titutloEstandar" class="etiquetaR" for="btnEstandar">LAVADO ESTÁNDAR</label>
                </div>
                <div id="bloquePremium" class="bloqueEtiquetaR">
                    <label id="titutloPremium" class="etiquetaR" for="btnPremium">LAVADO PREMIUM</label>
                </div>
            </div>

            <div id="bloqueResultados" class="row">
                <div class="col-m-6">
                    <div class="bloqueResultadoLavado">
                        <div class="bloqueTituloAntes ">
                            <h4 class="tituloAntesDespues">ANTES</h4>
                        </div>
                        <div class="cajaImgResultados">
                            <img class="simple" src="Imagenes/Resultados/Lavado Simple/1 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="simple" src="Imagenes/Resultados/Lavado Simple/1 muestra/2.jpg" alt="Foto de zatapillas después del servicio">

                            <img class="estandar"  src="Imagenes/Resultados/Lavado Estándar/2 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="estandar"  src="Imagenes/Resultados/Lavado Estándar/2 muestra/2.jpg" alt="Foto de zatapillas después del servicio">

                            <img class="premium"  src="Imagenes/Resultados/Lavado Premium/2 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="premium"  src="Imagenes/Resultados/Lavado Premium/2 muestra/2.jpg" alt="Foto de zatapillas después del servicio">
                        </div>
                        <div class="bloqueTituloDespues">
                            <h4 class="tituloAntesDespues">DESPUÉS</h4>
                        </div>
                    </div>
                </div>
                <div class="col-m-6">
                    <div class="bloqueResultadoLavado">
                        <div class="bloqueTituloAntes">
                            <h4 class="tituloAntesDespues">ANTES</h4>
                        </div>
                        <div class="cajaImgResultados">
                            <img class="simple"  src="Imagenes/Resultados/Lavado Simple/2 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="simple"  src="Imagenes/Resultados/Lavado Simple/2 muestra/2.jpg" alt="Foto de zatapillas después del servicio">

                            <img class="estandar"  src="Imagenes/Resultados/Lavado Estándar/1 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="estandar"  src="Imagenes/Resultados/Lavado Estándar/1 muestra/2.jpg" alt="Foto de zatapillas después del servicio">

                            <img class="premium" src="Imagenes/Resultados/Lavado Premium/3 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="premium" src="Imagenes/Resultados/Lavado Premium/3 muestra/2.jpg" alt="Foto de zatapillas después del servicio">
                        </div>
                        <div class="bloqueTituloDespues">
                            <h4 class="tituloAntesDespues">DESPUÉS</h4>
                        </div>
                    </div>
                </div>
                <div class="col-m-6">
                    <div class="bloqueResultadoLavado">
                        <div class="bloqueTituloAntes">
                            <h4 class="tituloAntesDespues">ANTES</h4>
                        </div>
                        <div class="cajaImgResultados">
                            <img class="simple"  src="Imagenes/Resultados/Lavado Simple/3 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="simple" src="Imagenes/Resultados/Lavado Simple/3 muestra/2.jpg" alt="Foto de zatapillas después del servicio">
                        
                            <img class="estandar" src="Imagenes/Resultados/Lavado Estándar/3 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="estandar" src="Imagenes/Resultados/Lavado Estándar/3 muestra/2.jpg" alt="Foto de zatapillas después del servicio">
                        
                            <img class="premium" src="Imagenes/Resultados/Lavado Premium/1 muestra/1.jpg" alt="Foto de zatapillas antes del servicio">
                            <img class="premium" src="Imagenes/Resultados/Lavado Premium/1 muestra/2.jpg" alt="Foto de zatapillas después del servicio">
                        </div>
                        <div class="bloqueTituloDespues">
                            <h4 class="tituloAntesDespues">DESPUÉS</h4>
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