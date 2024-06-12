<?php
    // require_once '/home/proyectosevg/public_html/2daw00/reconocimientos_v2/src/config/path.php';
    // require_once PATH_MODELOS.'isesion.php';
    require_once 'src/php/model/preguntas.php'

    class Controladorcpreguntas {

        public $view;
        private $preguntas;

        public function __construct() {
            $this->preguntas = new Preguntas();
        }

        public function irindice() {
            $this->view = "indice";
        }

        public function irnuevoexamen() {
            $this->view = "formexaminator";
        }
    }

?>