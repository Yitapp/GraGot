
<select class="form-control">
    <?php foreach (get_categories() as $categoria) {
        $categoriaActual = array_key_exists('categoriaActual', $_COOKIE) ? $_COOKIE['categoriaActual'] : 2; // La 2 es PHP

        if($categoria->parent == 0) {
            ?> <option <?= ($categoriaActual == $categoria->cat_ID) ? 'selected' : '' ?> value="<?= $categoria->cat_ID ?>"><?= $categoria->name ?></option> <?php
        }
    } ?>
</select>

<div id="tree">
    <?php
        $categoria = array_key_exists('categoriaActual', $_COOKIE) ? $_COOKIE['categoriaActual'] : 2; // La 2 es PHP
        hierarchical_category_tree($categoria); // the function call; 0 for all categories; or cat ID
    ?>
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
        foreach( $opciones as $cat ) :
            ?>
            <?php if(isset($cat->count)) { ?>
                <ul><li id="<?= $cat->cat_ID ?>">
                <a href="<?= get_category_link($cat->cat_ID); ?>"><?= $cat->name ?> (<?= $cat->count ?>)</a>
                <?php hierarchical_category_tree( $cat->term_id ); ?>
            <?php } else {

                ?>
                <ul>
                    <li data-jstree='{"icon":"jstree-file"}'>
                        <a href="<?= get_post_permalink($cat->ID) ?>" class=""><?= $cat->post_title ?></a>
                </li>
                </ul>
            <?php } ?>

            <?php
        endforeach;
    endif;

    ?> </li></ul> <?php

}

$post = get_post();
$idsCategoriasPadre = [];
$categoriasDelPost = get_the_category($post->ID);
foreach ($categoriasDelPost as $categoriaId) {
	$categoriasPadre = get_category_parents($categoriaId);
	$explode = explode('/', $categoriasPadre);
	foreach ($explode as $catName) {
	    if(!empty($catName)) {
		    $idsCategoriasPadre[] = get_cat_ID($catName);
        }
    }
}



?>

<script>

    $('#tree').jstree({ "plugins" : ["themes","html_data","ui"] });
    $("#tree li").on("click", "a",
        function() {
            document.location.href = this;
        }
    );

    <?php foreach ($idsCategoriasPadre as $categoriaId) { ?>
        $("#tree").jstree('open_node', <?= $categoriaId ?>);
    <?php } ?>

</script>
