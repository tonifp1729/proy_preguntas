//ESTE ES EL SCRIPT QUE MANEJA PARTE DEL FORMULARIO
document.addEventListener('DOMContentLoaded', () => {
    const btnAgregarPregunta = document.getElementById('btnAgregar');
    const contenedorPreguntas = document.getElementById('containerPreguntas');

    btnAgregarPregunta.addEventListener('click', () => {
        const divPregunta = document.createElement('div');
        divPregunta.classList.add('pregunta');

        const indicePregunta = contenedorPreguntas.children.length;

        divPregunta.innerHTML = `
            <input type="text" name="preguntas[${indicePregunta}][pregunta]" placeholder="Escribe la pregunta" required>
            <div class="respuestas">
                <div>
                    <input type="text" name="preguntas[${indicePregunta}][respuestas][]" placeholder="Respuesta 1" required>
                    <input type="radio" name="preguntas[${indicePregunta}][respuestaCorrecta]" value="0" required>
                </div>
                <div>
                    <input type="text" name="preguntas[${indicePregunta}][respuestas][]" placeholder="Respuesta 2" required>
                    <input type="radio" name="preguntas[${indicePregunta}][respuestaCorrecta]" value="1">
                </div>
                <div>
                    <input type="text" name="preguntas[${indicePregunta}][respuestas][]" placeholder="Respuesta 3" required>
                    <input type="radio" name="preguntas[${indicePregunta}][respuestaCorrecta]" value="2">
                </div>
            </div>
            <button type="button" class="btnEliminarPregunta">Eliminar Pregunta</button>
        `;

        contenedorPreguntas.appendChild(divPregunta);

        const btnEliminarPregunta = divPregunta.querySelector('.btnEliminarPregunta');
        btnEliminarPregunta.addEventListener('click', () => {
            contenedorPreguntas.removeChild(divPregunta);
        });
    });
});