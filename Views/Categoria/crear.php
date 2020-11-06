<div class="form-registro">
    <div class="titulo">
        <h2>Crear Categoria</h2>
    </div>
    <form action="<?=base_url?>categoria/guardar" method="post">
        <?php if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'fallido'): ?>
            <div class='alerta alerta-error' id="alerta">Hubo un error al guardar la categoria.</div>
        <?php endif; ?>
        <?php Utilidades::borrarSessiones('registro'); ?>
        <label for="nombre-form">Nombre de la Categoria:</label>
        <input placeholder="Nombre" type="text" id="nombre-form" name="nombre" required pattern="[A-Za-z ]+" title="El campo solo puede contener letras">
        <input class="btn btn-login" type="submit" value="Crear" name="Crear">
    </form>
</div>
