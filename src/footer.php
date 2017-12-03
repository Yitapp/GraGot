<script>
$('.contenedor-categorias select').change(function () {
    document.cookie = "categoriaActual="+$(this).val();
    window.location.reload();
})
</script>
