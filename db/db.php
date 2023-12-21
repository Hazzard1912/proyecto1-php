<?php
require_once __DIR__ . '/../vendor/autoload.php';

function get_pdo()
{
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  $host = $_ENV['DB_HOST'];
  $db = $_ENV['DB_NAME'];
  $user = $_ENV['DB_USER'];
  $password = $_ENV['DB_PASSWORD'];

  $dsn = "pgsql:host=$host;dbname=$db;user=$user;password=$password";

  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

  try {
    $pdo = new PDO($dsn, $user, $password, $options);
    return $pdo;
  } catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . '<br>';
  }
}
