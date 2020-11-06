<?php
include_once 'Models/Producto.php';

class productoController
{
    public function Index() {
        $producto = new Producto();
        $productos = $producto->getRandom(6);

        // Renderizar vista
        include_once 'Views/Producto/destacados.php';
    }

    public function ver() {

        if(isset($_GET)) {
            $id = isset($_GET["id"]) ? $_GET["id"] : false;

            $producto = new Producto();
            $producto->setId($id);
            $producto = $producto->buscarId();

            // Conseguir Categoria
            $categoria = new Categoria();
            $categoria->setId($producto->categoria_id);
            $categoria = $categoria->buscarId();
        }

        include_once 'Views/Producto/ver.php';
    }

    public function gestion() {
        Utilidades::isAdmin();

        $producto = new Producto();
        $productos = $producto->getAll();

        include_once 'Views/Producto/gestion.php';
    }

    public function crear() {
        Utilidades::isAdmin();
        $url_action = 'producto/guardar';

        include_once 'Views/Producto/crear.php';
    }

    public function actualizar() {
        Utilidades::isAdmin();

        if(isset($_POST) && isset($_GET['id']) && !empty($_GET['id'])) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;
            $categoria_id = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $imagen = null;

            //  Iniciar Session
            if(!isset($_SESSION)) {
                session_start();
            }

            //  Array de Errores
            $errores = Array();

            //  Validar los datos
            // Validar id
            if(!empty($categoria_id) && is_numeric($categoria_id)) {

            } else {
                $errores['categoria'] = 'La categoria no es válida';
            }
            //Validar campo nombre
            if(!empty($nombre)) {

            } else {
                $errores['nombre'] = 'El nombre no es válido';
            }
            // Validar descripcion
            if(!empty($descripcion)) {

            } else {
                $errores['descripcion'] = 'La descripción esta vacia';
            }
            //Validar campo precio
            if(!empty($precio) && is_numeric($precio)) {

            } else {
                $errores['precio'] = 'El precio no es válido';
            }
            //Validar campo stock
            if(!empty($stock) && is_numeric($stock)) {

            } else {
                $errores['stock'] = 'El stock no es válido';
            }

            if($stock == '0'){
                unset($errores['stock']);
            }

            if(isset($_FILES['imagen']) && !empty($_FILES['imagen'])) {
                $archivo = $_FILES['imagen'];
                $nombreimg = $archivo['name'];
                $tipo = $archivo['type'];
                $guardarImg = false;

                $producto = new Producto();
                $producto->setId($id);
                $resul = $producto->buscarId();

                unlink($resul->imagen);

                if ($tipo == 'image/jpg' || $tipo == 'image/jpeg' || $tipo == 'image/png') {
                    if (!is_dir('assets/img/productos')) {
                        mkdir('assets/img/productos', 0777, true);
                    }
                    $imagen = 'assets/img/productos/' . $nombreimg;
                    $guardarImg = true;
                }
            }


            if(count($errores) == 0) {
                if($categoria_id && $nombre && $descripcion && $precio && ($stock || $stock == 0) && $id) {
                    $producto = new Producto();
                    $producto->setId($id);
                    $producto->setCategoriaId($categoria_id);
                    $producto->setNombre($nombre);
                    $producto->setDescripcion($descripcion);
                    $producto->setPrecio($precio);
                    $producto->setStock($stock);
                    $producto->setOferta($oferta);
                    $producto->setImagen($imagen);

                    $actualizar = $producto->actualizar();

                    if ($actualizar) {

                        if($guardarImg) {
                            move_uploaded_file($archivo['tmp_name'], 'assets/img/productos/' . $nombreimg);
                        }
                        $_SESSION['registro'] = 'completado';

                    } else {
                        $_SESSION['registro'] = 'fallido';
                    }
                }
            } else {
                $_SESSION['registro'] = 'fallido';
                $_SESSION['errores'] = $errores;
            }
        } else {
            $_SESSION['registro'] = 'fallido';
        }

        if($actualizar) {
            header('Location: '. base_url .'producto/gestion');
        } else {
            header('Location: '. base_url .'producto/editar&id=' . $id);
        }
    }

    public function guardar() {
        Utilidades::isAdmin();

        if(isset($_POST)) {
            $categoria_id = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock']  : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $imagen = null;


            //  Iniciar Session
            if(!isset($_SESSION)) {
                session_start();
            }

            //  Array de Errores
            $errores = Array();

            //  Validar los datos
            // Validar id
            if(!empty($categoria_id) && is_numeric($categoria_id)) {

            } else {
                $errores['categoria'] = 'La categoria no es válida';
            }
            //Validar campo nombre
            if(!empty($nombre)) {

            } else {
                $errores['nombre'] = 'El nombre no es válido';
            }
            // Validar descripcion
            if(!empty($descripcion)) {

            } else {
                $errores['descripcion'] = 'La descripción esta vacia';
            }
            //Validar campo precio
            if(!empty($precio) && is_numeric($precio)) {

            } else {
                $errores['precio'] = 'El precio no es válido';
            }
            //Validar campo stock
            if(!empty($stock) && is_numeric($stock)) {

            } else {
                $errores['stock'] = 'El stock no es válido';
            }

            if($stock == '0'){
                unset($errores['stock']);
            }

            if(isset($_FILES['imagen']) && !empty($_FILES['imagen'])) {
                $archivo = $_FILES['imagen'];
                $nombreimg = $archivo['name'];
                $tipo = $archivo['type'];
                $guardarImg = false;

                if ($tipo == 'image/jpg' || $tipo == 'image/jpeg' || $tipo == 'image/png') {
                    if (!is_dir('assets/img/productos')) {
                        mkdir('assets/img/productos', 0777, true);
                    }
                    $imagen = $nombreimg;
                    $guardarImg = true;
                } else {
                    $errores['imagen'] = 'La imagen no es válida';
                }
            }

            if(count($errores) == 0) {
                if($categoria_id && $nombre && $descripcion && $precio && ($stock || $stock == 0) && $guardarImg) {
                    $producto = new Producto();
                    $producto->setCategoriaId($categoria_id);
                    $producto->setNombre($nombre);
                    $producto->setDescripcion($descripcion);
                    $producto->setPrecio($precio);
                    $producto->setStock($stock);
                    $producto->setOferta($oferta);
                    $producto->setImagen('assets/img/productos/' . $imagen);

                    $guardar = $producto->guardar();

                    if ($guardar) {

                        if($guardarImg) {
                            move_uploaded_file($archivo['tmp_name'], 'assets/img/productos/' . $nombreimg);
                        }
                        $_SESSION['registro'] = 'completado';

                    } else {
                        $_SESSION['registro'] = 'fallido';
                    }
                }
            } else {
                $_SESSION['registro'] = 'fallido';
                $_SESSION['errores'] = $errores;
            }
        } else {
            $_SESSION['registro'] = 'fallido';
        }

        if($guardar) {
            header('Location: '. base_url .'producto/gestion');
        } else {
            header('Location: '. base_url .'producto/crear');
        }
    }

    public function borrar() {
        Utilidades::isAdmin();

        // borrar la producto
        if(isset($_GET)) {
            $id = isset($_GET["id"]) ? $_GET["id"] : false;

            if($id) {
                $producto = new Producto();
                $producto->setId($id);
                $resul = $producto->buscarId();

                unlink($resul->imagen);
                $borrar = $producto->borrar();

                if ($borrar) {
                    $_SESSION['borrar'] = 'completado';
                } else {
                    $_SESSION['borrar'] = 'fallido';
                }
            }

        } else {
            $_SESSION['borrar'] = 'fallido';
        }

        header('Location:' . base_url . 'producto/gestion');
    }

    public function editar() {
        Utilidades::isAdmin();

        if(isset($_GET)) {
            $id = isset($_GET["id"]) ? $_GET["id"] : false;
            $url_action = 'producto/actualizar&id=' . $id;
            $producto = new Producto();
            $producto->setId($id);
            $producto = $producto->buscarId();

            include_once 'Views/Producto/crear.php';
        } else {
            header('Location:' . base_url . 'producto/gestion');
        }
    }
}