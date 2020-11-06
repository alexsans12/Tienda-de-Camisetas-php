<div class="central">
    <div class="contenedor-producto">
        <div class="img-producto">
            <?php if($producto->imagen != null): ?>
                <img src="<?=$producto->imagen;?>" alt="Producto">
            <?php else: ?>
                <img src="assets/img/camiseta.png" alt="Producto">
            <?php endif; ?>
        </div>
        <div class="contenido-producto">
            <h3><?=$producto->nombre;?></h3>
            <label style="color: black">Descripción:</label>
            <label><?=$producto->descripcion;?></label>
            <p><span>Precio: </span>$<?=$producto->precio;?></p>
            <?php if($producto->stock > 0): ?>
                <p>Si hay existencias</p>
            <?php endif; ?>
            <label><span>Categoria: <a href="categoria/ver&id=<?=$categoria->id;?>"><?=$categoria->nombre;?></a></span></label>
            <form action="carrito/agregar&id=<?=$producto->id;?>" method="post">
                <label name="algo" style="color: black; margin-top: 10px;">
                    Cantidad: <input name="cantidad" type="number" value="1" min="1" max="<?=$producto->stock;?>" title="cantidad de productos">
                </label>
                <button type="submit" style="width: 100%; cursor: pointer" class="btn btn-carrito">Añadir al Carrito <i class="fas fa-shopping-cart"></i></button>
            </form>
        </div>
    </div><!--  .fin-contenedor-productos  -->
</div><!--  .fin-central  -->