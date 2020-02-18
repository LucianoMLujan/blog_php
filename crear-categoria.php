<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- caja principal -->
<div id="principal">
    <h1>Crear categorias</h1>
    <p>
        Agregar nuevas categorias al blog para que los usuarios puedan usarlas al crear las entradas.
    </p>
    <br/>
    
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoria</label>
        <input type="text" name="nombre" />
        
        <input type="submit" value="Guardar" />
    </form>
    
</div>

        
<!-- pie de pagina -->
<?php include_once 'includes/pie.php'; ?>