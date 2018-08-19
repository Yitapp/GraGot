<!DOCTYPE html>
<html lang="es">

<?php get_header() ?>

<body>

<?php include 'navbar.php' ?>

<div class="container-fluid" style="height: 100%;">
	<div class="row" style="height: 100%;">
		<div id="sidebar" class="col-3 contenedor-categorias">
			<?php get_sidebar(); ?>
		</div>
		<div id="post" class="col-9">
			<?= $view ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>

</body>
</html>
