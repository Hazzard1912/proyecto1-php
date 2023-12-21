<?php
include_once "../db/db.php";

function obtenerSaldo($codigo_contrato)
{
  $query = "SELECT * FROM saldos WHERE codigo_contrato = :codigo_contrato";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  $stmt->bindParam(":codigo_contrato", $codigo_contrato);

  if (!$stmt->execute()) {
    echo "Error en la consulta";
    die();
  }

  $saldo = $stmt->fetch();

  return $saldo;
}
