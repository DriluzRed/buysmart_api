<!-- resources/views/errors/500.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>¡Oh no! Algo salió mal 😔</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }
        .error-container {
            text-align: center;
            padding: 30px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .error-code {
            font-size: 6rem;
            color: #dc3545;
        }
        .error-message {
            font-size: 1.8rem;
            margin: 10px 0;
            color: #333;
        }
        .error-description {
            font-size: 1.1rem;
            color: #6c757d;
            margin: 15px 0;
        }
        .btn {
            margin-top: 20px;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 50px;
        }
        .illustration {
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <img src="https://cdn-icons-png.flaticon.com/512/753/753345.png" alt="Error Illustration" class="illustration">
        <div class="error-code">500</div>
        <h1 class="error-message">¡Oops! Algo no salió como esperábamos</h1>
        <p class="error-description">
            Nuestro equipo ya está trabajando para solucionarlo. Mientras tanto, 
            puedes volver a la página principal o contactarnos si necesitas ayuda.
        </p>
        <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
        <a href="" class="btn btn-outline-secondary">Si el error persiste por favor enviar un correo a desarrollo.goal@gmail.com</a>
    </div>
</body>
</html>
