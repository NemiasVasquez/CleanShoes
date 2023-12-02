
<div class = "row">
    <div class="interior">
        <div id="bloqueImagenLogo" class="col-2">
            <a href="index.php?"><img src="Imagenes/CleanShoes_Logo.png" alt="Logo de Clean Shoes"/></a>
        </div>

        <div id="bloqueMenu" class ="col-8">
            <nav id = menu_h>
                <ul>
                    <li><a href="index.php?" <?php if(isset($Inicio)){echo 'class="activo"';} ?>>Inicio</a></li>
                    <li><a href="index.php?c=Cliente_Controller&a=QuienesSomos" <?php if(isset($QuienesSomos)){echo 'class="activo"';} ?>>¿Quiénes Somos?</a></li>
                    <li><a href="index.php?c=Servicio_Controller&a=Servicios" <?php if(isset($Servicios)){echo 'class="activo"';} ?>>Servicios</a></li>
                    <li><a href="">Promociones</a></li>
                    <li><a href="index.php?c=Cliente_Controller&a=Resultados" <?php if(isset($Resultados)){echo 'class="activo"';} ?>>Resultados</a></li>
                </ul>
            </nav>
        </div>
        <div id="cajaReservar" class="col-2">
            <a href="ReservarServicio.html" id = "ctaReserva">Reservar Servicio</a>
        </div> 
    </div>
</div>

