<div class="titulo">
    <h2>Gestion de Productos</h2>
</div>
<div class="contenedor-productos">
    <?php if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'completado'): ?>
    <div class='alerta' id="alerta">Producto Actualizado Correctamente.</div>
    <?php endif; ?>
    <?php if(isset($_SESSION['borrar']) && $_SESSION['borrar'] == 'completado'): ?>
        <div class='alerta' id="alerta">Producto eliminado correctamente.</div>
    <?php elseif(isset($_SESSION['borrar']) && $_SESSION['borrar'] == 'fallido'): ?>
        <div class='alerta' id="alerta">Algo fallo al eliminar el producto.</div>
    <?php endif; ?>
    <?php Utilidades::borrarSessiones('registro'); ?>
    <?php Utilidades::borrarSessiones('borrar'); ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre de la Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php while($pro = $productos->fetch_object()): ?>
                <tr>
                    <th scope="row"><?=$pro->id;?></th>
                    <td><?=$pro->nombre;?></td>
                    <td><?=$pro->precio;?></td>
                    <td><?=$pro->stock;?></td>
                    <td>
                        <a href="producto/editar&id=<?=$pro->id;?>" class="btn btn-editar"><i class="fas fa-pencil-alt"></i></a>
                        <a href="producto/borrar&id=<?=$pro->id;?>" class="btn btn-borrar"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div>
        <a href="producto/crear" class="btn btn-comprar">Agregar Producto</a>
    </div>
</div>
