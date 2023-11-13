<?php require_once('../../bd.php');
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
/* echo "<pre>";
print_r($lista_tbl_puestos);
echo "</pre>"; */

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
              <td><a class="btn btn-info" href="editar.php" role="button">Editar</a>
                <a class="btn btn-danger" href="#" role="button">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</main>
<?php require_once('../../templates/footer.php') ?>