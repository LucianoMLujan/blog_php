<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- caja principal -->
<div id="principal">
    <h1>Mis Datos</h1>
    
    <?php if(isset($_SESSION['completado' ])) : ?>
        <div class="alerta">
            <?= $_SESSION['completado']?>
        </div>
    <?php elseif(isset($_SESSION['errores']['general'])): ?>
        <div class="alerta error">
            <?= $_SESSION['errores']['general']?>
        </div>
    <?php endif; ?>
    <form action="actualizar-usuario.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre']?>" />
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" value="<?=$_SESSION['usuario']['apellidos']?>" />
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>
        
        <label for="email">Email</label>
        <input type="email" name="email" value="<?=$_SESSION['usuario']['email']?>" />
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

        <input type="submit"value="Actualizar" name="submit" />
    </form>
    <?php borrarErrores(); ?>
    
</div>

        
<!-- pie de pagina -->
<?php include_once 'includes/pie.php'; ?>