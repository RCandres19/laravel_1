<!-- resources/views/auth/verify-email.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de correo electrónico</title>
</head>
<body>
    <div>
        <h1>Verifica tu correo electrónico</h1>
        <p>Te hemos enviado un correo electrónico con un enlace para verificar tu cuenta.</p>
        <p>Si no encuentras el correo en tu bandeja de entrada, revisa la carpeta de spam.</p>
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit">Reenviar correo de verificación</button>
        </form>
    </div>
</body>
</html>
