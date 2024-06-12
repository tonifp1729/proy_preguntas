<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reconociendo</title>
        <link rel="stylesheet" href="src\css\estilosexaminator.css">
    </head>
    <body>
        <div class="container">
            <h1>¡¡Subida fallida</h1>
            <?php
                //Comprueba si se han recibido avisos de error y en caso afirmativo muestra el mensaje.
                if(isset($error)) {
                    if($error == 'fallo_proceso') {
                        echo "<p class='error'>Ha habido un fallo al mover los archivos.</p>";
                    } else if($error == 'tipo_archivo') {
                        echo "<p class='error'>Solo se permiten archivos PDF.</p>";
                    } else if($error == 'no_seleccionado') {
                        echo "<p class='error'>No se ha seleccionado ningún archivo. Debe ser tipo PDF.</p>";
                    }
                }
            ?>
            <br>
            <a href="index.php?controlador=cpreguntas&action=irsubirbajar">Volver</a>
        </div>
    </body>
</html>