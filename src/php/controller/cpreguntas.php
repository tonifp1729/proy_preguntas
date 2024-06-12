<?php

    require_once 'src/php/model/preguntas.php';
    require_once 'C:\xampp\htdocs\proy_preguntas\fpdf\fpdf.php';

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

        public function irsubirbajar() {
            //No solo se encarga del direccionamiento sino que carga el listado exámenes
            $examenes = $this->preguntas->listarExamenes();
            $this->view = "contenidos";

            return ['examenes' => $examenes];
        }

        public function bajarpdf() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selexam'])) {
                $idExamen = $_POST['selexam'];
        
                //Obtenemos los datos del examen desde la base de datos
                $examen = $this->preguntas->cogerExamen($idExamen);
                $preguntas = $this->preguntas->cogerPreguntas($idExamen);
        
                //Creamos el PDF
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 16);
        
                //Añadimos el nombre del examen que usaremos como título
                $pdf->Cell(0, 10, utf8_decode($examen['nombreExamen']), 0, 1, 'C');
        
                //Añadimos las preguntas y respuestas al PDF
                $pdf->SetFont('Arial', '', 12);
                foreach ($preguntas as $pregunta) {
                    $pdf->Ln(10);
                    $pdf->MultiCell(0, 10, utf8_decode($pregunta['pregunta']));
        
                    //Ajustamos la posición horizontal de las respuestas (tabulamos)
                    $tabWidth = 10;  // Define el ancho de la tabulación
                    foreach ($pregunta['respuestas'] as $respuesta) {
                        $pdf->Ln(5);
                        $pdf->SetX($pdf->GetX() + $tabWidth);  // Ajustar la posición horizontal
                        $pdf->MultiCell(0, 10, utf8_decode('- ' . $respuesta['respuesta']));
                    }
                }
        
                //Salida del PDF
                $pdf->Output('D', 'examen.pdf');
                exit;
            }
        }
        //guardararchivador
        public function guardarArchivos() {
            $error = null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Verificamos que el archivo recibido sea PDF
                if (isset($_FILES['archivoPDF']) && $_FILES['archivoPDF']['error'] === UPLOAD_ERR_OK) {
                    $tipoArchivo = $_FILES['archivoPDF']['type'];
                    if ($tipoArchivo === 'application/pdf') {
                        //Si el archivo es un PDF realizamos los procesos de guardado
                        $nombreArchivoOriginal = $_FILES['archivoPDF']['name'];
                        $rutaTemporalArchivo = $_FILES['archivoPDF']['tmp_name'];
        
                        //Creamos un nombre único para el archivo
                        $nombreArchivoUnico = uniqid('pdf_', true) . '.pdf';
                        $rutaDestino = 'pdfs/' . $nombreArchivoUnico; 
        
                        //Movemos el archivo a la ubicación deseada
                        if (move_uploaded_file($rutaTemporalArchivo, $rutaDestino)) {
                            //Guardamos la información del archivo en la base de datos
                            $preguntas = new Preguntas();
                            $preguntas->guardarArchivador($nombreArchivoOriginal, $nombreArchivoUnico, $rutaDestino);
                            $this->irexito();
                        } else {
                            $error = 'fallo_proceso';
                            $this->view = 'subfallida';
                        }
                    } else {
                        $error = 'tipo_archivo';
                        $this->view = 'subfallida';
                    }
                } else {
                    $error = 'no_seleccionado';
                    $this->view = 'subfallida';
                }
            }
            
            return ['error' => $error];
        }        

        public function irexito() {
            $this->view = "subexitosa";
        }

        public function irindice() {
            $this->view = "indice";
        }

        public function irnuevoexamen() {
            $this->view = "formexaminator";
        }
    }
?>