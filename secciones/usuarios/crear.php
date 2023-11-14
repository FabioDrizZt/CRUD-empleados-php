<?php require_once('../../bd.php');
if ($_POST) {
  //Validamos que los datos hayan sido cargado correctamente
  $usuario = (isset($_POST['usuario']) ? $_POST['usuario'] : "");
  $password = (isset($_POST['password']) ? $_POST['password'] : "");
  $correo = (isset($_POST['correo']) ? $_POST['correo'] : "");
  $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios`
          (`usuario`, `password`, `correo`) 
  VALUES (:usuario, :password, :correo) "); // Traer datos desde la BD
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $password);
  $sentencia->bindParam(":correo", $correo);
  $sentencia->execute(); // Ejecutar la consulta previamente preparada
  header("Location:index.php");
}
?>
<?php require_once('../../templates/head.php') ?>
<?php include_once('../../templates/header.php') ?>
<main class="container">
  <div class="card">
    <div class="card-header">
      Creación de usuarios
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="usuario" class="form-label">Nombre del usuario</label>
          <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="">
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="abc@mail.com">
        </div>
        <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-primary">Agregar</button>
      </form>
    </div>
  </div>
</main>
<?php require_once('../../templates/footer.php') ?>