<?php
include_once 'Models/Categoria.php';
include_once 'Models/Producto.php';

class categoriaController
{
    public function Index() {
        Utilidades::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        include_once 'Views/categoria/index.php';
    }

    public function ver() {
        if(isset($_GET['id'])) {
            // Conseguir id
            $id = isset($_GET["id"]) ? $_GET["id"] : false;

            // Conseguir Categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->buscarId();

            // Conseguir productos de la categoria obtenida
            $producto = new Producto();
            $producto->setCategoriaId($categoria->id);
            $productos = $producto->buscarCategoriaId();
        }

        include_once 'Views/Categoria/ver.php';
    }

    public function crear() {
        Utilidades::isAdmin();
        include_once 'Views/categoria/crear.php';
    }

    public function guardar() {
        Utilidades::isAdmin();

        // guardar la categoria
        if(isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

            //  Array de Errores
            $errores = Array();

            //  Validar los datos
            //Validar campo nombre
            if(!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)) {

            } else {
                $errores['nombre'] = 'El nombre no es válido';
            }

            if(count($errores) == 0) {
                if($nombre) {
                    $categoria = new Categoria();
                    $categoria->setNombre($nombre);
                    echo 'se guardo nombre en categoria';
                    $guardar = $categoria->guardar();
                    echo 'se hace la query';

                    if ($guardar) {
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
            header('Location:' . base_url . 'categoria/index');
        } else {
            header('Location:' . base_url . 'categoria/crear');
        }
    }

    public function borrar() {
        Utilidades::isAdmin();

        // borrar la categoria
        if(isset($_GET)) {
            $id = isset($_GET["id"]) ? $_GET["id"] : false;

            if($id) {
                $categoria = new Categoria();
                $categoria->setId($id);
                $borrar = $categoria->borrar();

                if ($borrar) {
                    $_SESSION['borrar'] = 'completado';
                } else {
                    $_SESSION['borrar'] = 'fallido';
                }
            }

        } else {
            $_SESSION['borrar'] = 'fallido';
        }

        header('Location:' . base_url . 'categoria/index');
    }
}