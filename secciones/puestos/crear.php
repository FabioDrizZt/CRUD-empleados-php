<?php require_once('../../bd.php');
if ($_POST) {
  //Validamos que los datos hayan sido cargado correctamente
  $nombredelpuesto = (isset($_POST['nombredelpuesto']) ? $_POST['nombredelpuesto'] : "");
  $sentencia = $conexion->prepare("INSERT INTO `tbl_puestos`(`nombredelpuesto`) VALUES (:nombredelpuesto)"); // Traer datos desde la BD
  $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
  $sentencia->execute(); // Ejecutar la consulta previamente preparada
  header("Location:index.php");
}
?>
<?php require_once('../../templates/head.php') ?>
<?php include_once('../../templates/header.php') ?>
<main class="container">
  <div class="card">
    <div class="card-header">
      Creación de puestos
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
          <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="">
        </div>
        <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-primary">Agregar</button>
      </form>
    </div>
  </div>
</main>
<?php require_once('../../templates/footer.php') ?>