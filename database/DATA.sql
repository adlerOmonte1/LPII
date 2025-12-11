-- ============================================
-- HASH GLOBAL PARA TODAS LAS CONTRASEÑAS
-- Contraseña real para login: 123456
-- ============================================
SET @hash = '$2y$10$9gbkOwEfzoWD9Xz3vNgki.097FXYxwUpsY6TFVuisOm/mtkERhW9e';

-- ============================================
-- USUARIOS (15 registros)
-- ============================================
INSERT INTO Usuario (nombres, apellidos, email, contraseña, perfil) VALUES
('Carlos', 'López Ruiz', 'carlos.admin@idiomas.com', @hash, 'administrador'),
('María', 'García Ramos', 'maria.docente@idiomas.com', @hash, 'docente'),
('José', 'Torres Silva', 'jose.docente@idiomas.com', @hash, 'docente'),
('Lucía', 'Vargas Pérez', 'lucia.docente@idiomas.com', @hash, 'docente'),
('Pedro', 'Cruz Medina', 'pedro.docente@idiomas.com', @hash, 'docente'),
('Ana', 'Salazar León', 'ana.estudiante@idiomas.com', @hash, 'estudiante'),
('Luis', 'Rojas Puma', 'luis.estudiante@idiomas.com', @hash, 'estudiante'),
('Jeferson', 'Palacios Presentación', 'jeferson.est@idiomas.com', @hash, 'estudiante'),
('Raúl', 'Caldas Ramos', 'raul.est@idiomas.com', @hash, 'estudiante'),
('Jean', 'López Gómez', 'jean.est@idiomas.com', @hash, 'estudiante'),
('Diana', 'Soto Fernández', 'diana.est@idiomas.com', @hash, 'estudiante'),
('Rosa', 'Mendoza Lazo', 'rosa.est@idiomas.com', @hash, 'estudiante'),
('Miguel', 'Huamán Alania', 'miguel.est@idiomas.com', @hash, 'estudiante'),
('Sofía', 'Pinedo Torres', 'sofia.est@idiomas.com', @hash, 'estudiante'),
('Kevin', 'Ramírez Loro', 'kevin.est@idiomas.com', @hash, 'estudiante');

-- ============================================
-- ADMINISTRADOR
-- ============================================
INSERT INTO Administrador (idUsuario) VALUES (1);

-- ============================================
-- DOCENTE (usuarios 2–5)
-- ============================================
INSERT INTO Docente (especialidad, idUsuario) VALUES
('Inglés Avanzado', 2),
('Portugués', 3),
('Francés', 4),
('Italiano', 5);

-- ============================================
-- ESTUDIANTE (usuarios 6–15)
-- ============================================
INSERT INTO Estudiante (idUsuario) VALUES
(6),(7),(8),(9),(10),(11),(12),(13),(14),(15);

-- ============================================
-- NIVEL (15 registros)
-- ============================================
INSERT INTO Nivel (nombre) VALUES
('Básico 1'), ('Básico 2'), ('Básico 3'),
('Intermedio 1'), ('Intermedio 2'), ('Intermedio 3'),
('Avanzado 1'), ('Avanzado 2'), ('Avanzado 3'),
('Conversación 1'), ('Conversación 2'),
('Gramática 1'), ('Gramática 2'),
('Pronunciación'), ('Preparación TOEFL');

-- ============================================
-- IDIOMA (15 registros)
-- ============================================
INSERT INTO Idioma (nombre) VALUES
('Inglés'),('Francés'),('Portugués'),('Italiano'),('Alemán'),
('Quechua'),('Chino'),('Coreano'),('Japonés'),
('Ruso'),('Holandés'),('Noruego'),('Sueco'),
('Finés'),('Árabe');

-- ============================================
-- AULA (15 registros)
-- ============================================
INSERT INTO Aula (nombre, capacidad) VALUES
('Aula 101', 25), ('Aula 102', 25), ('Aula 103', 30),
('Aula 104', 28), ('Aula 105', 20), ('Aula 201', 25),
('Aula 202', 30), ('Aula 203', 35), ('Aula 204', 20),
('Aula 205', 25), ('LAB 1', 20), ('LAB 2', 20),
('Sala Multimedia', 40), ('Sala Virtual', 50),
('Auditorio Pequeño', 60);

-- ============================================
-- CURSO (15 registros)
-- ============================================
INSERT INTO Curso (nombre, cupoMaximo, fechaInicio, fechaFin, idNivel, idIdioma, idAula, codigoDocente) VALUES
('Inglés Básico 1', 25, '2025-01-10', '2025-03-20', 1, 1, 1, 1),
('Francés Básico 2', 20, '2025-01-10', '2025-03-20', 2, 2, 2, 2),
('Portugués Básico 3', 30, '2025-02-01', '2025-04-10', 3, 3, 3, 3),
('Italiano Intermedio 1', 28, '2025-02-01', '2025-04-10', 4, 4, 4, 4),
('Alemán Intermedio 2', 20, '2025-03-05', '2025-05-15', 5, 5, 5, 1),
('Quechua Intermedio 3', 20, '2025-03-05', '2025-05-15', 6, 6, 6, 2),
('Chino Avanzado 1', 25, '2025-03-10', '2025-06-20', 7, 7, 7, 3),
('Coreano Avanzado 2', 25, '2025-03-10', '2025-06-20', 8, 8, 8, 4),
('Japonés Avanzado 3', 20, '2025-04-01', '2025-07-15', 9, 9, 9, 1),
('Ruso Conversación 1', 25, '2025-04-01', '2025-07-15', 10, 10, 10, 2),
('Holandés Conversación 2', 30, '2025-05-01', '2025-08-10', 11, 11, 11, 3),
('Noruego Gramática 1', 25, '2025-05-01', '2025-08-10', 12, 12, 12, 4),
('Sueco Gramática 2', 25, '2025-06-01', '2025-09-15', 13, 13, 13, 1),
('Finés Pronunciación', 30, '2025-06-01', '2025-09-15', 14, 14, 14, 2),
('Árabe Preparación TOEFL', 20, '2025-07-01', '2025-10-15', 15, 15, 15, 3);

-- ============================================
-- HORARIO (15 registros)
-- ============================================
INSERT INTO Horario (diaSemana, horaInicio, horaFin) VALUES
('Lunes', '08:00', '10:00'),
('Martes', '10:00', '12:00'),
('Miércoles', '14:00', '16:00'),
('Jueves', '08:00', '10:00'),
('Viernes', '10:00', '12:00'),
('Sábado', '09:00', '11:00'),
('Domingo', '08:00', '10:00'),
('Lunes', '18:00', '20:00'),
('Martes', '18:00', '20:00'),
('Miércoles', '18:00', '20:00'),
('Jueves', '18:00', '20:00'),
('Viernes', '18:00', '20:00'),
('Sábado', '14:00', '16:00'),
('Domingo', '14:00', '16:00'),
('Lunes', '16:00', '18:00');

-- ============================================
-- CURSO-HORARIO (15 enlaces)
-- ============================================
INSERT INTO CursoHorario (idCurso, idHorario) VALUES
(1,1),(1,2),(2,3),(3,4),(4,5),
(5,6),(6,7),(7,8),(8,9),(9,10),
(10,11),(11,12),(12,13),(13,14),(14,15);

-- ============================================
-- MATRICULA (15 registros)
-- ============================================
INSERT INTO Matricula (fechaMatricula, estado, idCurso, codigoEstudiante) VALUES
('2025-01-05','Activo',1,1),
('2025-01-06','Activo',1,2),
('2025-01-10','Activo',2,3),
('2025-01-15','Activo',3,4),
('2025-02-01','Activo',4,5),
('2025-02-10','Activo',5,6),
('2025-02-15','Activo',6,7),
('2025-03-01','Activo',7,8),
('2025-03-10','Activo',8,9),
('2025-03-15','Activo',9,10),
('2025-03-20','Activo',10,1),
('2025-04-01','Activo',11,2),
('2025-04-10','Activo',12,3),
('2025-04-15','Activo',13,4),
('2025-05-01','Activo',14,5);

-- ============================================
-- ASISTENCIA (15 registros)
-- ============================================
INSERT INTO Asistencia (fecha, estado, idMatricula) VALUES
('2025-01-12','Presente',1),
('2025-01-13','Presente',2),
('2025-01-20','Ausente',3),
('2025-01-25','Presente',4),
('2025-02-02','Tardanza',5),
('2025-02-05','Presente',6),
('2025-02-10','Ausente',7),
('2025-03-05','Presente',8),
('2025-03-10','Presente',9),
('2025-03-15','Tardanza',10),
('2025-03-20','Presente',11),
('2025-04-01','Presente',12),
('2025-04-10','Ausente',13),
('2025-04-15','Presente',14),
('2025-05-02','Presente',15);

-- ============================================
-- MATRÍCULA — 4 estudiantes por curso (15 cursos)
-- Total: 60 matrículas
-- ============================================

INSERT INTO Matricula (fechaMatricula, estado, idCurso, codigoEstudiante) VALUES
('2025-01-05','Activo',1,1),
('2025-01-05','Activo',1,2),
('2025-01-05','Activo',1,3),
('2025-01-05','Activo',1,4),

('2025-01-06','Activo',2,5),
('2025-01-06','Activo',2,6),
('2025-01-06','Activo',2,7),
('2025-01-06','Activo',2,8),

('2025-01-10','Activo',3,9),
('2025-01-10','Activo',3,10),
('2025-01-10','Activo',3,1),
('2025-01-10','Activo',3,2),

('2025-01-12','Activo',4,3),
('2025-01-12','Activo',4,4),
('2025-01-12','Activo',4,5),
('2025-01-12','Activo',4,6),

('2025-01-15','Activo',5,7),
('2025-01-15','Activo',5,8),
('2025-01-15','Activo',5,9),
('2025-01-15','Activo',5,10),

('2025-02-01','Activo',6,1),
('2025-02-01','Activo',6,2),
('2025-02-01','Activo',6,3),
('2025-02-01','Activo',6,4),

('2025-02-05','Activo',7,5),
('2025-02-05','Activo',7,6),
('2025-02-05','Activo',7,7),
('2025-02-05','Activo',7,8),

('2025-02-10','Activo',8,9),
('2025-02-10','Activo',8,10),
('2025-02-10','Activo',8,1),
('2025-02-10','Activo',8,2),

('2025-02-15','Activo',9,3),
('2025-02-15','Activo',9,4),
('2025-02-15','Activo',9,5),
('2025-02-15','Activo',9,6),

('2025-03-01','Activo',10,7),
('2025-03-01','Activo',10,8),
('2025-03-01','Activo',10,9),
('2025-03-01','Activo',10,10),

('2025-03-10','Activo',11,1),
('2025-03-10','Activo',11,2),
('2025-03-10','Activo',11,3),
('2025-03-10','Activo',11,4),

('2025-03-15','Activo',12,5),
('2025-03-15','Activo',12,6),
('2025-03-15','Activo',12,7),
('2025-03-15','Activo',12,8),

('2025-04-01','Activo',13,9),
('2025-04-01','Activo',13,10),
('2025-04-01','Activo',13,1),
('2025-04-01','Activo',13,2),

('2025-04-10','Activo',14,3),
('2025-04-10','Activo',14,4),
('2025-04-10','Activo',14,5),
('2025-04-10','Activo',14,6),

('2025-04-15','Activo',15,7),
('2025-04-15','Activo',15,8),
('2025-04-15','Activo',15,9),
('2025-04-15','Activo',15,10);

-- ============================================
-- ASISTENCIA — 1 registro por matrícula (60 total)
-- ============================================

INSERT INTO Asistencia (fecha, estado, idMatricula) VALUES
('2025-01-10','Presente',1),
('2025-01-10','Presente',2),
('2025-01-10','Ausente',3),
('2025-01-10','Presente',4),

('2025-01-11','Presente',5),
('2025-01-11','Presente',6),
('2025-01-11','Ausente',7),
('2025-01-11','Presente',8),

('2025-01-12','Ausente',9),
('2025-01-12','Presente',10),
('2025-01-12','Presente',11),
('2025-01-12','Ausente',12),

('2025-01-13','Presente',13),
('2025-01-13','Ausente',14),
('2025-01-13','Presente',15),
('2025-01-13','Presente',16),

('2025-01-15','Presente',17),
('2025-01-15','Presente',18),
('2025-01-15','Ausente',19),
('2025-01-15','Presente',20),

('2025-02-01','Presente',21),
('2025-02-01','Ausente',22),
('2025-02-01','Presente',23),
('2025-02-01','Presente',24),

('2025-02-05','Ausente',25),
('2025-02-05','Presente',26),
('2025-02-05','Presente',27),
('2025-02-05','Presente',28),

('2025-02-10','Presente',29),
('2025-02-10','Presente',30),
('2025-02-10','Ausente',31),
('2025-02-10','Presente',32),

('2025-02-15','Ausente',33),
('2025-02-15','Presente',34),
('2025-02-15','Presente',35),
('2025-02-15','Presente',36),

('2025-03-01','Presente',37),
('2025-03-01','Ausente',38),
('2025-03-01','Presente',39),
('2025-03-01','Presente',40),

('2025-03-10','Presente',41),
('2025-03-10','Presente',42),
('2025-03-10','Presente',43),
('2025-03-10','Ausente',44),

('2025-03-15','Presente',45),
('2025-03-15','Presente',46),
('2025-03-15','Ausente',47),
('2025-03-15','Presente',48),

('2025-04-01','Ausente',49),
('2025-04-01','Presente',50),
('2025-04-01','Presente',51),
('2025-04-01','Presente',52),

('2025-04-10','Presente',53),
('2025-04-10','Presente',54),
('2025-04-10','Presente',55),
('2025-04-10','Ausente',56),

('2025-04-15','Presente',57),
('2025-04-15','Ausente',58),
('2025-04-15','Presente',59),
('2025-04-15','Presente',60);


