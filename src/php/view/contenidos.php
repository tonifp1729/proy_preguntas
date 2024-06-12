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
            <h2>Aquí estamos trasteando con los archivos:</h2>
            <form method="POST" action="index.php?controlador=cpreguntas&action=bajarpdf">
            <label for="selexam">Contenidos registrados: </label>
                    <select id="selexam" name="selexam" required>
                        <option value="">--Selecciona uno de los contenidos</option>
                        <?php
                            foreach ($datosVista['data']['examenes'] as $examen) {
                                echo '<option value="'.$examen['idExamen'].'">'.$examen['nombreExamen'].'</option>';
                            }
                        ?>
                    </select>
                <button type="submit"  class="btn">Bajar en PDF</button>
            </form>
            <br>
            <form method="POST" action="index.php?controlador=cpreguntas&action=guardarArchivos" enctype="multipart/form-data">
                <label for="archivoPDF">Subir archivos (PDF): </label>
                <input type="file" id="archivoPDF" name="archivoPDF" accept=".pdf" required>
                
                <button type="submit" class="btn">Enviar</button>
            </form>
            <br>
            <a href="index.php?controlador=cpreguntas&action=irindice">Volver al índice</a>
        </div>
        <script src="preguntas.js"></script>
    </body>
</html>