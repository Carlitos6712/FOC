<?php
/**
 * RA04 - user.php
 *
 * Página para el rol usuario estándar.
 *
 * @author  Carlos Vico
 * @version 1.0
 */
session_start();

if (empty($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Área Usuario</title>
<style>body{font-family:Arial,sans-serif;max-width:500px;margin:3rem auto;}
button{padding:.5rem 1rem;background:#333;color:#fff;border:none;cursor:pointer;}</style>
</head>
<body>
<h1>Área de Usuario</h1>
<p>Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>. Rol: <?php echo $_SESSION['rol']; ?></p>
<form method="POST">
    <button name="logout">Cerrar sesión</button>
</form>
</body>
</html>
