<?php

    require_once 'db.php';

    class Reconocimientos {
        private $conexion;

        public function __construct() {
            //Creamos un objeto e inicializamos la conexión a la base de datos
            $db = new Conexiondb();
            $this->conexion = $db->conexion;
        }


        /*
         *  Devuelve el listado de reconocimientos del alumno que lo solicite.
         **/
        public function listarReconocimientos($idAlumno) {
            $SQL = "SELECT idReconocimiento FROM reconocimiento WHERE idAlumRecibe = ?";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("i", $idAlumno);
            $consulta->execute();
            $resultado = $consulta->get_result();
    
            $reconocimientos = [];
            while ($reconocimiento = $resultado->fetch_assoc()) {
                $reconocimientos[] = $reconocimiento['idReconocimiento'];
            }
    
            $consulta->close();
            return $reconocimientos;
        }

        /*
         *  Devuelve el reconocimiento solicitado.
         **/
        public function mostrarReconocimiento($idReconocimiento) {
            $SQL = "SELECT momento, descripcion FROM reconocimiento WHERE idReconocimiento = ?";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("i", $idReconocimiento);
            $consulta->execute();
            $resultado = $consulta->get_result();
            
            $reconocimiento = null;
            if ($resultado->num_rows > 0) {
                $reconocimiento = $resultado->fetch_assoc();
            }
        
            $consulta->close();
            return $reconocimiento;
        }
    
        /*
         *  Hace la inserción del nuevo reconocimiento.
         **/
        public function hacerReconocimiento($momento, $descripcion, $idAlumnoRecibe, $idAlumnoEnvia) {
            $SQL = "INSERT INTO reconocimiento (momento, descripcion, idAlumRecibe, idAlumEnvia) VALUES (?, ?, ?, ?)";

            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("ssii", $momento, $descripcion, $idAlumnoRecibe, $idAlumnoEnvia);
            $consulta->execute();
            $consulta->close();
        }

        /*
         *  Devuelve el listado del los alumnos a los que se le puede hacer un reconocimiento.
         **/
        public function listarAlumnos() {
            $SQL = "SELECT idAlumno, nombre FROM alumno";
            $resultado = $this->conexion->query($SQL);

            $alumnos = [];
            while ($alumno = $resultado->fetch_assoc()) {
                $alumnos[] = $alumno;
            }
            return $alumnos;
        }

        /*
         *  Devuelve el nombre del último alumno al que se le ha hecho un reconocimiento.
         **/
        public function nombreCompi($idAlumnoRecibe) {
            $SQL = "SELECT nombre FROM alumno WHERE idAlumno = ?";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param("i", $idAlumnoRecibe);
            $consulta->execute();
            $nombre = null;
            $consulta->bind_result($nombre);
            $consulta->fetch();
            $consulta->close();
            return $nombre;
        }
    }

?>