-- records de la tabla clientes

INSERT INTO clientes(tipo_documento, numero_cliente, nombre, telefono, ciudad, correo) VALUES
('CC', 9512700, 'Carlos Zapata', '3156785678', 'Cali', 'cahuza@hotmail.com'),
('CC', 9713428, 'Luis Fernando Martinez', '3204512231', 'Palmira', 'fercho03@gmail.com'),
('NIT', 900056250, 'Cacharrería la Económica', '6024567823', 'Bogotá', 'clientes@laeconomica.com');


-- records de la tabla contratos

INSERT INTO contratos(codigo_contrato, numero_cliente, numero_linea, fecha_activacion, valor_plan, estado) VALUES
(10256, 9512700, '3156785678', '2015-01-10', 67000, 'ACTIVO'),
(15896, 9512700, '3184523748', '2004-08-05', 28000, 'INACTIVO'),
(16752, 9713428, '3204512231', '2016-04-25', 67000, 'ACTIVO'),
(18452, 900056250, '6024567823', '2022-09-30', 120000, 'ACTIVO');