<?php

class Producto
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $conn;

    /**
     * Producto constructor.
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
        $this->id = $this->conn->real_escape_string($id);
    }

    /**
     * @return mixed
     */
    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    /**
     * @param mixed $categoria_id
     */
    public function setCategoriaId($categoria_id)
    {
        $this->categoria_id = $this->conn->real_escape_string($categoria_id);
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

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->conn->real_escape_string($descripcion);
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $this->conn->real_escape_string($precio);
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $this->conn->real_escape_string($stock);
    }

    /**
     * @return mixed
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * @param mixed $oferta
     */
    public function setOferta($oferta)
    {
        $this->oferta = $this->conn->real_escape_string($oferta);
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $this->conn->real_escape_string($fecha);
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $this->conn->real_escape_string($imagen);
    }

    public function getAll() {
        $productos = $this->conn->query("SELECT * FROM productos ORDER BY id DESC");

        return $productos;
    }

    public function getRandom($limite) {
        $productos = $this->conn->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limite");

        return $productos;
    }

    public function buscarId() {
        $productos = $this->conn->query("SELECT * FROM productos WHERE id = {$this->getId()}");

        return $productos->fetch_object();
    }

    public function buscarCategoriaId() {
        $productos = $this->conn->query("SELECT * FROM productos WHERE categoria_id = {$this->getCategoriaId()} ORDER BY id DESC");

        return $productos;
    }

    public function guardar() {
        $sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoriaId()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, '{$this->getOferta()}', CURDATE(), '{$this->getImagen()}');";
        $guardar = $this->conn->query($sql);

        $result = false;
        if($guardar) {
            $result = true;
        }

        return $result;
    }

    public function borrar() {
        $sql = "DELETE FROM productos WHERE id = {$this->getId()}";
        $borrar = $this->conn->query($sql);

        $result = false;
        if($borrar) {
            $result = true;
        }

        return $result;
    }

    public function actualizar() {
        $sql = "UPDATE productos SET categoria_id = {$this->getCategoriaId()}, nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}',  precio = {$this->getPrecio()}, stock = {$this->getStock()}, oferta = '{$this->getOferta()}'";

        if(!empty($this->imagen) || $this->imagen != null) {
            $sql .= ", imagen = '{$this->getImagen()}' WHERE id = {$this->id};";
        } else {
            $sql .= " WHERE id = {$this->id};";
        }
        $actualizar = $this->conn->query($sql);

        $result = false;
        if($actualizar) {
            $result = true;
        }

        return $result;
    }

    public function actualizarStock() {
        $sql = "UPDATE productos SET stock = {$this->getStock()} WHERE id = {$this->getId()}";

        $actualizar = $this->conn->query($sql);

        $result = false;
        if($actualizar) {
            $result = true;
        }

        return $result;
    }
}