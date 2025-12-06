-- =====================================================
-- INSERTAR DATOS INICIALES
-- =====================================================
INSERT INTO Usuario (nombres, apellidos, email, contraseña, perfil) VALUES
('Carlos', 'Lopez Ruiz', 'carlos.admin@idiomas.com', '123456', 'administrador'),
('María', 'Pérez Soto', 'maria.docente@idiomas.com', '123456', 'docente'),
('Luis', 'Gómez Rojas', 'luis.docente@idiomas.com', '123456', 'docente'),
('Ana', 'Torres Silva', 'ana.estudiante@idiomas.com', '123456', 'estudiante'),
('Pedro', 'Ramírez Cruz', 'pedro.estudiante@idiomas.com', '123456', 'estudiante'),
('Lucía', 'Vargas León', 'lucia.estudiante@idiomas.com', '123456', 'estudiante');

INSERT INTO Administrador (idUsuario) VALUES (1);

INSERT INTO Docente (especialidad, idUsuario) VALUES
('Inglés Avanzado', 2),
('Francés Intermedio', 3);

INSERT INTO Estudiante (idUsuario) VALUES
(4),(5),(6);

INSERT INTO Nivel (nombre) VALUES
('Básico'), ('Intermedio'), ('Avanzado');

INSERT INTO Idioma (nombre) VALUES
('Inglés'), ('Francés'), ('Alemán');

INSERT INTO Aula (nombre, capacidad) VALUES
('Aula 101', 30),
('Aula 102', 25),
('Aula 201', 40);

INSERT INTO Curso (nombre, cupoMaximo, fechaInicio, fechaFin, idNivel, idIdioma, idAula, codigoDocente) VALUES
('Inglés Básico A', 25, '2025-01-10', '2025-04-10', 1, 1, 1, 1),
('Francés Intermedio B', 20, '2025-02-01', '2025-05-01', 2, 2, 2, 2),
('Inglés Avanzado C', 30, '2025-03-15', '2025-06-15', 3, 1, 3, 1);

INSERT INTO Horario (diaSemana, horaInicio, horaFin) VALUES
('Lunes', '08:00', '10:00'),
('Miércoles', '08:00', '10:00'),
('Viernes', '08:00', '10:00'),
('Martes', '10:00', '12:00'),
('Jueves', '10:00', '12:00');

INSERT INTO CursoHorario (idCurso, idHorario) VALUES
(1,1),(1,2),(1,3),
(2,4),(2,5),
(3,1),(3,3);

INSERT INTO Matricula (fechaMatricula, estado, idCurso, codigoEstudiante) VALUES
('2025-01-12','activo',1,1),
('2025-01-12','activo',1,2),
('2025-02-03','activo',2,3),
('2025-03-20','activo',3,1);

INSERT INTO Asistencia (fecha, estado, idMatricula) VALUES
('2025-01-15','asistió',1),
('2025-01-15','faltó',2),
('2025-02-05','asistió',3),
('2025-03-22','asistió',4);


-- NUEVOS USUARIOS
INSERT INTO Usuario (nombres, apellidos, email, contraseña, perfil) VALUES
('Jorge', 'Luna Herrera', 'jorge.docente@idiomas.com', '123456', 'docente'),
('Sofía', 'Meza Castro', 'sofia.docente@idiomas.com', '123456', 'docente'),
('Rodrigo', 'Matos Díaz', 'rodrigo.estudiante@idiomas.com', '123456', 'estudiante'),
('Carolina', 'Espinoza Valdez', 'carolina.estudiante@idiomas.com', '123456', 'estudiante'),
('Miguel', 'Cáceres Huamán', 'miguel.estudiante@idiomas.com', '123456', 'estudiante'),
('Valeria', 'Quispe Ramos', 'valeria.estudiante@idiomas.com', '123456', 'estudiante'),
('Daniel', 'Ortega Ruiz', 'daniel.estudiante@idiomas.com', '123456', 'estudiante'),
('Juliana', 'Córdova Meléndez', 'juliana.estudiante@idiomas.com', '123456', 'estudiante'),
('Patricia', 'Sánchez León', 'patricia.admin@idiomas.com', '123456', 'administrador');

-- NUEVOS DOCENTES
INSERT INTO Docente (especialidad, idUsuario) VALUES
('Alemán Básico', 7),
('Inglés Conversacional', 8);

-- NUEVOS ESTUDIANTES
INSERT INTO Estudiante (idUsuario) VALUES
(9),(10),(11),(12),(13),(14),(15);

-- NUEVAS AULAS
INSERT INTO Aula (nombre, capacidad) VALUES
('Aula 202', 35),
('Aula 203', 32),
('Aula Virtual 1', 100),
('Laboratorio Idiomas 1', 28);

-- NUEVOS CURSOS
INSERT INTO Curso (nombre, cupoMaximo, fechaInicio, fechaFin, idNivel, idIdioma, idAula, codigoDocente) VALUES
('Alemán Básico A', 20, '2025-04-01', '2025-07-01', 1, 3, 4, 3),
('Inglés Intermedio A', 28, '2025-04-05', '2025-07-05', 2, 1, 5, 1),
('Francés Básico A', 22, '2025-05-01', '2025-08-01', 1, 2, 6, 2),
('Inglés Conversacional A', 25, '2025-05-10', '2025-08-10', 3, 1, 7, 4),
('Alemán Intermedio A', 18, '2025-06-01', '2025-09-01', 2, 3, 8, 3),
('Francés Avanzado A', 15, '2025-06-15', '2025-09-15', 3, 2, 9, 2);

-- NUEVOS HORARIOS
INSERT INTO Horario (diaSemana, horaInicio, horaFin) VALUES
('Lunes','14:00','16:00'),
('Miércoles','14:00','16:00'),
('Viernes','14:00','16:00'),
('Martes','16:00','18:00'),
('Jueves','16:00','18:00'),
('Sábado','09:00','12:00'),
('Sábado','14:00','17:00');

-- NUEVAS RELACIONES CURSO-HORARIO
INSERT INTO CursoHorario (idCurso, idHorario) VALUES
(4,6),(4,7),
(5,1),(5,4),
(6,8),(6,9),
(7,10),(7,11),
(8,12),(8,13),
(9,14),(9,15);

-- NUEVAS MATRÍCULAS
INSERT INTO Matricula (fechaMatricula, estado, idCurso, codigoEstudiante) VALUES
('2025-04-03','activo',4,3),
('2025-04-03','activo',4,4),
('2025-04-06','activo',5,5),
('2025-04-06','activo',5,6),
('2025-05-02','activo',6,7),
('2025-05-11','activo',7,8),
('2025-06-02','activo',8,9),
('2025-06-16','activo',9,10),
('2025-06-16','activo',9,11),
('2025-04-10','activo',5,12),
('2025-04-15','activo',5,13),
('2025-05-20','activo',6,14),
('2025-05-21','activo',6,15);

-- NUEVAS ASISTENCIAS
INSERT INTO Asistencia (fecha, estado, idMatricula) VALUES
('2025-04-05','asistió',5),
('2025-04-07','faltó',5),
('2025-04-12','asistió',6),
('2025-04-12','asistió',7),
('2025-04-19','faltó',7),
('2025-05-03','asistió',8),
('2025-05-10','asistió',9),
('2025-05-17','asistió',9),
('2025-06-03','faltó',10),
('2025-06-10','asistió',10),
('2025-06-17','asistió',11),
('2025-06-24','faltó',11),
('2025-07-04','asistió',12),
('2025-07-11','asistió',13),
('2025-07-18','faltó',13);
