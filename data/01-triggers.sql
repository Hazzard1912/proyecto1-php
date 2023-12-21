-- Inicializar saldo

CREATE OR REPLACE FUNCTION inicializar_saldo() RETURNS TRIGGER AS $$
BEGIN
  INSERT INTO saldos VALUES (NEW.codigo_contrato, NEW.numero_cliente, NEW.valor_plan);
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER inicializar_saldo
AFTER INSERT ON contratos
FOR EACH ROW
EXECUTE PROCEDURE inicializar_saldo();


-- Validacion del pago

CREATE OR REPLACE FUNCTION validar_pago() RETURNS TRIGGER AS $$
DECLARE
  saldo_actual_var INT;
BEGIN
  SELECT saldo_actual INTO saldo_actual_var FROM saldos WHERE codigo_contrato = NEW.codigo_contrato AND numero_cliente = NEW.numero_cliente;

  IF (NEW.valor_transaccion > saldo_actual_var) THEN
    RAISE EXCEPTION 'El valor de la transaccion es mayor al saldo actual';
  END IF;

  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER validar_pago 
BEFORE INSERT ON transacciones 
FOR EACH ROW 
EXECUTE PROCEDURE validar_pago();


-- Actualizacion del saldo

CREATE OR REPLACE FUNCTION actualizar_saldo() RETURNS TRIGGER AS $$
DECLARE
  saldo_actual_var INT;
BEGIN
  SELECT saldo_actual INTO saldo_actual_var FROM saldos WHERE codigo_contrato = NEW.codigo_contrato AND numero_cliente = NEW.numero_cliente;

  UPDATE saldos SET saldo_actual = saldo_actual_var - NEW.valor_transaccion WHERE codigo_contrato = NEW.codigo_contrato AND numero_cliente = NEW.numero_cliente;

  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER actualizar_saldo
AFTER INSERT ON transacciones
FOR EACH ROW
EXECUTE PROCEDURE actualizar_saldo();
