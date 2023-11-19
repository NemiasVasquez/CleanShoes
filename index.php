<?php
    date_default_timezone_set("America/Lima");

    require_once "Config/Conexion.php";
    require_once "Config/Config.php";
    require_once "Routes/Routes.php";

    if (isset($_GET["c"])) { // variable c= controllador enviado por GET

        $controlador = validarControlador($_GET["c"]);
    
        if (isset($_GET["a"])) { // variable a= acción enviado por GET
    
            if (isset($_GET["id"])) { // variable id= id de registro para eliminar o actualizar enviado por GET
                validarAccion($controlador, $_GET['a'], $_GET['id']);
            } else {
                validarAccion($controlador, $_GET['a']);
            }
        } else {
            validarAccion($controlador, ACCION_DEFAULT);
        }
    } else {
        $control = validarControlador(CONTROLADOR_DEFAULT);
        $accionTMP = ACCION_DEFAULT;
        $control->$accionTMP();
    }
?>