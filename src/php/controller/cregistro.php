<?php

    require_once '/home/proyectosevg/public_html/2daw00/reconocimientos_v2/src/config/path.php';
    require_once PATH_MODELOS.'nuevoalumno.php';

    class Controladorcregistro {
        public $view;
        private $registrar;

        public function __construct() {
            $this->registrar = new NuevoAlumno();
        }

        public function registro() {
            $error = null;

            if (!empty($_POST['correo']) && !empty($_POST['contrasena']) && !empty($_POST['confirmarContrasena']) && !empty($_POST['nombre'])) {
                $correo = $_POST['correo'];
                $contrasena = $_POST['contrasena'];
                $confirmacion = $_POST['confirmarContrasena'];
                $nombre = $_POST['nombre'];
                $tipo = $_POST['tipo'];
                
                if (!empty($_POST['web'])) {
                    $web = $_POST['web'];
                } else {
                    $web = null;
                }
                
                
                if ($contrasena != $confirmacion) {
                    $this->irregistro();
                    $error = 'contrasena_incorrecta';
                } else if (!$this->validarCorreo($correo)) {
                    $this->irregistro();
                    $error = 'correo_invalido';
                } else {
                    $this->registrar->insertarAlumno($nombre, $correo, $contrasena, $web, $tipo);
                    $this->view = "forminiciosesion";
                }
            } else {
                $this->irregistro();
                $error = 'faltan_credenciales';
            }

            return ['error' => $error];
        }

        private function validarCorreo($correo) {
            //Expresión regular para asegurar que el correo recibido pertenece a este dominio: "@alumnado.fundacionloyola.net"
            $regex = '/^[a-zA-Z0-9._%+-]+@alumnado\.fundacionloyola\.net$/';
    
            //Comprueba que el correo cumpla con lo establecido en $regex
            return preg_match($regex, $correo) === 1;
        }

        public function irregistro() {
            $this->view = "registro";
            $tipos = $this->registrar->listarTipos();

            return ['tipos' => $tipos];
        }

    }
?>