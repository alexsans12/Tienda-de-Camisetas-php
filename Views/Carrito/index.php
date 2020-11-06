<div class="titulo">
    <h2>Carrito</h2>
</div>
<?php if(isset($_SESSION['carrito'])): ?>
    <div class="contenedor-productos">
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
                <?php $totalcarrito = 0; ?>
                <?php foreach ($_SESSION['carrito'] as $indice => $elemento): ?>
                    <tr>
                        <td scope="row">
                            <div class="producto-carrito">
                                <a href="carrito/eliminar&indice=<?=$indice?>" class="eliminar"><i class="far fa-times-circle"></i></a>
                                <img src="<?=$elemento['producto']->imagen;?>" alt="<?=$elemento['producto']->nombre;?> Imagen">
                                <p><a href="producto/ver&id=<?=$elemento['producto']->id;?>"><?=$elemento['producto']->nombre;?></a></p>
                            </div>
                        </td>
                        <td>$<?=$elemento['precio'];?></td>
                        <td>
                            <div class="cantidad">
                                <a href="carrito/mas&indice=<?=$indice?>"><i class="fas fa-plus"></i></a>
                                <?=$elemento['unidades'];?>
                                <a href="carrito/menos&indice=<?=$indice?>"><i class="fas fa-minus"></i></a>
                            </div>
                        </td>
                        <td>$<?=($elemento['unidades'] * $elemento['precio']);?></td>
                    </tr>
                    <?php $totalcarrito += ($elemento['unidades'] * $elemento['precio']); ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if(isset($_SESSION['carrito'])): ?>
            <div class="table-responsive">
                <table class="table table-bordered tabla-carrito tabla-total">
                    <thead>
                    <tr>
                        <th class="titulo-total" scope="col" colspan="2">Total del Carrito</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th style="border: none">Subtotal:</th>
                        <td style="border: none">
                            <span>$<?=$totalcarrito;?></span>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <a href="pedido/hacer" style="margin-bottom: 10px" class="btn btn-comprar">Realizar Compra</a>
                            <a href="carrito/vaciar" class="btn btn-carrito">Vaciar Carrito</a>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="contenedor-productos">
        <h3 class="productos-no">No tienes productos en tu carrito.</h3>
    </div>
<?php endif; ?>