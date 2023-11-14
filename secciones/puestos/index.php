<?php require_once('../../bd.php');
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`"); // Traer datos desde la BD
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC); // Almacenar los datos de manera asociativa
if (isset($_GET['txtID'])) {
  //Validamos que los datos hayan sido cargado correctamente
  $txtID = $_GET['txtID'];
  $sentencia = $conexion->prepare("DELETE FROM `tbl_puestos` WHERE `id`=:id"); // Traer datos desde la BD
  $sentencia->bindParam(":id", $txtID);
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
  <h1>Puestos</h1>
  <div class="table-responsive">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary" href="crear.php" role="button">Agregar puesto</a>
      </div>
      <table class="table ">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del puesto</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lista_tbl_puestos as $registro) { ?>
            <tr class="">
              <td scope="row"><?= $registro['id'] ?></td>
              <td><?= $registro['nombredelpuesto'] ?> </td>
              <td>
                <a class="btn btn-info" href="editar.php?txtID=<?= $registro['id'] ?>" role="button">Editar</a>
                <a class="btn btn-danger" href="index.php?txtID=<?= $registro['id'] ?>" role="button">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</main>
<?php require_once('../../templates/footer.php') ?>