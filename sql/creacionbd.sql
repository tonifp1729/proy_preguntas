-- ESTAS SON LAS CONSULTAS DE CREACIÓN DE TABLAS DE LA BASE DE DATOS

-- TABLA EXAMEN
CREATE TABLE examen (
    idExamen int AUTO_INCREMENT PRIMARY KEY,
    nombreExamen varchar(60) NOT NULL
);

-- TABLA PREGUNTA
CREATE TABLE pregunta (
    idExamen int NOT NULL,
    numPregunta int NOT NULL,
    pregunta varchar(1000) NOT NULL,
    FOREIGN KEY (idExamen) REFERENCES examen(idExamen) ON DELETE CASCADE,
    PRIMARY KEY (idExamen, numPregunta)
);

-- TABLA RESPUESTA
CREATE TABLE respuesta (
    idExamen int NOT NULL,
    numPregunta int NOT NULL,
    numRespuesta int NOT NULL,
    respuesta varchar(300) NOT NULL,
    respCorrecta tinyint NOT NULL,
    FOREIGN KEY (idExamen, numPregunta) REFERENCES pregunta(idExamen, numPregunta) ON DELETE CASCADE,
    PRIMARY KEY (idExamen, numPregunta, numRespuesta)
);

-- TABLA ARCHIVADOR
CREATE TABLE archivador (
    idArchivo int AUTO_INCREMENT PRIMARY KEY,
    nombreOriginal varchar(255) NOT NULL,
    nombreGuardado varchar(255) NOT NULL,
    rutaArchivo varchar(255) NOT NULL,
    fechaSubida timestamp DEFAULT CURRENT_TIMESTAMP
);