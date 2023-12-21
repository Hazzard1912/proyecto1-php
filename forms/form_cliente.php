<?php
include '../actions/clientes.php';
?>

<div class="col-sm-8 mx-auto">
  <form action="" method="post">
    <div class="form-group">
      <label for="tipo_documento" class="mt-2">
        Tipo de documento
      </label>
      <select name="tipo_documento" id="tipo_documento" class="form-control" required>
        <option value="CC">Cedula de Ciudadania</option>
        <option value="NIT">NIT</option>
      </select>

      <label for="numero_cliente" class="mt-2">Numero de Cliente</label>
      <input type="number" name="numero_cliente" id="numero_cliente" class="form-control mt-2" required>

      <label for="nombre" class="mt-2">Nombre</label>
      <input type="text" name="nombre" id="nombre" class="form-control mt-2" required>

      <label for="telefono" class="mt-2">Telefono</label>
      <input type="number" name="telefono" id="telefono" class="form-control mt-2" required>

      <label for="ciudad" class="mt-2">Ciudad</label>
      <input type="text" name="ciudad" id="ciudad" class="form-control mt-2" required>

      <label for="correo" class="mt-2">Correo</label>
      <input type="email" name="correo" id="correo" class="form-control mt-2" required>

      <input type="submit" value="Registrar cliente" class="btn btn-primary my-2">
    </div>
  </form>
</div>


<script src="../js/evitar-repost.js"></script>

<?php
if (isset($_POST['tipo_documento'])) {
  $tipo_documento = $_POST['tipo_documento'];
  $numero_cliente = $_POST['numero_cliente'];
  $nombre = $_POST['nombre'];
  $telefono = $_POST['telefono'];
  $ciudad = $_POST['ciudad'];
  $correo = $_POST['correo'];

  if (crearCliente($tipo_documento, $numero_cliente, $nombre, $telefono, $ciudad, $correo)) {
    echo "<script>alert('Cliente registrado correctamente')</script>";
  } else {
    echo "<script>alert('Error al registrar el cliente')</script>";
  }
}
