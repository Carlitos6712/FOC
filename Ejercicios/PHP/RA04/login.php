<?php
/**
 * RA04 - login.php
 *
 * Autenticación de usuarios con redirección por rol.
 * Gestiona también el login simple de RA4_e (usuario foc / Fdwes!22).
 *
 * @author  Carlos Vico
 * @version 1.0
 */
session_start();

// Si ya hay sesión activa, redirigir según rol guardado
if (!empty($_SESSION['usuario'])) {
    $destino = ($_SESSION['rol'] === 'administrador') ? 'admin.php' : 'user.php';
    header("Location: $destino");
    exit;
}

/**
 * Usuarios válidos definidos como array estático.
 *
 * En producción estas credenciales vendrían de la base de datos
 * con la contraseña hasheada (password_hash / password_verify).
 *
 * @var array<string, array{password: string, rol: string}>
 */
$usuariosValidos = [
    'admin' => ['password' => 'admin123', 'rol' => 'administrador'],
    'user'  => ['password' => 'user123',  'rol' => 'usuario'],
    'foc'   => ['password' => 'Fdwes!22', 'rol' => 'usuario'],
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario    = trim($_POST['usuario']    ?? '');
    $password   = trim($_POST['password']   ?? '');

    if (isset($usuariosValidos[$usuario]) && $usuariosValidos[$usuario]['password'] === $password) {
        // Regenerar ID de sesión evita Session Fixation
        session_regenerate_id(true);

        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol']     = $usuariosValidos[$usuario]['rol'];

        $destino = ($_SESSION['rol'] === 'administrador') ? 'admin.php' : 'user.php';
        header("Location: $destino");
        exit;
    }

    $error = 'Credenciales incorrectas.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body  { font-family: Arial, sans-serif; max-width: 360px; margin: 4rem auto; background: #f4f4f4; }
        h1    { text-align: center; }
        label { display: block; margin-top: .8rem; }
        input { width: 100%; padding: .5rem; box-sizing: border-box; margin-top: .3rem; }
        button { width: 100%; padding: .6rem; background: #333; color: #fff; border: none; cursor: pointer; margin-top: 1rem; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>

<h1>Iniciar sesión</h1>

<?php if ($error !== '') : ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Usuario
        <input type="text" name="usuario" required autocomplete="username">
    </label>
    <label>Contraseña
        <input type="password" name="password" required autocomplete="current-password">
    </label>
    <button type="submit">Entrar</button>
</form>

</body>
</html>
