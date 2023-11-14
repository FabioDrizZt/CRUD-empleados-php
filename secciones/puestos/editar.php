<?php require_once('../../bd.php');
$txtID = $_GET['txtID'];
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos` WHERE id=:id"); // Traer datos desde la BD
$sentencia->bindParam(":id", $txtID);
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$registro = $sentencia->fetch(PDO::FETCH_LAZY); // Almacenar los datos de manera asociativa

if ($_POST) {
  //Validamos que los datos hayan sido cargado correctamente
  $nombredelpuesto = (isset($_POST['nombredelpuesto']) ? $_POST['nombredelpuesto'] : "");
  $id = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
  $sentencia = $conexion->prepare("UPDATE `tbl_puestos` SET `nombredelpuesto`=:nombredelpuesto WHERE id=:id"); // Traer datos desde la BD
  $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
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
      Edición de puestos
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
          <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" value="<?= $registro['nombredelpuesto'] ?>">
        </div>
        <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-primary">Editar</button>
      </form>
    </div>
  </div>
</main><?php require_once('../../templates/footer.php') ?>