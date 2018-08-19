<?php
ob_start();
while ( have_posts() ) { the_post(); ?>
    <div class="card-deck">
        <div class="tarjeta">
            <div class="card-body">
                <a href="<?= get_post_permalink($post->ID) ?>">
                    <h4 class="card-title" style="display: inline;"><?= $post->post_title ?></h4>
                    <a href="<?= get_edit_post_link($post->ID) ?>" class="ajustes-post"><i class="fa fa-cog" aria-hidden="true"></i></a>
                </a>
                <hr>
				<?= htmlspecialchars(substr(get_the_content(), 0, 600)) ?>
            </div>
            <div class="card-footer" style="background-color: #FFF">
                <small class="text-muted">Ultima actualizacion: <?= $post->post_modified ?></small>
            </div>
        </div>
    </div>
    <br>
<?php
}
$view = ob_get_clean();
?>

<?php include "template.php"; ?>