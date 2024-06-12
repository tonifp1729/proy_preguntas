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
    numRespCorrecta tinyint NOT NULL,
    FOREIGN KEY (idExamen, numPregunta) REFERENCES pregunta(idExamen, numPregunta) ON DELETE CASCADE,
    PRIMARY KEY (idExamen, numPregunta, numRespuesta)
);