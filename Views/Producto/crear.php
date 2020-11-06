<div class="form-registro">
    <div class="titulo">
        <?php if(isset($_GET['action']) && $_GET['action'] == 'crear'): ?>
            <h2>Agregar Producto</h2>
        <?php elseif(isset($_GET['action']) && $_GET['action'] == 'editar'): ?>
            <h2>Editar Producto</h2>
        <?php endif; ?>
    </div>
    <form action="<?=base_url . $url_action?>" method="post" enctype="multipart/form-data">
        <?php if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'fallido'): ?>
            <div class='alerta alerta-error' id="alerta">Ha ocurrido un error al agregar el producto.</div>
        <?php endif; ?>
        <?php Utilidades::borrarSessiones('registro'); ?>
        <div class="nombre-reg">
            <label for="nombre-form">Nombre:</label>
            <input placeholder="Nombre" value="<?=isset($producto) && is_object($producto) ? $producto->nombre : '';?>" type="text" id="nombre-form" name="nombre" required title="El campo solo puede contener letras">
            <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'nombre') : '';  ?>
        </div>
        <div class="apellidos-reg">
            <label for="precio-form">Precio:</label>
            <input placeholder="00.00" value="<?=isset($producto) && is_object($producto) ? $producto->precio : '';?>" type="number" id="precio-form" name="precio" required pattern="[0-9]+" title="El campo solo puede contener numeros">
            <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'precio') : '';  ?>
        </div>

        <?php $categorias = Utilidades::showCategorias();?>
        <label for="categoria-form">Categoria:</label>
        <select id="categoria-form" name="categoria" title="Seleccione la categoria a la que pertenece el producto">
            <option disabled selected>-- Seleccione una Categoria --</option>
            <?php while($cat = $categorias->fetch_object()): ?>
            <?php if($producto->categoria_id == $cat->id): ?>
                <option value="<?=$cat->id?>" selected><?=$cat->nombre?></option>
            <?php else:?>
                    <option value="<?=$cat->id?>"><?=$cat->nombre?></option>
            <?php endif; ?>
            <?php endwhile; ?>
        </select>
        <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'categoria') : '';  ?>

        <div class="nombre-reg">
            <label for="stock-form">Stock:</label>
            <input placeholder="00" value="<?=isset($producto) && is_object($producto) ? $producto->stock : '';?>" type="number" min="0" id="stock-form" name="stock" required pattern="[0-9]+" title="El campo solo puede contener numeros">
            <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'stock') : '';  ?>
        </div>
        <div class="apellidos-reg">
            <label for="oferta-form">Oferta:</label>
            <input placeholder="00.00" value="<?=isset($producto) && is_object($producto) ? $producto->oferta : '';?>" type="number" id="oferta-form" name="oferta" pattern="[0-9]+" title="El campo solo puede contener numeros">
        </div>

        <label for="descripcion-form">Descripción:</label>
        <textarea name="descripcion" id="descripcion-form" cols="30" rows="10" placeholder="Descripción del producto..."><?=isset($producto) && is_object($producto) ? $producto->descripcion : '';?></textarea>
        <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'descripcion') : '';  ?>

        <label for="imagen-form">Imagen:</label>
        <?php if(isset($producto) && is_object($producto) && !empty($producto->imagen)):?>
            <img class="thumb" src="<?=$producto->imagen?>" alt="Imagen del producto <?=isset($producto) && is_object($producto) ? $producto->nombre : '';?>">
        <?php endif; ?>
        <input type="file" accept=".jpg, .jpeg, .png" id="imagen-form" name="imagen" title="La imagen debe ser jpg, jpeg o png">
        <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'imagen') : '';  ?>

        <input class="btn btn-login" type="submit" value="Agregar" name="Agregar">
    </form>
    <?php Utilidades::borrarSessiones('errores'); ?>
</div>