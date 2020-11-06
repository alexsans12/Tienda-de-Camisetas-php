<?php
include_once 'Models/Pedido.php';
include_once 'Models/Producto.php';
include_once 'Models/PedidoLinea.php';

class pedidoController
{
    public function hacer() {
        include_once 'Views/Pedido/hacer.php';
    }

    public function agregar() {
        Utilidades::isLoggedIn();

        // Guardar Datos en la Bd
        if(isset($_POST)) {
            $usuario_id = isset($_SESSION['identidad']->id) ? $_SESSION['identidad']->id : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utilidades::statsCarrito();
            $coste = $stats['total'];
            $estado = 'confirmado';

            //  Iniciar Session
            if(!isset($_SESSION)) {
                session_start();
            }

            //  Array de Errores
            $errores = Array();

            //  Validar los datos
            // Validar id
            if(!empty($usuario_id) && is_numeric($usuario_id)) {

            } else {
                $errores['usuario_id'] = 'id de usuario vacio';
            }
            //Validar campo departamento
            if(!empty($departamento)) {

            } else {
                $errores['departamento'] = 'El campo departamento esta vacio';
            }
            //Validar campo municipio
            if(!empty($municipio)) {

            } else {
                $errores['municipio'] = 'El campo municipio esta vacio';
            }
            //Validar campo direccion
            if(!empty($direccion)) {

            } else {
                $errores['direccion'] = 'El campo direccion esta vacio';
            }

            if(count($errores) == 0) {
                if($usuario_id && $departamento && $municipio && $direccion && $coste && $estado) {
                    $pedido = new Pedido();
                    $pedido->setUsuarioId($usuario_id);
                    $pedido->setDepartamento($departamento);
                    $pedido->setMunicipio($municipio);
                    $pedido->setDireccion($direccion);
                    $pedido->setCoste($coste);
                    $pedido->setEstado($estado);

                    $guardar = $pedido->guardar();

                    // Guardar linea pedido
                    $idpedido = $pedido->buscarUltimo();
                    foreach ($_SESSION['carrito'] as $elemento) {
                        $producto = $elemento['producto'];
                        $pedidoLinea = new PedidoLinea();
                        $pedidoLinea->setPedidoId($idpedido);
                        $pedidoLinea->setProductoId($producto->id);
                        $pedidoLinea->setUnidades($elemento['unidades']);

                        $producto = new Producto();
                        $producto->setId($pedidoLinea->getProductoId());
                        $producto = $producto->buscarId();

                        $productoStock = new Producto();
                        $productoStock->setId($producto->id);
                        $stock = ((int)$producto->stock - (int)$elemento['unidades']);
                        $productoStock->setStock($stock);

                        $actualizarStock = $productoStock->actualizarStock();
                        $guardarLista = $pedidoLinea->guardar();
                    }

                    if ($guardar && $guardarLista && $actualizarStock) {
                        $_SESSION['pedido-estado'] = 'completado';
                        Utilidades::borrarSessiones('carrito');
                        header('Location:' . base_url . 'pedido/confirmado');

                    } else {
                        $_SESSION['pedido-estado'] = 'fallido';
                    }
                }
            } else {
                $_SESSION['pedido-estado'] = 'fallido';
                $_SESSION['errores'] = $errores;
            }
        } else {
            $_SESSION['pedido-estado'] = 'fallido';
        }
    }// Fin guardar

    public function confirmado() {
        Utilidades::isLoggedIn();

        $usuario_id = isset($_SESSION['identidad']->id) ? $_SESSION['identidad']->id : false;

        $pedido = new Pedido();
        $pedido->setUsuarioId($usuario_id);
        $pedido = $pedido->buscarUsuarioId();

        $pedidoLinea = new PedidoLinea();
        $pedidoLinea->setPedidoId($pedido->id);
        $pedidoLinea = $pedidoLinea->buscarProductosPedido();

        include_once 'Views/Pedido/confirmado.php';
    }

    public function misPedidos() {
        Utilidades::isLoggedIn();
        $usuario_id = isset($_SESSION['identidad']->id) ? $_SESSION['identidad']->id : false;

        // Sacar los pedidos del Usuario
        $pedidos = new Pedido();
        $pedidos->setUsuarioId($usuario_id);
        $pedidos = $pedidos->getAllUsuarioId();

        include_once 'Views/Pedido/mis-Pedidos.php';
    }

    public function detalle() {
        Utilidades::isLoggedIn();

        if(isset($_GET['id'])){
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            // sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->buscarId();

            //Sacar los productos
            $pedidoLinea = new PedidoLinea();
            $pedidoLinea->setPedidoId($pedido->id);
            $pedidoLinea = $pedidoLinea->buscarProductosPedido();

            if(isset($_SESSION['admin'])) {
                $gestion = true;
            }

            include_once 'Views/Pedido/detalle.php';
        } else {
            header('Location:'. base_url . 'pedido/mispedidos');
        }
    }

    public function gestion() {
        Utilidades::isLoggedIn();
        $gestion = true;

        $pedidos = new Pedido();
        $pedidos = $pedidos->getAll();

        include_once 'Views/Pedido/mis-pedidos.php';
    }

    public function estado() {
        Utilidades::isAdmin();

        if(isset($_POST) && isset($_POST['id'])) {
            // Actualizar estado del pedido
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;

            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido = $pedido->actualizar();

            header('Location:' . base_url . 'pedido/detalle&id=' . $id);
        } else {
            header('Location:' . base_url);
        }

    }
}