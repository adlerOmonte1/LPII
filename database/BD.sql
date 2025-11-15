CREATE DATABASE InstitutoIdiomas;
USE InstitutoIdiomas;

-- -------------------------------------------------------
-- TABLA USUARIO
-- -------------------------------------------------------
CREATE TABLE Usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(120) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    perfil VARCHAR(50) NOT NULL
);

-- -------------------------------------------------------
-- TABLA ADMINISTRADOR
-- -------------------------------------------------------
CREATE TABLE Administrador (
    idUsuario INT PRIMARY KEY,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

-- -------------------------------------------------------
-- TABLA DOCENTE
-- -------------------------------------------------------
CREATE TABLE Docente (
    codigoDocente INT AUTO_INCREMENT PRIMARY KEY,
    especialidad VARCHAR(100),
    idUsuario INT UNIQUE NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

-- -------------------------------------------------------
-- TABLA ESTUDIANTE
-- -------------------------------------------------------
CREATE TABLE Estudiante (
    codigoEstudiante INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT UNIQUE NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

-- -------------------------------------------------------
-- TABLA NIVEL
-- -------------------------------------------------------
CREATE TABLE Nivel (
    idNivel INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- -------------------------------------------------------
-- TABLA IDIOMA
-- -------------------------------------------------------
CREATE TABLE Idioma (
    idIdioma INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- -------------------------------------------------------
-- TABLA AULA
-- -------------------------------------------------------
CREATE TABLE Aula (
    idAula INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    capacidad INT NOT NULL
);

-- -------------------------------------------------------
-- TABLA CURSO
-- -------------------------------------------------------
CREATE TABLE Curso (
    idCurso INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    cupoMaximo INT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    idNivel INT NOT NULL,
    idIdioma INT NOT NULL,
    idAula INT NOT NULL,
    codigoDocente INT NOT NULL,
    FOREIGN KEY (idNivel) REFERENCES Nivel(idNivel),
    FOREIGN KEY (idIdioma) REFERENCES Idioma(idIdioma),
    FOREIGN KEY (idAula) REFERENCES Aula(idAula),
    FOREIGN KEY (codigoDocente) REFERENCES Docente(codigoDocente)
);

-- -------------------------------------------------------
-- TABLA HORARIO
-- -------------------------------------------------------
CREATE TABLE Horario (
    idHorario INT AUTO_INCREMENT PRIMARY KEY,
    diaSemana VARCHAR(20) NOT NULL,
    horaInicio TIME NOT NULL,
    horaFin TIME NOT NULL
);

-- -------------------------------------------------------
-- TABLA INTERMEDIA CURSO-HORARIO (N-M)
-- -------------------------------------------------------
CREATE TABLE CursoHorario (
    idCursoHorario INT AUTO_INCREMENT PRIMARY KEY,
    idCurso INT NOT NULL,
    idHorario INT NOT NULL,
    FOREIGN KEY (idCurso) REFERENCES Curso(idCurso),
    FOREIGN KEY (idHorario) REFERENCES Horario(idHorario)
);

-- -------------------------------------------------------
-- TABLA MATRÍCULA
-- -------------------------------------------------------
CREATE TABLE Matricula (
    idMatricula INT AUTO_INCREMENT PRIMARY KEY,
    fechaMatricula DATE NOT NULL,
    estado VARCHAR(20) NOT NULL,
    idCurso INT NOT NULL,
    codigoEstudiante INT NOT NULL,
    FOREIGN KEY (idCurso) REFERENCES Curso(idCurso),
    FOREIGN KEY (codigoEstudiante) REFERENCES Estudiante(codigoEstudiante)
);

-- -------------------------------------------------------
-- TABLA ASISTENCIA
-- -------------------------------------------------------
CREATE TABLE Asistencia (
    idAsistencia INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    estado VARCHAR(20) NOT NULL,
    idMatricula INT NOT NULL,
    FOREIGN KEY (idMatricula) REFERENCES Matricula(idMatricula)
);
