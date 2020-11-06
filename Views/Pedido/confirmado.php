<?php if(isset($_SESSION['pedido-estado']) && $_SESSION['pedido-estado'] == 'completado'): ?>
<div class="titulo">
    <h2>Transaccion Completada</h2>
</div>
<div class="contenedor pedido-confirmado">
    <h3 class="titulo-total">Tu pedido se ha realizado con exito.</h3>
    <?php if(isset($pedido)): ?>
        <p>Número de Pedido: <?=$pedido->id?></p>
        <p>Total a pagar: $<?=$pedido->coste?></p>
        <p>Productos:</p>
        <?php if(isset($pedidoLinea)): ?>
            <?php foreach ($pedidoLinea as $elemento): ?>
                <div class="pedido-producto">
                    <img src="<?=$elemento['imagen'];?>" alt="<?=$elemento['nombre'];?> Imagen">
                    <p><?=$elemento['nombre'];?> x <span><?=$elemento['unidades'];?></span></p>
                    <p>$<?=($elemento['unidades'] * $elemento['precio']);?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php elseif(isset($_SESSION['pedido-estado']) && $_SESSION['pedido-estado'] == 'fallido'): ?>
    <div class="titulo">
        <h2>Transaccion Fallido</h2>
    </div>
    <div class="contenedor">
        <h3 class="titulo-total">Tu pedido no se ha podido procesar con exito.</h3>
    </div>
<?php endif; ?>