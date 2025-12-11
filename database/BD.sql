DROP DATABASE IF EXISTS InstitutoIdiomas;
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
-- (Si borras el Usuario, se borra el Admin)
-- -------------------------------------------------------
CREATE TABLE Administrador (
    idUsuario INT PRIMARY KEY,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE CASCADE
);

-- -------------------------------------------------------
-- TABLA DOCENTE
-- (Si borras el Usuario, se borra el Docente)
-- -------------------------------------------------------
CREATE TABLE Docente (
    codigoDocente INT AUTO_INCREMENT PRIMARY KEY,
    especialidad VARCHAR(100),
    idUsuario INT UNIQUE NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE CASCADE
);

-- -------------------------------------------------------
-- TABLA ESTUDIANTE
-- (Si borras el Usuario, se borra el Estudiante)
-- -------------------------------------------------------
CREATE TABLE Estudiante (
    codigoEstudiante INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT UNIQUE NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE CASCADE
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
-- (Si borras Nivel, Idioma, Aula o Docente -> Se borra el Curso)
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
    FOREIGN KEY (idNivel) REFERENCES Nivel(idNivel) ON DELETE CASCADE,
    FOREIGN KEY (idIdioma) REFERENCES Idioma(idIdioma) ON DELETE CASCADE,
    FOREIGN KEY (idAula) REFERENCES Aula(idAula) ON DELETE CASCADE,
    FOREIGN KEY (codigoDocente) REFERENCES Docente(codigoDocente) ON DELETE CASCADE
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
-- TABLA INTERMEDIA CURSO-HORARIO
-- (Si borras Curso o el bloque de Horario -> Se borra la relación)
-- -------------------------------------------------------
CREATE TABLE CursoHorario (
    idCursoHorario INT AUTO_INCREMENT PRIMARY KEY,
    idCurso INT NOT NULL,
    idHorario INT NOT NULL,
    FOREIGN KEY (idCurso) REFERENCES Curso(idCurso) ON DELETE CASCADE,
    FOREIGN KEY (idHorario) REFERENCES Horario(idHorario) ON DELETE CASCADE
);

-- -------------------------------------------------------
-- TABLA MATRÍCULA
-- (Si borras Curso o Estudiante -> Se borra la Matrícula)
-- -------------------------------------------------------
CREATE TABLE Matricula (
    idMatricula INT AUTO_INCREMENT PRIMARY KEY,
    fechaMatricula DATE NOT NULL,
    estado VARCHAR(20) NOT NULL,
    idCurso INT NOT NULL,
    codigoEstudiante INT NOT NULL,
    FOREIGN KEY (idCurso) REFERENCES Curso(idCurso) ON DELETE CASCADE,
    FOREIGN KEY (codigoEstudiante) REFERENCES Estudiante(codigoEstudiante) ON DELETE CASCADE
);

-- -------------------------------------------------------
-- TABLA ASISTENCIA
-- (Si borras Matrícula -> Se borra Asistencia)
-- -------------------------------------------------------
CREATE TABLE Asistencia (
    idAsistencia INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    estado VARCHAR(20) NOT NULL,
    idMatricula INT NOT NULL,
    FOREIGN KEY (idMatricula) REFERENCES Matricula(idMatricula) ON DELETE CASCADE
);
