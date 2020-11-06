<?php


class PedidoLinea
{
    private $pedido_id,
            $producto_id,
            $unidades,
            $conn;
    /**
     * PedidoLinea constructor.
     */
    public function __construct()
    {
        $this->conn = Database::conectar();
    }

    /**
     * @return mixed
     */
    public function getPedidoId()
    {
        return $this->pedido_id;
    }

    /**
     * @param mixed $pedido_id
     */
    public function setPedidoId($pedido_id)
    {
        $this->pedido_id = $pedido_id;
    }

    /**
     * @return mixed
     */
    public function getProductoId()
    {
        return $this->producto_id;
    }

    /**
     * @param mixed $producto_id
     */
    public function setProductoId($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    /**
     * @return mixed
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * @param mixed $unidades
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }

    public function guardar() {
        $sql = "INSERT INTO lineas_pedidos VALUES(NULL, {$this->getPedidoId()}, {$this->getProductoId()}, {$this->getUnidades()});";
        $guardar = $this->conn->query($sql);

        $result = false;
        if($guardar) {
            $result = true;
        }

        return $result;
    }

    public function buscarProductosPedido() {
        $sql = "SELECT * FROM productos WHERE id IN "
             . "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$this->getPedidoId()})";

        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
             . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
             . "WHERE lp.pedido_id = {$this->getPedidoId()}";

        $pedidolinea = $this->conn->query($sql);
        return $pedidolinea;
    }
}