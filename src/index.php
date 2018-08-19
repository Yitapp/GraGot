<?php
/**
 * Paguina de inicio para la aplicacion
 */
?>

<?php ob_start() ?>
<div class="card-deck">
	<?php
    $lastupdated_args = array(
        'orderby' => 'modified',
        'posts_per_page' => 4
    );

    $page_object = get_queried_object();
    if($page_object != null) {
	    $lastupdated_args['cat'] = $page_object->cat_ID;
    }

	$wpQuery = new WP_Query( $lastupdated_args );

	$i = 1;
	foreach ($wpQuery->posts as $post) {

	?>
    <div class="tarjeta">

        <div class="card-header">
            <a href="<?= get_post_permalink($post->ID) ?>">
                <h1 class="card-title" style="display: inline;"><?= $post->post_title ?></h1>
                <a href="<?= get_edit_post_link($post->ID) ?>" class="ajustes-post"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </a>
        </div>

        <div class="card-body">
			<?php $categorias = get_the_category($post->ID);

			foreach ($categorias as $categoria) { ?>
                <a href="#" class="badge badge-success" style="font-size: 18px;"><?= $categoria->name ?></a>
				<?php
			}

			?>
			<?php
			$campoPersonalizado = get_post_meta($post->ID, 'YouTube');
			if(!empty($campoPersonalizado)) {
				?> <a href="#" class="badge badge-danger" style="font-size: 18px;">YouTube</a> <?php
			}
			?>
        </div>
        <div class="card-footer" style="background-color: #FFF">
            <small class="text-muted">Ultima actualizacion: <?= $post->post_modified ?></small>
        </div>
    </div>
	<?php


	/*if($i == 2 || $i == 5) { */?>
</div>
<br>
<div class="card-deck">
	<?php /*}*/
	$i++;
	}

	?>
</div>
<?php $view = ob_get_clean() ?>

<?php include "template.php"; ?>