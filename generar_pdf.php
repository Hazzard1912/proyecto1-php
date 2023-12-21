<?php
require './vendor/autoload.php';
include './fpdf-dev/exfpdf.php';
include './fpdf-dev/easyTable.php';
include './actions/clientes.php';
include './actions/contratos.php';
include './actions/transacciones.php';

$pdf = new exFPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Encabezado
$pdf->Image('./img/JL.jpg', 10, 10, 30, 30);

$pdf->SetY(50);

$table = new easyTable($pdf, '{35, 30, 50, 30, 30, 65}', 'border:1');

// Agrega los encabezados de la tabla
$table->easyCell(iconv("UTF-8", "CP1252", 'Tipo de documento'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", '# cliente'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Nombre'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Teléfono'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Ciudad'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Correo'), 'font-size:12; font-style:B');
$table->printRow();

// Recorre los datos de la tabla
$clientes = obtenerClientes();
foreach ($clientes as $cliente) {
  $table->easyCell($cliente['tipo_documento']);
  $table->easyCell($cliente['numero_cliente']);
  $table->easyCell(iconv("UTF-8", "CP1252", $cliente['nombre']));
  $table->easyCell($cliente['telefono']);
  $table->easyCell(iconv("UTF-8", "CP1252", $cliente['ciudad']));
  $table->easyCell($cliente['correo']);
  $table->printRow();
}

$table->endTable();

$pdf->Ln(10);

$table = new easyTable($pdf, '{30, 30, 40, 40, 40, 40}', 'border:1');


// Agrega los encabezados de la tabla
$table->easyCell(iconv("UTF-8", "CP1252", 'Cod contrato'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", '# cliente'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", '# linea'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Fecha de Activación'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Valor del plan'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Estado'), 'font-size:12; font-style:B');
$table->printRow();


// Recorre los datos de la tabla
$contratos = obtenerContratos();
foreach ($contratos as $contrato) {
  $table->easyCell($contrato['codigo_contrato']);
  $table->easyCell($contrato['numero_cliente']);
  $table->easyCell($contrato['numero_linea']);
  $table->easyCell($contrato['fecha_activacion']);
  $table->easyCell($contrato['valor_plan']);
  $table->easyCell($contrato['estado']);
  $table->printRow();
}

$table->endTable();

$pdf->Ln(10);

$table = new easyTable($pdf, '{42, 42, 42, 42, 42}', 'border:1');

// Agrega los encabezados de la tabla
$table->easyCell(iconv("UTF-8", "CP1252", 'Cod transacción'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Cod contrato'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", '# cliente'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Fecha de transacción'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Valor transacción'), 'font-size:12; font-style:B');
$table->printRow();

// Recorre los datos de la tabla
$transacciones = obtenerTransacciones();
foreach ($transacciones as $transaccion) {
  $table->easyCell($transaccion['codigo_transaccion']);
  $table->easyCell($transaccion['codigo_contrato']);
  $table->easyCell($transaccion['numero_cliente']);
  $table->easyCell($transaccion['fecha_transaccion']);
  $table->easyCell($transaccion['valor_transaccion']);
  $table->printRow();
}

// Pie de pagina
$pdf->SetY(-31);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Calle 2A # 45- 99 - https://www.empresa.com', 0, 0, 'C');

$pdf->Output();
