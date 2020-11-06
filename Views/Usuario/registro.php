<div class="form-registro">
    <div class="titulo">
        <h2>Registrarse</h2>
    </div>
    <form action="<?=base_url?>usuario/guardar" method="post">
        <?php if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'completado'): ?>
            <div class='alerta' id="alerta">Registro Completado Correctamente.</div>
        <?php elseif(isset($_SESSION['registro']) && $_SESSION['registro'] == 'fallido'): ?>
            <div class='alerta alerta-error' id="alerta">Registro fallido.</div>
        <?php endif; ?>
        <?php Utilidades::borrarSessiones('registro'); ?>
        <div class="nombre-reg">
            <label for="nombre-form">Nombre:</label>
            <input placeholder="Nombre" type="text" id="nombre-form" name="nombre" required pattern="[A-Za-z ]+" title="El campo solo puede contener letras">
            <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'nombre') : '';  ?>
        </div>
        <div class="apellidos-reg">
            <label for="apellidos-form">Apellidos:</label>
            <input placeholder="Apellidos" type="text" id="apellidos-form" name="apellidos" required pattern="[A-Za-z ]+" title="El campo solo puede contener letras">
            <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'apellidos') : '';  ?>
        </div>

        <label for="email-form">Email:</label>
        <input placeholder="email@email.com" type="email" id="email-form" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingrese un correo electrónico válido">
        <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'email') : '';  ?>

        <label for="password-form">Contraseña:</label>
        <input placeholder="Contraseña" type="password" id="password-form" name="password" required pattern=".{8,}" title="La contraseña debe contener 8 o más caracteres">
        <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'password') : '';  ?>

        <input class="btn btn-login" type="submit" value="Registrarse" name="Registro">
    </form>
    <?php Utilidades::borrarSessiones('errores'); ?>
</div>



