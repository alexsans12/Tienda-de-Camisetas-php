<?php


class Categoria
{
    private $id;
    private $nombre;
    private $conn;

    /**
     * Categoria constructor.
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $this->conn->real_escape_string($nombre);
    }

    public function getAll() {
        $categorias = $this->conn->query("SELECT * FROM categorias ORDER BY id DESC");

        return $categorias;
    }

    public function buscarId() {
        $categorias = $this->conn->query("SELECT * FROM categorias WHERE id = {$this->getId()}");

        return $categorias->fetch_object();
    }

    public function guardar() {
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
        $guardar = $this->conn->query($sql);

        $result = false;
        if($guardar) {
            $result = true;
        }

        return $result;
    }

    public function borrar() {
        $sql = "DELETE FROM categorias WHERE id = $this->id";
        $borrar = $this->conn->query($sql);

        $result = false;
        if($borrar) {
            $result = true;
        }

        return $result;
    }
}