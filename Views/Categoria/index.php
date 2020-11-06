<div class="titulo">
    <h2>Gestionar categorias</h2>
</div>
<div class="contenedor-productos">
    <?php if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'completado'): ?>
        <div class='alerta' id="alerta">Categoria creada correctamente.</div>
    <?php endif; ?>
    <?php if(isset($_SESSION['borrar']) && $_SESSION['borrar'] == 'completado'): ?>
        <div class='alerta' id="alerta">Categoria eliminada correctamente.</div>
    <?php elseif(isset($_SESSION['borrar']) && $_SESSION['borrar'] == 'fallido'): ?>
        <div class='alerta' id="alerta">Algo fallo al eliminar la categoria.</div>
    <?php endif; ?>
    <?php Utilidades::borrarSessiones('registro'); ?>
    <?php Utilidades::borrarSessiones('borrar'); ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre de la Categoria</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($cat = $categorias->fetch_object()): ?>
                <tr>
                    <th scope="row"><?=$cat->id;?></th>
                    <td><?=$cat->nombre;?></td>
                    <td>
                        <a href="categoria/borrar&id=<?=$cat->id;?>" class="btn btn-borrar"><i class="fas fa-trash-alt"></i> Borrar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div>
        <a href="categoria/crear" class="btn btn-comprar">Crear Categoria</a>
    </div>
</div>

