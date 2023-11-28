<?php require_once('../../bd.php');
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`"); // Traer datos desde la BD
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC); // Almacenar los datos de manera asociativa

if ($_POST) {
  //Validamos que los datos hayan sido cargado correctamente
  /* print_r($_POST);   */
  $primernombre = (isset($_POST['primernombre']) ? $_POST['primernombre'] : "");
  $segundonombre = (isset($_POST['segundonombre']) ? $_POST['segundonombre'] : "");
  $primerapellido = (isset($_POST['primerapellido']) ? $_POST['primerapellido'] : "");
  $segundoapellido = (isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : "");
  $idpuesto = (isset($_POST['idpuesto']) ? $_POST['idpuesto'] : "");
  /* print_r($_FILES); */
  $foto = (isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : "");
  $cv = (isset($_FILES['cv']['name']) ? $_FILES['cv']['name'] : "");

  $sentencia = $conexion->prepare("INSERT 
  INTO `tbl_empleados`(primernombre, segundonombre, primerapellido, segundoapellido, foto, cv, idpuesto) 
              VALUES  (:primernombre, :segundonombre, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto)"); // Enviar datos desde la BD
  // Asignamos los valores a las variables de la consulta              
  $sentencia->bindParam(":primernombre", $primernombre);
  $sentencia->bindParam(":segundonombre", $segundonombre);
  $sentencia->bindParam(":primerapellido", $primerapellido);
  $sentencia->bindParam(":segundoapellido", $segundoapellido);
  $sentencia->bindParam(":idpuesto", $idpuesto);

  //generanos un nombre unico
  $fecha = new DateTime();
  $foto = ($foto != '') ? $fecha->getTimestamp() . "_" . $foto : '';
  $cv = ($cv != '') ? $fecha->getTimestamp() . "_" . $cv : '';

  // Guardamos la foto en nuestro servidor
  $tmp_foto = $_FILES['foto']['tmp_name'];
  if ($tmp_foto != '') {
    move_uploaded_file($tmp_foto, './images/' . $foto);
  }
  // Guardamos el cv en nuestro servidor
  $tmp_cv = $_FILES['cv']['tmp_name'];
  if ($tmp_cv != '') {
    move_uploaded_file($tmp_cv, './documents/' . $cv);
  }

  $sentencia->bindParam(":foto", $foto);
  $sentencia->bindParam(":cv", $cv);
  // Ejecutar la consulta previamente preparada
  $sentencia->execute();
  header("Location:index.php");
}
?>
<?php require_once('../../templates/head.php') ?>
<?php include_once('../../templates/header.php') ?>
<main class="container">
  <div class="card">
    <div class="card-header">
      Creación de empleados
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer Nombre</label>
          <input type="text" class="form-control" name="primernombre" id="primernombre" placeholder="">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text" class="form-control" name="segundonombre" id="segundonombre" title="En caso de no tener, dejar el campo vacio" placeholder="">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer Apellido</label>
          <input type="text" class="form-control" name="primerapellido" id="primerapellido" placeholder="">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo Apellido</label>
          <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" placeholder="">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Elija su foto</label>
          <input type="file" class="form-control" name="foto" id="foto" placeholder="" accept="image/jpeg">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">Suba su CV</label>
          <input type="file" class="form-control" name="cv" id="cv" placeholder="" accept="application/pdf" title="Subir el CV en formato pdf">
        </div>
        <div class="mb-3">
          <label for="puesto" class="form-label">Puesto</label>
          <select class="form-select form-select-lg" name="idpuesto" id="puesto">
            <option selected>Seleccione su puesto</option>
            <?php foreach ($lista_tbl_puestos as $puesto) : ?>
              <option value=<?= $puesto['id']; ?>><?= $puesto['nombredelpuesto']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-primary">Agregar</button>
      </form>
    </div>
  </div>
</main>
<?php require_once('../../templates/footer.php') ?>