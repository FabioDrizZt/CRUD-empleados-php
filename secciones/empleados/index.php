<?php require_once('../../bd.php');
$sentencia = $conexion->prepare("SELECT *,
 (SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto) as puesto
 FROM `tbl_empleados`"); // Traer datos desde la BD
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC); // Almacenar los datos de manera asociativa
if (isset($_GET['txtID'])) {
  //Validamos que los datos hayan sido cargado correctamente
  $txtID = $_GET['txtID'];
  $sentencia = $conexion->prepare("DELETE FROM `tbl_empleados` WHERE `id`=:id"); // Traer datos desde la BD
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
  <h1>Empleados</h1>
  <div class="card">
    <div class="card-header">
      <a class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table ">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Foto</th>
              <th scope="col">CV</th>
              <th scope="col">Puesto</th>
              <th scope="col">Fecha de ingreso</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lista_tbl_empleados as $registro) { ?>
              <tr class="">
                <td scope="row"><?= $registro['id'] ?></td>
                <td scope="row"><?= $registro['primernombre'] . " " . $registro['segundonombre'] . " " . $registro['primerapellido'] . " " . $registro['segundoapellido'] ?></td>
                <td><?= $registro['foto'] ?></td>
                <td><?= $registro['cv'] ?></td>
                <td><?= $registro['puesto'] ?></td>
                <td><?= $registro['fechadeingreso'] ?></td>
                <td>
                  <a class="btn btn-success" href="carta.php" role="button">Carta</a>
                  <a class="btn btn-info" href="editar.php?txtID=<?= $registro['id'] ?>" role="button">Editar</a>
                  <a class="btn btn-danger" href="index.php?txtID=<?= $registro['id'] ?>" role="button">Eliminar</a>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<?php require_once('../../templates/footer.php') ?>