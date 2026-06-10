-- ============================================================
-- ESQUEMA PostgreSQL (Supabase) - Instituto de Idiomas
-- ------------------------------------------------------------
-- Versión PostgreSQL de database/BD.sql (originalmente MySQL).
-- En Supabase ya existe la base de datos, por lo que aquí no se
-- crea ni se selecciona ninguna BD: solo se definen las tablas.
--
-- Ejecútalo en: Supabase -> SQL Editor -> New query -> Run.
-- Es re-ejecutable (DROP ... CASCADE al inicio).
-- ============================================================

DROP TABLE IF EXISTS Asistencia    CASCADE;
DROP TABLE IF EXISTS Matricula      CASCADE;
DROP TABLE IF EXISTS CursoHorario   CASCADE;
DROP TABLE IF EXISTS Horario        CASCADE;
DROP TABLE IF EXISTS Curso          CASCADE;
DROP TABLE IF EXISTS Aula           CASCADE;
DROP TABLE IF EXISTS Idioma         CASCADE;
DROP TABLE IF EXISTS Nivel          CASCADE;
DROP TABLE IF EXISTS Estudiante     CASCADE;
DROP TABLE IF EXISTS Docente        CASCADE;
DROP TABLE IF EXISTS Administrador  CASCADE;
DROP TABLE IF EXISTS Usuario        CASCADE;

-- ------------------------------------------------------------
-- USUARIO
-- ------------------------------------------------------------
CREATE TABLE Usuario (
    idUsuario   SERIAL PRIMARY KEY,
    nombres     VARCHAR(100) NOT NULL,
    apellidos   VARCHAR(100) NOT NULL,
    email       VARCHAR(120) UNIQUE NOT NULL,
    contraseña  VARCHAR(255) NOT NULL,
    perfil      VARCHAR(50)  NOT NULL
);

-- ------------------------------------------------------------
-- ADMINISTRADOR
-- ------------------------------------------------------------
CREATE TABLE Administrador (
    idUsuario INT PRIMARY KEY,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- DOCENTE
-- ------------------------------------------------------------
CREATE TABLE Docente (
    codigoDocente SERIAL PRIMARY KEY,
    especialidad  VARCHAR(100),
    idUsuario     INT UNIQUE NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- ESTUDIANTE
-- ------------------------------------------------------------
CREATE TABLE Estudiante (
    codigoEstudiante SERIAL PRIMARY KEY,
    idUsuario        INT UNIQUE NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- NIVEL
-- ------------------------------------------------------------
CREATE TABLE Nivel (
    idNivel SERIAL PRIMARY KEY,
    nombre  VARCHAR(100) NOT NULL
);

-- ------------------------------------------------------------
-- IDIOMA
-- ------------------------------------------------------------
CREATE TABLE Idioma (
    idIdioma SERIAL PRIMARY KEY,
    nombre   VARCHAR(100) NOT NULL
);

-- ------------------------------------------------------------
-- AULA
-- ------------------------------------------------------------
CREATE TABLE Aula (
    idAula     SERIAL PRIMARY KEY,
    nombre     VARCHAR(100) NOT NULL,
    capacidad  INT NOT NULL
);

-- ------------------------------------------------------------
-- CURSO
-- ------------------------------------------------------------
CREATE TABLE Curso (
    idCurso       SERIAL PRIMARY KEY,
    nombre        VARCHAR(120) NOT NULL,
    cupoMaximo    INT NOT NULL,
    fechaInicio   DATE NOT NULL,
    fechaFin      DATE NOT NULL,
    idNivel       INT NOT NULL,
    idIdioma      INT NOT NULL,
    idAula        INT NOT NULL,
    codigoDocente INT NOT NULL,
    FOREIGN KEY (idNivel)       REFERENCES Nivel(idNivel)        ON DELETE CASCADE,
    FOREIGN KEY (idIdioma)      REFERENCES Idioma(idIdioma)      ON DELETE CASCADE,
    FOREIGN KEY (idAula)        REFERENCES Aula(idAula)          ON DELETE CASCADE,
    FOREIGN KEY (codigoDocente) REFERENCES Docente(codigoDocente) ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- HORARIO
-- ------------------------------------------------------------
CREATE TABLE Horario (
    idHorario  SERIAL PRIMARY KEY,
    diaSemana  VARCHAR(20) NOT NULL,
    horaInicio TIME NOT NULL,
    horaFin    TIME NOT NULL
);

-- ------------------------------------------------------------
-- CURSO-HORARIO (intermedia)
-- ------------------------------------------------------------
CREATE TABLE CursoHorario (
    idCursoHorario SERIAL PRIMARY KEY,
    idCurso        INT NOT NULL,
    idHorario      INT NOT NULL,
    FOREIGN KEY (idCurso)   REFERENCES Curso(idCurso)     ON DELETE CASCADE,
    FOREIGN KEY (idHorario) REFERENCES Horario(idHorario) ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- MATRICULA
-- ------------------------------------------------------------
CREATE TABLE Matricula (
    idMatricula      SERIAL PRIMARY KEY,
    fechaMatricula   DATE NOT NULL,
    estado           VARCHAR(20) NOT NULL,
    idCurso          INT NOT NULL,
    codigoEstudiante INT NOT NULL,
    FOREIGN KEY (idCurso)          REFERENCES Curso(idCurso)               ON DELETE CASCADE,
    FOREIGN KEY (codigoEstudiante) REFERENCES Estudiante(codigoEstudiante) ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- ASISTENCIA
-- ------------------------------------------------------------
CREATE TABLE Asistencia (
    idAsistencia SERIAL PRIMARY KEY,
    fecha        DATE NOT NULL,
    estado       VARCHAR(20) NOT NULL,
    idMatricula  INT NOT NULL,
    FOREIGN KEY (idMatricula) REFERENCES Matricula(idMatricula) ON DELETE CASCADE
);
