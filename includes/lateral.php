<aside id="sidebar">
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3>
            <!-- botones -->
            <a href="crear-entrada.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton ">Crear categoria</a>
            <a href="cerrar.php" class="boton boton-naranja">Ajustes</a>
            <a href="cerrar.php" class="boton boton-rojo">Cerrar sesion</a>
        </div>
    <?php endif; ?>
    
    <?php if(!isset($_SESSION['usuario'])): ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>
            <?php if(isset($_SESSION['error_login'])): ?>
                <div class="alerta error">
                    <?=$_SESSION['error_login']?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />

                <label for="password">Password</label>
                <input type="password" name="password" />

                <input type="submit"value="Entrar" />
            </form>
        </div>

        <div id="register" class="bloque">
            <h3>Registrate</h3>
            <?php if(isset($_SESSION['completado' ])) : ?>
                <div class="alerta">
                    <?= $_SESSION['completado']?>
                </div>
            <?php elseif(isset($_SESSION['errores']['general'])): ?>
                <div class="alerta error">
                    <?= $_SESSION['errores']['general']?>
                </div>
            <?php endif; ?>
            <form action="registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

                <label for="email">Email</label>
                <input type="email" name="email" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <label for="password">Password</label>
                <input type="password" name="password" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

                <input type="submit"value="Registrar" name="submit" />
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>