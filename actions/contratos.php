<?php
include_once "../db/db.php";

function obtenerTodosContratos()
{
  $query = "SELECT codigo_contrato FROM contratos";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  if (!$stmt->execute()) {
    echo "Error en la consulta";
    die();
  }

  $contratos = $stmt->fetchAll();

  return $contratos;
}

function crearContrato($codigo_contrato, $numero_cliente, $numero_linea, $fecha_activacion, $valor_plan, $estado)
{

  $query = "INSERT INTO contratos (codigo_contrato, numero_cliente, numero_linea, fecha_activacion, valor_plan, estado) VALUES (?, ?, ?, ?, ?, ?)";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  if (!$stmt->execute([$codigo_contrato, $numero_cliente, $numero_linea, $fecha_activacion, $valor_plan, $estado])) {
    echo "Error en la consulta";
    die();
  }

  return true;
}

if (isset($_GET['numero_cliente'])) {
  $numero_cliente = $_GET['numero_cliente'];

  $query = "SELECT codigo_contrato FROM contratos WHERE numero_cliente = ?";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  if (!$stmt->execute([$numero_cliente])) {
    echo "Error en la consulta";
    die();
  }

  $contratos = $stmt->fetchAll();

  echo json_encode($contratos);
}
