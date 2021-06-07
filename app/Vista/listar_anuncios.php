<?php
ob_start();
?>

<?php if (Session::esta_iniciada()): ?>
    <a class="btn_insertar_anuncio btn btn-primary" href="<?= RUTA ?>insertar_anuncio">Insertar anuncio</a><br/>
    <?php
    $usuario = Session::obtener();
    $arr_favoritos = $usuario->getFavoritos();
    ?>
<?php endif; ?>

<?php foreach ($anuncios as $a): ?>
    <div class="card">
        <?php
        $nombre_foto = $a->getFoto()->getFoto();
        if ($nombre_foto):
            ?>
            <img class="card-img-top" src="<?= RUTA ?>/web/imagenes/<?= $nombre_foto ?>">
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"><a href="<?= RUTA ?>ver_anuncio/<?= $a->getId() ?>"><?= $a->getTitulo() ?></a></h5>
            <div class="descripcion_anuncio">
                <p class="card-text"><?= $a->getDescripcion() ?></p>
            </div>
            <p class="card-text font-weight-bold"> <?= $a->getPrecio() ?> €</p>
            <?php if (Session::esta_iniciada()): ?>
                <button data-idu="<?= Session::obtener()->getId() ?>" data-ida="<?= $a->getId() ?>" type="button" id="like_button" class="like_btn" 
                <?php
                $fav = false;
                foreach ($arr_favoritos as $anun_fav) {
                    if ($a->getId() == $anun_fav->getId()) {
                        $fav = true;
                        break;
                    }
                }
                if ($fav):
                    ?>
                            disabled="disable" style="background-color: red; color: white;"
                        <?php endif; ?>>Añadir a favoritos</button>
                    <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>


<script type="text/javascript">
    $('button').click(function () {
        var btn = $(this);
        $.ajax({
            url: "<?= RUTA ?>anadir_fav",
            type: 'post',
            data: {id_usuario: $(this).attr('data-idu'), id_anuncio: $(this).attr('data-ida')},
            success: function (result, status, xhr) {
                if (result == 'fav')
                    ;
                {
                    
                    btn.attr("disabled", "disable");
                    btn.css("background-color", "red");
                    btn.css("color", "white");
                }
            },
            error: function (xhr, status, error) {
                alert("Error al añadir a favoritos");
            }
        });
    });
</script>

<?php
$vista = ob_get_clean();
require 'plantilla.php';
?>