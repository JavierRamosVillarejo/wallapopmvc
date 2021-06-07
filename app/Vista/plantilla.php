<?php 
$usuario = Session::obtener();
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?=RUTA?>web/css/estilos.css">
        <script src="https://use.fontawesome.com/1ee205d35b.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?= RUTA ?>web/js/jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <div class="header">
            <h1>Práctica Wallapop</h1>
            <div class="form_login">
                <?php if (Session::esta_iniciada()): ?>
                    <p>Bienvenido <?= $usuario->getNombre() ?><p>
                    <a href="<?= RUTA ?>logout">Cerrar Sesión</a>
                    <?php else: ?>
                    <form action="<?= RUTA ?>login" method="post">
                        <input class="input_login" name ="email" type="email" placeholder="Email"><br>
                        <input class="input_login" name ="password" type="password" placeholder="Contraseña"><br>
                        <input class="input_login" type="submit" value="Iniciar Sesion">
                        <a href="<?= RUTA ?>registrar">Registro</a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="div_linea">
            <hr class="my-1">
        </div>
        <div class="menu">
            <a class="navbar-brand" href="<?= RUTA ?>listar_anuncios">Anuncios</a>
            <?php if (Session::esta_iniciada()): ?>
                <a class="navbar-brand" href="<?= RUTA ?>mis_anuncios/<?= $usuario->getId() ?>">Mis anuncios</a>
                <a class="navbar-brand" href="<?= RUTA ?>anuncios_favoritos/<?= $usuario->getId() ?>">Anuncios favoritos</a><br>
            <?php endif; ?>
            <hr class="my-2">
        </div>
        <div class="main">
            <span class="mensaje_flash" style="color: red;"><?= MensajeFlash::imprimir_mensajes() ?></span><br/>
            <?php echo $vista ?>
        </div>
    </body>
</html>
