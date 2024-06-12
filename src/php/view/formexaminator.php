<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examinator</title>
    <link rel="stylesheet" href="src/css/estilosexaminator.css">
</head>
<body>
    <div class="container">
        <h2>Prepara tu examen aquí</h2>
        <form id="formularioPreguntas" method="POST" action="index.php?controlador=cpreguntas&action=nuevoexamen">
            <div class="grupo-formulario">
                <label for="nombreExamen">Nombre del Examen:</label>
                <input type="text" id="nombreExamen" name="nombreExamen" required>
            </div>
            <div id="contenedorPreguntas">
                <!-- Las preguntas generadas irán aquí -->
            </div>
            <button type="button" id="btnAgregar" class="btn">Agregar nueva pregunta</button>
            <button type="submit" class="btn">Guardar</button>
        </form>
        <br>
        <a href="index.php?controlador=cpreguntas&action=irindice">Volver al índice</a>
    </div>
    <script src="preguntas.js"></script>
</body>
</html>