<?php
require_once __DIR__  . "/../db/db.php";

function obtenerTransacciones()
{
  $query = "SELECT * FROM transacciones";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  if (!$stmt->execute()) {
    echo "Error en la consulta";
    die();
  }

  $transacciones = $stmt->fetchAll();

  return $transacciones;
}

function obtenerUltimaTransaccion($contrato)
{
  $query = "SELECT * FROM transacciones WHERE codigo_contrato = :codigo_contrato ORDER BY fecha_transaccion DESC LIMIT 1";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  $stmt->bindParam(":codigo_contrato", $contrato);

  if (!$stmt->execute()) {
    echo "Error en la consulta";
    die();
  }

  $transaccion = $stmt->fetch();

  return $transaccion;
}

function crearTransaccion($numero_cliente, $codigo_contrato, $valor_transaccion)
{

  $fecha_transaccion = date("Y-m-d H:i:s");

  $query = "INSERT INTO transacciones (codigo_contrato, numero_cliente, fecha_transaccion, valor_transaccion) VALUES (?, ?, ?, ?)";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  if (!$stmt->execute([$codigo_contrato, $numero_cliente, $fecha_transaccion, $valor_transaccion])) {
    echo "Error en la consulta";
    die();
  }

  return true;
}
