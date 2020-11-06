<!--    CONTENIDO CENTRAL    -->
<?php if(isset($categoria)): ?>
<div class="central">
    <div class="titulo">
        <h2><?=$categoria->nombre;?></h2>
    </div>
    <div class="contenedor-productos ">
        <?php if(!empty($productos) && $productos->num_rows != 0): ?>
        <?php while($prod = $productos->fetch_object()): ?>
            <a href="producto/ver&id=<?=$prod->id;?>">
                <div class="producto">
                    <div class="img-producto">
                        <?php if($prod->imagen != null): ?>
                            <img src="<?=$prod->imagen;?>" alt="Producto">
                        <?php else: ?>
                            <img src="assets/img/camiseta.png" alt="Producto">
                        <?php endif; ?>
                    </div>
                    <div class="contenido-producto">
                        <h3><?=$prod->nombre;?></h3>
                        <label><?=substr($prod->descripcion,0, 40) . '...';?></label>
                        <p>$<?=$prod->precio;?></p>
                        <a href="carrito/agregar&id=<?=$prod->id;?>" class="btn btn-comprar">Comprar</a>
                        <a href="carrito/agregar&id=<?=$prod->id;?>&ir=0" class="btn btn-carrito"><i class="fas fa-shopping-cart"></i></a>
                    </div>
                </div><!--  .fin-producto  -->
            </a>
        <?php endwhile; ?>
        <?php else: ?>
            <h3 class="productos-no">No hay productos en esta categoria.</h3>
        <?php endif; ?>
    </div><!--  .fin-contenedor-productos  -->
</div><!--  .fin-central  -->
<?php else: ?>
<?php errorController::showError(); ?>
<?php endif; ?>