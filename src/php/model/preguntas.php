<?php

    require_once 'db.php';

    class Preguntas {
        private $conexion;

        public function __construct() {
            $db = new Conexiondb();
            $this->conexion = $db->conexion;
        }

        public function insertarExamen($nombreExamen) {
            $consulta = $this->conexion->prepare("INSERT INTO examen(nombreExamen) VALUES (?)");
            $consulta->bind_param("s", $nombreExamen);
            $consulta->execute();
            $idExamen = $consulta->insert_id;
            $consulta->close();
            return $idExamen;
        }

        public function insertarPregunta($idExamen, $numPregunta, $pregunta) {
            $consulta = $this->conexion->prepare("INSERT INTO pregunta(idExamen, numPregunta, pregunta) VALUES (?, ?, ?)");
            $consulta->bind_param("iis", $idExamen, $numPregunta, $pregunta);
            $consulta->execute();
            $consulta->close();
        }

        public function insertarRespuesta($idExamen, $numPregunta, $numRespuesta, $respuesta, $esCorrecta) {
            $consulta = $this->conexion->prepare("INSERT INTO respuesta (idExamen, numPregunta, numRespuesta, respuesta, numRespCorrecta) VALUES (?, ?, ?, ?, ?)");
            $consulta->bind_param("iiisi", $idExamen, $numPregunta, $numRespuesta, $respuesta, $esCorrecta);
            $consulta->execute();
            $consulta->close();
        }
    }

?>