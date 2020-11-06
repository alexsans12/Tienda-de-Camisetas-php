<?php
include_once 'Models/Producto.php';

class carritoController
{

    public function Index() {


        include_once 'Views/Carrito/index.php';
    }

    public function agregar() {
        if(isset($_GET['id'])) {
            $productoId = isset($_GET['id']) ? $_GET['id'] : false;
            $ircarrito = isset($_GET['ir']) ? $_GET['ir'] : true;

            if(isset($_POST['cantidad'])) {
                $cantidadProductos = isset($_POST['cantidad']) ? $_POST['cantidad'] : false;
            } else {
                $cantidadProductos = 1;
            }

        } else {
            header('Location:' . base_url);
        }

        $producto = new Producto();
        $producto->setId($productoId);
        $producto = $producto->buscarId();

        if($_SESSION['carrito']) {
            $counter = 0;
            $existe = false;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if($elemento['idProducto'] == $productoId) {
                    if ($cantidadProductos < $producto->stock && ($_SESSION['carrito'][$indice]['unidades']+$cantidadProductos) < $producto->stock) {
                        $_SESSION['carrito'][$indice]['unidades'] += $cantidadProductos;
                        $counter++;
                    }
                    elseif($_SESSION['carrito'][$indice]['unidades'] < $producto->stock) {
                        $cantidadProductos = $producto->stock - $_SESSION['carrito'][$indice]['unidades'];
                        $_SESSION['carrito'][$indice]['unidades'] += $cantidadProductos;
                        $counter++;
                    }
                    $existe = true;
                }
            }

        }

        if(!isset($counter) || $existe == false ) {

            if($cantidadProductos > $producto->stock) {
                $cantidadProductos = $producto->stock;
            }

            if (is_object($producto) && $cantidadProductos <= $producto->stock) {
                $_SESSION['carrito'][] = array(
                    'idProducto' => $producto->id,
                    'precio' => $producto->precio,
                    'unidades' => $cantidadProductos,
                    'producto' => $producto
                );
            }
        }

        if($ircarrito == false) {
            header('Location:' . getenv('HTTP_REFERER'));
        } else {
            header('Location:' . base_url . '/carrito/index');
        }
    }

    public function mas() {
        if(isset($_GET['indice']) && isset($_SESSION['carrito'])) {
            $indice = isset($_GET['indice']) ? $_GET['indice'] : false;

            if((int)$_SESSION['carrito'][$indice]['unidades'] < (int)$_SESSION['carrito'][$indice]['producto']->stock) {
                $_SESSION['carrito'][$indice]['unidades']++;
            }
            header('Location:' . base_url . 'carrito/index');
        }
    }

    public function menos() {
        if(isset($_GET['indice']) && isset($_SESSION['carrito'])) {
            $indice = isset($_GET['indice']) ? $_GET['indice'] : false;

            if($_SESSION['carrito'][$indice]['unidades'] > 1) {
                $_SESSION['carrito'][$indice]['unidades']--;
            }
            elseif($_SESSION['carrito'][$indice]['unidades'] == 1) {
                unset($_SESSION['carrito'][$indice]);
            }

            header('Location:' . base_url . 'carrito/index');
        }
    }

    public function eliminar() {
        if(isset($_GET['indice'])) {
            $indice = isset($_GET['indice']) ? $_GET['indice'] : false;

            unset($_SESSION['carrito'][$indice]);

            if(empty($_SESSION['carrito'])){
                Utilidades::borrarSessiones('carrito');
            }
            header('Location:' . base_url . 'carrito/index');
        }
    }

    public function vaciar() {
        Utilidades::borrarSessiones('carrito');
        header('Location:' . base_url . 'carrito/index');
    }

}