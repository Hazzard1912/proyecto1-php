<?php
include '../actions/contratos.php';
include '../actions/saldos.php';
include '../actions/transacciones.php';
?>
<div class="col-sm-8 mx-auto">

  <form action="" method="post" class="mt-4">
    <div class="form-group">
      <label for="codigo_contrato">Contrato</label>
      <select name="codigo_contrato" id="codigo_contrato" class="form-control" required>
        <option value="">Seleccionar contrato</option>
        <?php
        $contratos = obtenerTodosContratos();
        foreach ($contratos as $contrato) {
        ?>

          <option value="<?php echo $contrato['codigo_contrato']; ?>">
            <?php echo $contrato['codigo_contrato']; ?>
          </option>
        <?php
        }
        ?>
      </select>
      <input type="submit" value="Consultar" class="btn btn-primary my-2">
    </div>
  </form>

</div>

<script src="../js/evitar-repost.js"></script>

<?php
if (isset($_POST['codigo_contrato'])) {

  $codigo_contrato = $_POST['codigo_contrato'];

  $resp = obtenerSaldo($codigo_contrato);

  if ($resp) {
    echo "<div class='alert alert-success'>El saldo por pagar es: " . $resp['saldo_actual'] . "</div>";

    $info_ultima_transaccion = obtenerUltimaTransaccion($codigo_contrato);

    if ($info_ultima_transaccion) {
      echo "<h3 class='text-center'>Datos de la ultima transaccion: </h3>";
      echo "<table class='table'>";
      echo "<thead><tr><th>Campo</th><th>Valor</th></tr></thead>";
      echo "<tbody>";
      foreach ($info_ultima_transaccion as $key => $value) {
        echo "<tr><td>{$key}</td><td>{$value}</td></tr>";
      }
      echo "</tbody>";
      echo "</table>";
    }
  } else {
    echo "<div class='alert alert-danger'>No se encontró saldo para el contrato seleccionado</div>";
  }
}
