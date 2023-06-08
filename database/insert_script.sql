INSERT INTO `areas` (`id`, `nombre`) VALUES
(1, 'Administrativa y Financiera'),
(2, 'Ingeniería'),
(5, 'Desarrollo de Negocio'),
(6, 'Proyectos'),
(7, 'Servicios'),
(8, 'Calidad');

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Desarrollador'),
(2, 'Analista'),
(3, 'Tester'),
(4, 'Diseñador'),
(5, 'Profesional PMO'),
(6, 'Profesional de servicios'),
(7, 'Auxiliar administrativo'),
(8, 'Codirector');


INSERT INTO `empleado` (`id`, `nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) VALUES
(3, 'Pedro Pérez', 'pperez@example.co', 'M', 5, 1, 'Hola mundo'),
(4, 'Amalia Bayona', 'abayona@example.co', 'F', 8, 0, 'Para contactar a Amalia Bayona, puede escribir al correo electrónico abayona@example.co');

INSERT INTO `empleado_rol` (`empleado_id`, `rol_id`) VALUES
(3, 4),
(3, 7),
(3, 2),
(4, 1),
(4, 2);
