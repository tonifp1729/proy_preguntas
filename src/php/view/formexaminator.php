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
            <h2>Formulario de Preguntas</h2>
            <form id="formPreguntas" method="POST" action="index.php?controlador=cpreguntas&action=nuevoexamen">
                <div>
                    <label for="nombreExamen">Nombre del Examen:</label>
                    <input type="text" id="nombreExamen" name="nombreExamen" required>
                </div>
                <div id="containerPreguntas">
                    <!-- Las preguntas generadas irán aquí -->
                </div>
                <button type="button" id="btnAgregar">Agregar nueva pregunta</button>
                <button type="submit">Guardar</button>
            </form>
        </div>
        <script src="preguntas.js"></script>
    </body>
</html>