<?php

require_once 'Models/Usuario.php';

class usuarioController
{
    public function Index() {
        echo "Usuario Controlador";
    }

    public function registro() {
        include_once 'Views/Usuario/registro.php';
    }

    public function guardar() {

        if(isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            //  Iniciar Session
            if(!isset($_SESSION)) {
                session_start();
            }

            //  Array de Errores
            $errores = Array();

            //  Validar los datos
            //Validar campo nombre
            if(!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)) {

            } else {
                $errores['nombre'] = 'El nombre no es válido';
            }

            //Validar campo apellidos
            if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match('/[0-9]/', $apellidos)) {

            } else {
                $errores['apellidos'] = 'Los apellidos no son válidos';
            }

            //Validar campo email
            if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

            } else {
                $errores['email'] = 'El email no es válido';
            }

            //Validar campo password
            if(!empty($password) && strlen($password) >= 8) {

            } else {
                $errores['password'] = 'La contraseña debe tener al menos 8 caracteres';
            }

            if(count($errores) == 0) {
                if($nombre && $apellidos && $email && $password) {
                    $usuario = new Usuario();
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);
                    $usuario->setRol();
                    $guardar = $usuario->guardar();

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

        header('Location: '. base_url .'usuario/registro');
    }

    public function login() {

        //  Iniciar Session
        if(!isset($_SESSION)) {
            session_start();
        }

        if(isset($_POST)) {
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            // Identificar al usuario
            $usuario = new Usuario();
            $usuario->setEmail($email);
            $usuario->setPassword($password);

            // Consulta a la base de datos
            $identidad = $usuario->login();

            // Comprobar si es un objeto
            if($identidad && is_object($identidad)) {
                $_SESSION['identidad'] = $identidad;

                if($identidad->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $errores['login'] = 'Identificación fallida';
                $_SESSION['errores'] = $errores;
            }
        } else {
            $errores['login'] = 'A ocurrido un error al iniciar session';
            $_SESSION['errores'] = $errores;
        }

        header('Location:' . base_url);
    }// Fin funcion login

    public function logout() {
        Utilidades::borrarSessiones('identidad');
        Utilidades::borrarSessiones('admin');

        header('Location:' . base_url);
    }// Fin Funcion logout
}// Fin clase usuarioController