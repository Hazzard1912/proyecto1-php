<?php
include '../actions/clientes.php';
include '../actions/contratos.php';
include '../actions/saldos.php';
?>
<div class="col-sm-8 mx-auto">
  <form action="" method="post">
    <div class="form-group">

      <div id="seleccion_cliente" class="mt-2">
        <label for="numero_cliente">Cliente</label>
        <!-- Select para clientes -->
        <select id="numero_cliente" name="numero_cliente" class="form-control">
          <option></option>
          <?php
          $clientes = obtenerClientes();
          foreach ($clientes as $cliente) {
          ?>
            <option value="<?php echo $cliente['numero_cliente']; ?>">
              <?php echo $cliente['numero_cliente']; ?>
            </option>
          <?php
          }
          ?>
        </select>
      </div>

      <div id="nuevo_cliente" class="mt-2">
        <button class="btn btn-warning">
          <a href="crear_cliente.php" style="text-decoration: none; color:aliceblue;">Crear Cliente</a>
        </button>
      </div>
      <label for="codigo_contrato" class="mt-2">
        Numero de Contrato
      </label>
      <div id="codigo_contrato" class="mt-2">
        <input type="number" name="codigo_contrato" class="form-control" />
      </div>

      <label for="numero_linea">
        Línea
      </label>
      <input type="number" id="numero_linea" name="numero_linea" class="form-control mt-2" required>

      <label for="fecha_activacion">Fecha de Activación</label>
      <input type="date" name="fecha_activacion" id="fecha_activacion" class="form-control mt-2" required>

      <label for="valor_plan">Valor del Plan</label>
      <input type="number" id="valor_plan" name="valor_plan" class="form-control mt-2" required>

      <label for="estado">Estado</label>
      <select id="estado" name="estado" class="form-control mt-2">
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
      </select>

      <input type="submit" value="Crear Contrato" class="btn btn-primary my-2">
    </div>
  </form>
</div>


<script src="../js/evitar-repost.js"></script>

<?php

if (isset($_POST['numero_cliente'])  && isset($_POST['numero_linea']) && isset($_POST['fecha_activacion']) && isset($_POST['valor_plan']) && isset($_POST['estado']) && isset($_POST['codigo_contrato'])) {

  $codigo_contrato = ($_POST['codigo_contrato']);
  $numero_cliente = ($_POST['numero_cliente']);
  $numero_linea = $_POST['numero_linea'];
  $fecha_activacion = $_POST['fecha_activacion'];
  $valor_plan = $_POST['valor_plan'];
  $estado = $_POST['estado'];

  if (crearContrato($codigo_contrato, $numero_cliente, $numero_linea, $fecha_activacion, $valor_plan, $estado)) {
    echo "<script>";
    echo "alert('¡Registro exitoso!');";
    echo "</script>";
  }
}
