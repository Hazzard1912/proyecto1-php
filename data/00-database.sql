
-- Tabla clientes
CREATE TABLE IF NOT EXISTS clientes(
  tipo_documento VARCHAR(3) NOT NULL,
  numero_cliente INT NOT NULL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  telefono VARCHAR(15) NOT NULL,
  ciudad VARCHAR(50) NOT NULL,
  correo VARCHAR(50) NOT NULL
);

-- Tabla contratos:
CREATE TABLE IF NOT EXISTS contratos(
  codigo_contrato INT NOT NULL,
  numero_cliente INT NOT NULL REFERENCES clientes(numero_cliente),
  numero_linea VARCHAR(15) NOT NULL,
  fecha_activacion DATE NOT NULL,
  valor_plan INT NOT NULL,
  estado VARCHAR(15) NOT NULL,
  PRIMARY KEY (codigo_contrato, numero_cliente)
);

-- Tabla transacciones:
CREATE TABLE IF NOT EXISTS transacciones(
  codigo_transaccion SERIAL NOT NULL,
  codigo_contrato INT NOT NULL,
  numero_cliente INT NOT NULL,
  fecha_transaccion TIMESTAMP NOT NULL,
  valor_transaccion INT NOT NULL,
  PRIMARY KEY (codigo_transaccion, codigo_contrato, numero_cliente),
  FOREIGN KEY (codigo_contrato, numero_cliente) REFERENCES contratos(codigo_contrato, numero_cliente)
);

-- Tabla saldos:
CREATE TABLE IF NOT EXISTS saldos(
  codigo_contrato INT NOT NULL,
  numero_cliente INT NOT NULL,
  saldo_actual INT NOT NULL,
  PRIMARY KEY (codigo_contrato, numero_cliente),
  FOREIGN KEY (codigo_contrato, numero_cliente) REFERENCES contratos(codigo_contrato, numero_cliente)
);