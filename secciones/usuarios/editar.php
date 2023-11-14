<?php require_once('../../bd.php');
$txtID = $_GET['txtID'];
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios` WHERE id=:id"); // Traer datos desde la BD
$sentencia->bindParam(":id", $txtID);
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$registro = $sentencia->fetch(PDO::FETCH_LAZY); // Almacenar los datos de manera asociativa

if ($_POST) {
  //Validamos que los datos hayan sido cargado correctamente
  $usuario = (isset($_POST['usuario']) ? $_POST['usuario'] : "");
  $password = (isset($_POST['password']) ? $_POST['password'] : "");
  $correo = (isset($_POST['correo']) ? $_POST['correo'] : "");
  $id = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
  $sentencia = $conexion->prepare("UPDATE `tbl_usuarios` 
                                  SET `usuario`=:usuario,`password`=:password,`correo`=:correo
                                  WHERE id=:id"); // Traer datos desde la BD
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $password);
  $sentencia->bindParam(":correo", $correo);
  $sentencia->bindParam(":id", $id);
  try {
    $sentencia->execute(); // Ejecutar la consulta previamente preparada
    header("Location:index.php");
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}
?>
<?php require_once('../../templates/head.php') ?>
<?php include_once('../../templates/header.php') ?>
<main class="container">
  <div class="card">
    <div class="card-header">
      Edición de usuarios
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="usuario" class="form-label">Nombre del usuario</label>
          <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="" value="<?= $registro['usuario'] ?>">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="" value="<?= $registro['password'] ?>">
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="abc@mail.com" value="<?= $registro['correo'] ?>">
        </div>
        <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-primary">Editar</button>
      </form>
    </div>
  </div>
</main><?php require_once('../../templates/footer.php') ?>