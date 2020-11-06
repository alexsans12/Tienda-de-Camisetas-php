 <!--    BARRA LATERAL    -->
<aside class="lateral">
    <div class="login block-aside">
        <?php if(isset($_SESSION['identidad'])): ?>
        <h3><?=$_SESSION['identidad']->nombre . " " . $_SESSION['identidad']->apellidos?></h3>
        <?php else:?>
        <h3>Entra en la Web</h3>
        <form action="<?=base_url?>usuario/login" method="POST">
            <label for="email">Email:</label>
            <input type="email" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingrese un correo electrónico registrado">
            <label for="password">Contraseña:</label>
            <input type="password" placeholder="Contraseña" name="password" title="Ingresa tu contraseña">
            <input type="submit" class="btn btn-login" value="Entrar">
            <?= isset($_SESSION['errores']) ? Utilidades::mostrarErrores($_SESSION['errores'], 'login') : '';  ?>
            <label>No tienes una cuenta?</label>
            <a class="link" href="usuario/registro">Registrate! Haz click aqui</a>
        </form>
        <?php endif; ?>
        <a class="btn btn-carrito" style="margin-left: 0" href="carrito/index">Carrito <i class="fas fa-shopping-cart"></i></a>
        <?php if(isset($_SESSION['identidad'])): ?>
            <div class="options-movil">
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="despliege">
                <div class="options">
                    <a class="btn btn-lateral" href="pedido/mispedidos"><i class="fas fa-shopping-cart"></i> Mis Pedidos</a>

                    <?php if(isset($_SESSION['admin'])): ?>
                    <a class="btn btn-lateral" href="pedido/gestion"><i class="fas fa-address-book"></i> Gestionar Pedidos</a>
                    <a class="btn btn-lateral" href="producto/gestion"><i class="fas fa-archive"></i> Gestionar Productos</a>
                    <a class="btn btn-lateral" href="categoria/index"><i class="fas fa-clipboard-list"></i> Gestionar Categorias</a>
                    <?php endif; ?>

                    <a class="btn btn-lateral btn-rojo" href="usuario/logout"><i class="fas fa-user"></i> Cerrar Session</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php Utilidades::borrarSessiones('errores'); ?>
</aside>