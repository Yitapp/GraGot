<?php
/**
 * Paguina para visuliza un psot
 */
?>

<?php
ob_start();
while ( have_posts() ) { the_post(); ?>
    <a href="<?= get_post_permalink($post->ID) ?>">
        <h4 class="card-title" style="display: inline;"><?= $post->post_title ?></h4>
        <a href="<?= get_edit_post_link($post->ID) ?>" class="ajustes-post"><i class="fa fa-cog" aria-hidden="true"></i></a>
    </a>
    <hr>
	<?= the_content() ?>
    <small class="text-muted">Ultima actualizacion: <?= $post->post_modified ?></small>
<?php
}
$view = ob_get_clean();
?>

<?php include "template.php"; ?>