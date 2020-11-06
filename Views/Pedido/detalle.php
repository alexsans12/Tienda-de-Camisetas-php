<?php if(isset($_SESSION['admin'])  && isset($gestion) && $gestion): ?>
    <div class="titulo">
        <h2>Cambiar estado del pedido</h2>
    </div>
<?php else: ?>
    <div class="titulo">
        <h2>Detalle de Pedido</h2>
    </div>
<?php endif; ?>
<div class="contenedor-productos">
    <?php if(isset($pedido)): ?>
        <div class="table-responsive">
            <table class="table table-bordered tabla-carrito">
                <thead>
                <tr>
                    <th scope="col">Nº Pedido</th>
                    <th scope="col">Total a Pagar</th>
                    <th scope="col">Dirección de Envío</th>
                    <th scope="col">Estado</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?=$pedido->id;?></td>
                    <td>$<?=$pedido->coste;?></td>
                    <td><?=$pedido->provincia?>, <?=$pedido->localidad?>, <?=$pedido->direccion?></td>
                    <td><?=Utilidades::mostrarEstatus($pedido->estado);?></td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-bordered tabla-carrito">
            <thead>
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pedidoLinea as $producto): ?>
                <tr>
                    <td>
                        <div class="producto-carrito">
                            <img src="<?=$producto['imagen'];?>" alt="<?=$producto['nombre'];?> Imagen">
                            <p><a href="producto/ver&id=<?=$producto['id'];?>"><?=$producto['nombre'];?></a></p>
                        </div>
                    </td>
                    <td>$<?=$producto['precio'];?></td>
                    <td class="cantidad"><?=$producto['unidades'];?></td>
                    <td>$<?=($producto['unidades'] * $producto['precio']);?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if(isset($_SESSION['admin'])  && isset($gestion) && $gestion): ?>
        <div class="estado-pedido">
            <form class="form-registro form-detalle" action="<?=base_url?>pedido/estado" method="post">
                <input type="hidden" value="<?=$pedido->id;?>" name="id">
                <label for="estado">Estado del pedido:</label>
                <select id="estado" name="estado">
                    <option <?=$pedido->estado == 'confirmado' ? 'selected="selected"' : ''?> value="confirmado">Pendiente</option>
                    <option <?=$pedido->estado == 'preparacion' ? 'selected="selected"' : ''?> value="preparacion">En preparacion</option>
                    <option <?=$pedido->estado == 'listo' ? 'selected="selected"' : ''?> value="listo">Preparado para enviar</option>
                    <option <?=$pedido->estado == 'enviado' ? 'selected="selected"' : ''?> value="enviado">Enviado</option>
                </select>
                <input class="btn btn-comprar" type="submit" value="Guardar">
            </form>
        </div>
    <?php endif; ?>
</div>