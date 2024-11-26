<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por registrarte</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* Fondo suave */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 2rem;
            color: #05676e;
        }

        p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .btn-primary {
            background-color: #05676e;
            border-color: #05676e;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #044f58;
            border-color: #044f58;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" alt="Logo Registro de Emprendedores" class="logo">

        <!-- Título -->
        <h1>¡Gracias por registrarte!</h1>

        <!-- Mensaje -->
        <p>
            Nos estaremos comunicando con vos en los próximos días para brindarte más información sobre 
            futuras capacitaciones, ferias y otras iniciativas. ¡Te agradecemos ser parte de nuestra comunidad!
        </p>

        <!-- Botón para volver -->
        <a href="/welcome" class="btn btn-primary">Volver al inicio</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>