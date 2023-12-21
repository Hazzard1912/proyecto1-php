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
