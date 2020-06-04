<h1>Registrarse</h1>

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
    <strong class="alert_red">Registro fallido</strong>
<?php endif; ?>
<?php Utils::deleteSession('register') ;?>


<form action="<?= base_url ?>usuario/save" method="post">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="" required>

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" id="" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" id="" required>

    <input type="submit" value="Registrarse">

</form>