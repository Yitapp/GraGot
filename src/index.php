<?php
/**
 * Paguina de inicio para la aplicacion
 */
?>

<!DOCTYPE html>
<html lang="es">

<?php get_header() ?>



<body>

<?php include 'navbar.php' ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-4">


                    <?php get_sidebar(); ?>

        </div>

        <div class="col-8 ultimos-post-actualizados">

            <div class="card-deck">
                <?php
                $lastupdated_args = array(
                    'orderby' => 'modified',
                    'posts_per_page' => 8
                );
                $wpQuery = new WP_Query( $lastupdated_args );

                $i = 1;
                foreach ($wpQuery->posts as $post) {

                    ?>
                    <div class="tarjeta">

                        <div class="card-body">
                            <a href="<?= get_post_permalink($post->ID) ?>">
                                <h4 class="card-title" style="display: inline;"><?= $post->post_title ?></h4>
                                <a href="<?= get_edit_post_link($post->ID) ?>" class="ajustes-post"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            </a>
                            <hr>

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

        </div>

    </div>
</div>

<?php get_footer(); ?>

</body>
</html>