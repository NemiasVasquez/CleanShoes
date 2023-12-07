
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
                    <li><a href="index.php?c=Servicio_Controller&a=Promociones" <?php if(isset($Promociones)){echo 'class="activo"';} ?> >Promociones</a></li>
                    <li><a href="index.php?c=Cliente_Controller&a=Resultados" <?php if(isset($Resultados)){echo 'class="activo"';} ?>>Resultados</a></li>
                </ul>
            </nav>
        </div>
        <div id="cajaUsuario" class="col-2">
            <div>
                <img src="Imagenes/Header/Carrito.png" alt="Ícono de un carrito de compras">
            </div>
           <div>

             <!-- IMPORTANTEEEEE 
             Se tiene que validar con PHP cuando ya
              existe un usuario para que cambie el enlace :D -->
                
             <a href=<?php if(isset($_SESSION["id_Cliente"])){echo "";}else{echo "index.php?c=Cliente_Controller&a=LoginViews";} ?> >
                    <img src="Imagenes/Header/Usuario.png" alt="Ícono de un usuario">
                    <p> <?php if(isset($_SESSION["id_Cliente"])){ echo $_SESSION["nombres"]." ".$_SESSION["apellidos"];}else{ echo "Iniciar Sesion";} ?> </p>
                    
                </a>
                <a href="index.php?c=Cliente_Controller&a=cerrarSesion">Cerrar Sesion</a>
           </div>
            
        </div> 
    </div>
</div>

