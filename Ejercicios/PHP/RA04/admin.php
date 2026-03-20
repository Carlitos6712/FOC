<?php
/**
 * RA04 - admin.php
 *
 * Página exclusiva para el rol administrador.
 * Redirige a login si no hay sesión activa con el rol correcto.
 *
 * @author  Carlos Vico
 * @version 1.0
 */
session_start();

// Protección: sin sesión o sin rol administrador → login
if (empty($_SESSION['usuario']) || $_SESSION['rol'] !== 'administrador') {
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
<head><meta charset="UTF-8"><title>Panel Admin</title>
<style>body{font-family:Arial,sans-serif;max-width:500px;margin:3rem auto;}
button{padding:.5rem 1rem;background:#333;color:#fff;border:none;cursor:pointer;}</style>
</head>
<body>
<h1>Panel de Administración</h1>
<p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong> (<?php echo $_SESSION['rol']; ?>)</p>
<form method="POST">
    <button name="logout">Cerrar sesión</button>
</form>
</body>
</html>
