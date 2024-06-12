//ESTE ES EL SCRIPT QUE MANEJA PARTE DEL FORMULARIO

document.addEventListener('DOMContentLoaded', () => {
    const btnAgregar = document.getElementById('btnAgregar');
    const contenedorPreguntas = document.getElementById('contenedorPreguntas');

    btnAgregar.addEventListener('click', () => {
        const preguntaDiv = document.createElement('div');
        preguntaDiv.classList.add('pregunta');

        const indicePregunta = contenedorPreguntas.children.length;

        preguntaDiv.innerHTML = `
            <input type="text" name="preguntas[${indicePregunta}][pregunta]" placeholder="Escribe la pregunta" required>
            <div class="respuestas">
                <div>
                    <input type="radio" name="preguntas[${indicePregunta}][respuestaCorrecta]" value="0" required>
                    <input type="text" name="preguntas[${indicePregunta}][respuestas][]" placeholder="Respuesta 1" required>
                </div>
                <div>
                    <input type="radio" name="preguntas[${indicePregunta}][respuestaCorrecta]" value="1">
                    <input type="text" name="preguntas[${indicePregunta}][respuestas][]" placeholder="Respuesta 2" required>
                </div>
                <div>
                    <input type="radio" name="preguntas[${indicePregunta}][respuestaCorrecta]" value="2">
                    <input type="text" name="preguntas[${indicePregunta}][respuestas][]" placeholder="Respuesta 3" required>
                </div>
            </div>
            <button type="button" class="btnEliminarPregunta">Eliminar Pregunta</button>
        `;

        contenedorPreguntas.appendChild(preguntaDiv);

        const btnEliminarPregunta = preguntaDiv.querySelector('.btnEliminarPregunta');
        btnEliminarPregunta.addEventListener('click', () => {
            contenedorPreguntas.removeChild(preguntaDiv);
        });
    });
});