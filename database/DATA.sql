USE InstitutoIdiomas;

-- =======================================
-- INSERTAR USUARIOS
-- =======================================
INSERT INTO Usuario (nombres, apellidos, email, contraseña, perfil) VALUES
('Carlos', 'Lopez Ruiz', 'carlos.admin@idiomas.com', '123456', 'administrador'),
('María', 'Pérez Soto', 'maria.docente@idiomas.com', '123456', 'docente'),
('Luis', 'Gómez Rojas', 'luis.docente@idiomas.com', '123456', 'docente'),
('Ana', 'Torres Silva', 'ana.estudiante@idiomas.com', '123456', 'estudiante'),
('Pedro', 'Ramírez Cruz', 'pedro.estudiante@idiomas.com', '123456', 'estudiante'),
('Lucía', 'Vargas León', 'lucia.estudiante@idiomas.com', '123456', 'estudiante');

-- =======================================
-- ADMINISTRADOR
-- =======================================
INSERT INTO Administrador (idUsuario) VALUES
(1);

-- =======================================
-- DOCENTES
-- =======================================
INSERT INTO Docente (especialidad, idUsuario) VALUES
('Inglés Avanzado', 2),
('Francés Intermedio', 3);

-- =======================================
-- ESTUDIANTES
-- =======================================
INSERT INTO Estudiante (idUsuario) VALUES
(4),
(5),
(6);

-- =======================================
-- NIVELES
-- =======================================
INSERT INTO Nivel (nombre) VALUES
('Básico'),
('Intermedio'),
('Avanzado');

-- =======================================
-- IDIOMAS
-- =======================================
INSERT INTO Idioma (nombre) VALUES
('Inglés'),
('Francés'),
('Alemán');

-- =======================================
-- AULAS
-- =======================================
INSERT INTO Aula (nombre, capacidad) VALUES
('Aula 101', 30),
('Aula 102', 25),
('Aula 201', 40);

-- =======================================
-- CURSOS
-- =======================================
INSERT INTO Curso (nombre, cupoMaximo, fechaInicio, fechaFin, idNivel, idIdioma, idAula, codigoDocente) VALUES
('Inglés Básico A', 25, '2025-01-10', '2025-04-10', 1, 1, 1, 1),
('Francés Intermedio B', 20, '2025-02-01', '2025-05-01', 2, 2, 2, 2),
('Inglés Avanzado C', 30, '2025-03-15', '2025-06-15', 3, 1, 3, 1);

-- =======================================
-- HORARIO
-- =======================================
INSERT INTO Horario (diaSemana, horaInicio, horaFin) VALUES
('Lunes', '08:00', '10:00'),
('Miércoles', '08:00', '10:00'),
('Viernes', '08:00', '10:00'),
('Martes', '10:00', '12:00'),
('Jueves', '10:00', '12:00');

-- =======================================
-- CURSO - HORARIO (N:M)
-- =======================================
INSERT INTO CursoHorario (idCurso, idHorario) VALUES
(1, 1), (1, 2), (1, 3),    -- Inglés Básico
(2, 4), (2, 5),            -- Francés Intermedio
(3, 1), (3, 3);            -- Inglés Avanzado

-- =======================================
-- MATRÍCULAS
-- =======================================
INSERT INTO Matricula (fechaMatricula, estado, idCurso, codigoEstudiante) VALUES
('2025-01-12', 'activo', 1, 1),
('2025-01-12', 'activo', 1, 2),
('2025-02-03', 'activo', 2, 3),
('2025-03-20', 'activo', 3, 1);

-- =======================================
-- ASISTENCIAS
-- =======================================
INSERT INTO Asistencia (fecha, estado, idMatricula) VALUES
('2025-01-15', 'asistió', 1),
('2025-01-15', 'faltó', 2),
('2025-02-05', 'asistió', 3),
('2025-03-22', 'asistió', 4);
