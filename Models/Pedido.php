<?php


class Pedido
{
    private $id;
    private $usuario_id;
    private $departamento;
    private $municipio;
    private $direccion;
    private $coste;
    private $estado;
    private $conn;

    /**
     * Pedido constructor.
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
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * @param mixed $usuario_id
     */
    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $this->conn->real_escape_string($usuario_id);
    }

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * @param mixed $departamento
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $this->conn->real_escape_string($departamento);
    }

    /**
     * @return mixed
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param mixed $municipio
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $this->conn->real_escape_string($municipio);
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $this->conn->real_escape_string($direccion);
    }

    /**
     * @return mixed
     */
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * @param mixed $coste
     */
    public function setCoste($coste)
    {
        $this->coste = $this->conn->real_escape_string($coste);
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $this->conn->real_escape_string($estado);
    }

    public function getAll() {
        $pedidos = $this->conn->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $pedidos;
    }

    public function buscarId() {
        $pedidos = $this->conn->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $pedidos->fetch_object();
    }

    public function buscarUsuarioId() {
        $sql = "SELECT p.id, p.coste  FROM pedidos p  "
             . "WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY p.id DESC LIMIT 1";
        $pedido = $this->conn->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllUsuarioId() {
        $sql = "SELECT p.* FROM pedidos p  "
            . "WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY p.id DESC";
        $pedidos = $this->conn->query($sql);
        return $pedidos;
    }

    public function buscarUltimo() {
        $pedidos = $this->conn->query("SELECT LAST_INSERT_ID() as 'pedidoId';");
        return $pedidos->fetch_object()->pedidoId;
    }

    public function guardar() {
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuarioId()}, '{$this->getDepartamento()}', '{$this->getMunicipio()}', '{$this->getDireccion()}', {$this->getCoste()}, '{$this->getEstado()}', CURDATE(), CURTIME());";
        $guardar = $this->conn->query($sql);

        $result = false;
        if($guardar) {
            $result = true;
        }

        return $result;
    }

    public function actualizar() {
        $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}' WHERE id = {$this->getId()};";
        $guardar = $this->conn->query($sql);

        $result = false;
        if($guardar) {
            $result = true;
        }

        return $result;
    }
}