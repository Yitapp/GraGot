<div class="tarjeta" style="margin: 0">
    <div class="card-body contenedor-categorias">

<select class="form-control">
    <?php foreach (get_categories() as $categoria) {
        if($categoria->parent == 0) {
            ?> <option value="<?= $categoria->cat_ID ?>"><?= $categoria->name ?></option> <?php
        }
    } ?>
</select>

<style>
    #j1_1 {
        padding-top: 10px;
    }
    .jstree-default .jstree-clicked {
        box-shadow: none;
    }
</style>

<div id="tree">
    <?php
        $categoria = array_key_exists('categoriaActual', $_COOKIE) ? $_COOKIE['categoriaActual'] : 9;
        hierarchical_category_tree($categoria); // the function call; 0 for all categories; or cat ID
    ?>
</div>

    </div>
</div>


<?php

function hierarchical_category_tree( $cat ) {

    $next = get_categories([
        'hide_empty' => 0,
        'parent' => $cat
    ]);

    $estadosPost = ['publish'];
    if(is_user_logged_in()) {
        $estadosPost[] = 'private';
        $estadosPost[] = 'draft';
    }

    $query = new WP_Query( array(
        'post_type'     => 'post',
        'post_status'   => $estadosPost,
        'tax_query'     => array(
            array(
                'taxonomy'          => 'category',
                'terms'             => array( $cat ), // TODO $cat seguridad
                'field'             => 'term_id',
                'operator'          => 'AND',
                'include_children'  => false
            )
        )
    ) );

    $opciones = array_merge($next, $query->posts );

    if( $opciones ) :
        foreach( $opciones as $cat ) : ?>
            <?php if(isset($cat->count)) { ?>
                <ul><li>
                <?= $cat->name ?> (<?= $cat->count ?>)
                <?php hierarchical_category_tree( $cat->term_id ); ?>
            <?php } else {

                ?>
                <ul><li data-jstree='{"icon":"jstree-file"}'>
                        <a href="<?= get_post_permalink($cat->ID) ?>" class="jstree-clicked"><?= $cat->post_title ?></a>
                    </li></ul>
            <?php } ?>

            <?php
        endforeach;
    endif;

    ?> </li></ul> <?php
}

?>



<script>


    $('#tree').jstree({ "plugins" : ["themes","html_data","ui"] });




    $("#tree li").on("click", "a",
        function() {

            document.location.href = this;
        }
    );

</script>
