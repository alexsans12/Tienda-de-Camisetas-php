<?php
    session_start();

    include_once 'Autoload.php';
    include_once 'Config/database.php';
    include_once 'Config/Parametros.php';
    include_once 'Helpers/Utilidades.php';

    include_once 'Views/Layout/header.php';

    if($_GET['action'] != 'registro') {
        if(($_GET['controller'] != 'producto' || $_GET['action'] != 'ver')) {
            if(($_GET['controller'] != 'carrito' || $_GET['action'] != 'index')) {
                    include_once 'Views/Layout/sidebar.php';
            }
        }
    }


    if(isset($_GET['controller'])) {
        $nombreControlador = $_GET['controller'].'Controller';
    }
    elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $nombreControlador = controllerDefault;
    } else {
        showError();
    }

    if (class_exists($nombreControlador)) {
        $controlador = new $nombreControlador();

        if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
            $action = $_GET['action'];
            $controlador->$action();
        }
        elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
            $action = actionDefault;
            $controlador->$action();
        } else {
            showError();
        }
    } else {
        showError();
    }

?>

<?php
include_once 'Views/Layout/footer.php';
?>