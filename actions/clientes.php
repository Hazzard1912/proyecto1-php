<?php
include_once "../db/db.php";

function obtenerClientes()
{

  $query = "SELECT * FROM clientes";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  if (!$stmt->execute()) {
    echo "Error en la consulta";
    die();
  }

  $clientes = $stmt->fetchAll();

  return $clientes;
}


function crearCliente($tipo_documento, $numero_cliente, $nombre, $telefono, $ciudad, $correo)
{
  $query = "INSERT INTO clientes (tipo_documento, numero_cliente, nombre, telefono, ciudad, correo) VALUES (?, ?, ?, ?, ?, ?)";
  $pdo = get_pdo();

  $stmt = $pdo->prepare($query);

  if (!$stmt->execute([$tipo_documento, $numero_cliente, $nombre, $telefono, $ciudad, $correo])) {
    echo "Error en la consulta";
    die();
  }

  return true;
}
