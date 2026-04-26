<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); max-width: 600px; margin: 0 auto;}
        .btn { display: inline-block; background: #198754; color: #fff !important; padding: 12px 24px; border-radius: 5px; text-decoration: none; margin-top: 20px;}
        .logo { width: 180px; margin-bottom: 20px;}
        .footer { color: #888; font-size: 12px; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://supermotos.company/img/logo_supermotos.png" alt="SuperMotos" class="logo">
        <h2>¡Gracias!</h2>
        <p>Hola,</p>
        <p>Te agradecemos por confiar en <b>Super Motos Company</b>. Tu publicación ha sido creada exitosamente.</p>
        <p>Puedes ver tu publicación en el siguiente enlace:</p>
        <a href="{{ $linkPublica }}" class="btn" target="_blank">Ver mi publicación</a>
        <p style="margin-top:30px;"></p>
        <div class="footer">
            &copy; {{ date('Y') }} Super Motos Company. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
