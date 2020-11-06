<?php
class Utilidades
{
    public static function borrarSessiones($nombre) {
        if(isset($_SESSION[$nombre])) {
            $_SESSION[$nombre] = null;
            unset($_SESSION[$nombre]);
        }

        return $nombre;
    }

    public static function mostrarErrores($errores, $campo) {
        $alert = '';

        if(isset($errores[$campo]) && !empty($campo)) {
            $alert = "<div class='alerta alerta-error'>$errores[$campo]</div>";
        }

        return $alert;
    }

    public static function isAdmin() {
        if(isset($_SESSION['admin'])) {
            return true;
        } else {
            header('Location:' . base_url);
        }
    }

    public static function isLoggedIn() {
        if(isset($_SESSION['identidad'])) {
            return true;
        } else {
            header('Location:' . base_url);
        }
    }

    public static function showCategorias() {
        include_once 'Models/Categoria.php';

        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        return $categorias;
    }

    public static function statsCarrito() {
        if(isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
            $totalcarrito = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                $totalcarrito += ($elemento['unidades'] * $elemento['precio']);
            }
            $carrito['total'] = $totalcarrito;
            return $carrito;
        }
    }

    public static function mostrarEstatus($estatus) {
        $valor = 'Pendiente';

        if($estatus == 'confirmado'):
            $valor = 'Pendiente';
        elseif($estatus == 'preparacion'):
            $valor = 'En preparación';
        elseif($estatus == 'listo'):
            $valor = 'Preparado para Enviar';
        elseif($estatus == 'enviado'):
            $valor = 'Enviado';
        endif;

        return $valor;
    }
}