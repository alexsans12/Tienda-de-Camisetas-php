<div class="titulo">
    <h2>Realizar Pedido</h2>
</div>
<div class="pedido">
    <?php if(isset($_SESSION['identidad'])): ?>
        <div class="form-pedido form-registro">
            <form action="<?=base_url?>pedido/agregar" id="pedido-form" method="post">
                <?php if(isset($_SESSION['pedido-estado']) && $_SESSION['pedido-estado'] == 'fallido'): ?>
                    <div class='alerta alerta-error' id="alerta">Algo ha fallado al realizar el pedido.</div>
                <?php endif; ?>
                <?php Utilidades::borrarSessiones('pedido-estado'); ?>
                <h3>Dirección de envío</h3>
                <div class="nombre-reg">
                    <input placeholder="Departamento o Provincia" type="text" id="departamento-form" name="departamento" required pattern="[A-Za-z ]+" title="El campo solo puede contener letras">
                    <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'departamento') : '';  ?>
                </div>
                <div class="apellidos-reg">
                    <input placeholder="Municipio o Localidad" type="text" id="localidad-form" name="municipio" required pattern="[A-Za-z ]+" title="El campo solo puede contener letras">
                    <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'municipio') : '';  ?>
                </div>

                <input placeholder="Dirección Exacta" type="text" id="email-form" name="direccion" required title="Ingrese su dirección exacta">
                <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'direccion') : '';  ?>

                <input class="btn btn-login" type="submit" value="Confirmar Pedido" name="confirmar">
            </form>
            <?php Utilidades::borrarSessiones('errores'); ?>
        </div>
    <?php endif; ?>
    <div class="contenedor">
        <?php if(!isset($_SESSION['identidad'])): ?>
            <div class='alerta alerta-error' id="alerta-aside">
                Necesitas estar logueado para poder realizar el pedido.
            </div>
        <?php endif; ?>
        <?php $totalcarrito = 0;
            if(isset($_SESSION['carrito'])):
        ?>
            <?php foreach ($_SESSION['carrito'] as $indice => $elemento): ?>
                <div class="pedido-producto">
                    <img src="<?=$elemento['producto']->imagen;?>" alt="<?=$elemento['producto']->nombre;?> Imagen">
                    <p><?=$elemento['producto']->nombre;?> x <span><?=$elemento['unidades'];?></span></p>
                    <p>$<?=($elemento['unidades'] * $elemento['precio']);?></p>
                </div>
                <?php $totalcarrito += ($elemento['unidades'] * $elemento['precio']); ?>
            <?php endforeach; ?>
            <p class="total-pedido">Total: $<?=$totalcarrito?></p>
        <?php else:?>
            <h3 class="productos-no">No tienes productos en el carrito.</h3>
        <?php endif; ?>
    </div>
</div>