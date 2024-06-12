<?php
    require_once 'db.php';

    class Preguntas {
        private $conexion;
        public $pregunta;
        public $respuesta;
        public $respuestaCorrecta;
    
        public function __construct($pregunta, $respuesta, $respuestaCorrecta) {
            $db = new Conexiondb();
            $this->conexion = $db->conexion;

            $this->pregunta = $pregunta;
            $this->respuesta = $respuesta;
            $this->respuestaCorrecta = $respuestaCorrecta;
        }
        
    }

?>
