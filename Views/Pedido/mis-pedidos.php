<?php if(isset($gestion) && $gestion): ?>
    <div class="titulo">
        <h2>Gestionar Pedidos</h2>
    </div>
<?php else: ?>
    <div class="titulo">
        <h2>Mis Pedidos</h2>
    </div>
<?php endif; ?>
<div class="contenedor-productos">
    <div class="table-responsive">
        <table class="table table-bordered tabla-carrito">
            <thead>
            <tr>
                <th scope="col">Nº Pedido</th>
                <th scope="col">Coste</th>
                <th scope="col">Fecha</th>
                <?php if(isset($gestion) && $gestion): ?>
                    <th scope="col">Estado</th>
                <?php endif; ?>
                <th scope="col">Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td scope="row"><?=$pedido['id']?></td>
                    <td>$<?=$pedido['coste'];?></td>
                    <td class="cantidad"><?=$pedido['fecha'];?></td>
                    <?php if(isset($gestion) && $gestion): ?>
                        <td scope="col"><?=Utilidades::mostrarEstatus($pedido['estado'])?></td>
                    <?php endif; ?>
                    <td>
                        <a style="margin: 0" class="btn btn-comprar" href="pedido/detalle&id=<?=$pedido['id']?>">Ver Detalle</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

