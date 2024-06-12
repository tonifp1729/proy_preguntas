<?php

    require_once 'db.php';

    class Preguntas {
        private $conexion;

        public function __construct() {
            $db = new Conexiondb();
            $this->conexion = $db->conexion;
        }

        public function insertarExamen($nombreExamen) {
            $SQL = "INSERT INTO examen(nombreExamen) VALUES (?)";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("s", $nombreExamen);
            $consulta->execute();
            $idExamen = $consulta->insert_id;
            $consulta->close();
            return $idExamen;
        }

        public function insertarPregunta($idExamen, $numPregunta, $pregunta) {
            $SQL = "INSERT INTO pregunta(idExamen, numPregunta, pregunta) VALUES (?, ?, ?)";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("iis", $idExamen, $numPregunta, $pregunta);
            $consulta->execute();
            $consulta->close();
        }

        public function insertarRespuesta($idExamen, $numPregunta, $numRespuesta, $respuesta, $esCorrecta) {
            $SQL = "INSERT INTO respuesta (idExamen, numPregunta, numRespuesta, respuesta, numRespCorrecta) VALUES (?, ?, ?, ?, ?)";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("iiisi", $idExamen, $numPregunta, $numRespuesta, $respuesta, $esCorrecta);
            $consulta->execute();
            $consulta->close();
        }

        public function listarExamenes() {
            $SQL = "SELECT idExamen, nombreExamen FROM examen";
            $resultado = $this->conexion->query($SQL);
    
            $examenes = [];
            while ($examen = $resultado->fetch_assoc()) {
                $examenes[] = $examen;
            }
            return $examenes;
        }

        public function cogerExamen($idExamen) {
            $SQL = "SELECT idExamen, nombreExamen FROM examen WHERE idExamen = ?";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("i", $idExamen);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $examen = $resultado->fetch_assoc();
            $consulta->close();
            return $examen;
        }
    
        public function cogerPreguntas($idExamen) {
            $SQL = "SELECT idExamen, numPregunta, pregunta FROM pregunta WHERE idExamen = ?";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("i", $idExamen);
            $consulta->execute();
            $resultado = $consulta->get_result();
    
            $preguntas = [];
            while ($pregunta = $resultado->fetch_assoc()) {
                $pregunta['respuestas'] = $this->cogerRespuestas($idExamen, $pregunta['numPregunta']);
                $preguntas[] = $pregunta;
            }
            $consulta->close();
            return $preguntas;
        }
    
        private function cogerRespuestas($idExamen, $numPregunta) {
            $SQL = "SELECT idExamen, numPregunta, numRespuesta, respuesta, numRespCorrecta FROM respuesta WHERE idExamen = ? AND numPregunta = ?";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("ii", $idExamen, $numPregunta);
            $consulta->execute();
            $resultado = $consulta->get_result();
    
            $respuestas = [];
            while ($respuesta = $resultado->fetch_assoc()) {
                $respuestas[] = $respuesta;
            }
            $consulta->close();
            return $respuestas;
        }

        public function guardarArchivador($nombreOriginal, $nombreGuardado, $rutaArchivo) {
            $SQL = "INSERT INTO archivador (nombreOriginal, nombreGuardado, rutaArchivo) VALUES (?, ?, ?)";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("sss", $nombreOriginal, $nombreGuardado, $rutaArchivo);
            $consulta->execute();
            $consulta->close();
        }

    }

?>