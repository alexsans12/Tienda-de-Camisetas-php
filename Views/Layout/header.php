<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="La mejor tienda de playeras para la compra online">
    <meta name="keywords" content="playera, camisa, tienda, tienda online, online, t-shirt, shirt, store, web store">
    <meta name="author" content="Alexsans">
    <meta name="copyright" content="Alexsans 2020">
    <base href="<?=base_url?>">
    <title>Tienda de Playeras | La mejor tienda de playeras online</title>
    <script src="https://kit.fontawesome.com/b6ba64d131.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<!--    CABECERA    -->
<header class="header">
    <div class="contenedor clearfix logo">
        <a href="">
            <h1>Tienda de Playeras</h1>
        </a>
        <p>La mejor tienda de <span>playeras online</span></p>
    </div>
</header>
<!--    MENU    -->
<div class="barra">
    <div class="contenedor clearfix">
        <div class="logo-letras">
            <a href="">
                <h1>Tienda Playeras</h1>
            </a>
        </div>
        <div class="menu-movil">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="nav-menu clearfix">
            <a href="">Inicio</a>
            <?php $categoria =  Utilidades::showCategorias();?>
            <?php while($cate = $categoria->fetch_object()): ?>
                <a href="categoria/ver&id=<?=$cate->id;?>"><?=$cate->nombre;?></a>
            <?php endwhile; ?>
        </nav>
    </div>
</div>

<div class="contenedor clearfix">