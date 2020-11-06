<?php

class Usuario
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $conn;

    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        $this->conn = Database::conectar();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $this->conn->real_escape_string($nombre);;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $this->conn->real_escape_string($apellidos);;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $this->conn->real_escape_string($email);;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $this->conn->real_escape_string($password);
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol = 'user')
    {
        $this->rol = $rol;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function encriptar($pass) {
        return password_hash(($pass), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function guardar() {
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->encriptar($this->getPassword())}', '{$this->getRol()}', '{$this->getImagen()}');";
        $guardar = $this->conn->query($sql);

        $result = false;
        if($guardar) {
            $result = true;
        }

        return $result;
    }

    public function login() {
        $resultado = false;
        $email = $this->getEmail();
        $password = $this->getPassword();

        // Comprobar si existe el usuario
        // Consulta que se realizara
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";

        // Se realiza la consulta y se guarda
        $login = $this->conn->query($sql);

        // Revisar que la consulta no viene vacia
        if($login && $login->num_rows == 1) {
            // Se crea un objeto con la Informacion
            $usuario = $login->fetch_object();

            // Verificar la contraseña
            $verificar = password_verify($password, $usuario->password);

            if($verificar) {
                $resultado = $usuario;
            }
        }

        return $resultado;
    }
}