<?php
include_once "../db/db.php";

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
