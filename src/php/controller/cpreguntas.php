<?php
require_once 'src/php/model/preguntas.php';

class Controladorcpreguntas {

    public $view;
    private $preguntas;

    public function __construct() {
        $this->preguntas = new Preguntas();
    }

    public function nuevoexamen() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Recogemos el nombre del examen y las preguntas
            $nombreExamen = $_POST['nombreExamen'];
            $preguntas = $_POST['preguntas'];

            if ($nombreExamen && !empty($preguntas)) {
                //Insertamos el examen
                $idExamen = $this->preguntas->insertarExamen($nombreExamen);
                if ($idExamen) {
                    foreach ($preguntas as $index => $preguntaData) {
                        $pregunta = $preguntaData['pregunta'];
                        $respuestas = $preguntaData['respuestas'];
                        $respuestaCorrecta = $preguntaData['respuestaCorrecta'];

                        //Insertamos cada pregunta
                        $numPregunta = $index + 1;
                        $this->preguntas->insertarPregunta($idExamen, $numPregunta, $pregunta);

                        //Insertamos las respuestas para cada pregunta
                        foreach ($respuestas as $numRespuesta => $respuesta) {
                            $esCorrecta = ($respuestaCorrecta == $numRespuesta) ? 1 : 0;
                            $this->preguntas->insertarRespuesta($idExamen, $numPregunta, $numRespuesta + 1, $respuesta, $esCorrecta);
                        }
                    }
                    $this->view = "subexitosa";
                } else {
                    $error = 'error_insertar_examen';
                    $this->irnuevoexamen();
                }
            } else {
                $error = 'faltan_datos';
                $this->irnuevoexamen();
            }
        } else {
            $this->irnuevoexamen();
        }

        return ['error' => $error];
    }

    public function irindice() {
        $this->view = "indice";
    }

    public function irnuevoexamen() {
        $this->view = "formexaminator";
    }
}
?>