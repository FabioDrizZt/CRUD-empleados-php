<?php require_once('../../bd.php');
$txtID = $_GET['txtID'];
$sentencia = $conexion->prepare("SELECT *,
(SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto) as puesto
FROM tbl_empleados WHERE id=:id"); // Traer datos desde la BD
$sentencia->bindParam(":id", $txtID);
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$registro = $sentencia->fetch(PDO::FETCH_LAZY); // Almacenar los datos de manera asociativa
// Traemos los puestos desde la BD
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`"); // Traer datos desde la BD
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC); // Almacenar los datos de manera asociativa

if ($_POST) {
  //buscamos el nombre de los archivos en la BD
  $sentencia = $conexion->prepare("SELECT `foto`,`cv` FROM `tbl_empleados` WHERE id=:id"); // Traer datos desde la BD
  $sentencia->bindParam(":id", $txtID);
  $sentencia->execute(); // Ejecutar la consulta previamente preparada
  $registro = $sentencia->fetch(PDO::FETCH_LAZY); // Almacenar los datos de manera asociativaz

  //Validamos que los datos hayan sido cargado correctamente
  $primernombre = (isset($_POST['primernombre']) ? $_POST['primernombre'] : "");
  $segundonombre = (isset($_POST['segundonombre']) ? $_POST['segundonombre'] : "");
  $primerapellido = (isset($_POST['primerapellido']) ? $_POST['primerapellido'] : "");
  $segundoapellido = (isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : "");
  $foto = (isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : "");
  $cv = (isset($_FILES['cv']['name']) ? $_FILES['cv']['name'] : "");
  $idpuesto = (isset($_POST['idpuesto']) ? $_POST['idpuesto'] : "");
  $id = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
  $sentencia = $conexion->prepare("UPDATE `tbl_empleados` SET 
  primernombre=:primernombre,
  segundonombre=:segundonombre,
  primerapellido=:primerapellido,
  segundoapellido=:segundoapellido,
  foto=:foto,
  cv=:cv,
  idpuesto=:idpuesto
  WHERE id=:id"); // Traer datos desde la BD

  //generamos un nombre unico
  $fecha = new DateTime();
  $foto = ($foto != '') ? $fecha->getTimestamp() . "_" . $foto : '';
  $cv = ($cv != '') ? $fecha->getTimestamp() . "_" . $cv : '';
  // Guardamos la foto en nuestro servidor
  $tmp_foto = $_FILES['foto']['tmp_name'];
  if ($tmp_foto != '') {
    move_uploaded_file($tmp_foto, './images/' . $foto);
    //preguntamos si existe el nombre de los archivos en la BD
    if (isset($registro["foto"])) {
      if (file_exists('./images/' . $registro["foto"])) { // preguntamos si existe el archivo en el server
        unlink('./images/' . $registro["foto"]); // borramos el archivo del server
      }
    }
  }
  // Guardamos el cv en nuestro servidor
  $tmp_cv = $_FILES['cv']['tmp_name'];
  if ($tmp_cv != '') {
    move_uploaded_file($tmp_cv, './documents/' . $cv);
    //preguntamos si existe el nombre de los archivos en la BD
    if (isset($registro["cv"])) {
      if (file_exists('./documents/' . $registro["cv"])) { // preguntamos si existe el archivo en el server
        unlink('./documents/' . $registro["cv"]); // borramos el archivo del server
      }
    }
  }

  $sentencia->bindParam(":primernombre", $primernombre);
  $sentencia->bindParam(":segundonombre", $segundonombre);
  $sentencia->bindParam(":primerapellido", $primerapellido);
  $sentencia->bindParam(":segundoapellido", $segundoapellido);
  $sentencia->bindParam(":foto", $foto);
  $sentencia->bindParam(":cv", $cv);
  $sentencia->bindParam(":idpuesto", $idpuesto);
  $sentencia->bindParam(":id", $id);
  
  try {
    $sentencia->execute(); // Ejecutar la consulta previamente preparada
    header("Location:index.php?mensaje=editado");
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
      Edición de empleados
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer Nombre</label>
          <input type="text" class="form-control" name="primernombre" id="primernombre" placeholder="" value="<?= $registro['primernombre'] ?>">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text" class="form-control" name="segundonombre" id="segundonombre" value="<?= $registro['segundonombre'] ?>" placeholder="">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer Apellido</label>
          <input type="text" class="form-control" name="primerapellido" id="primerapellido" placeholder="" value="<?= $registro['primerapellido'] ?>">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo Apellido</label>
          <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" placeholder="" value="<?= $registro['segundoapellido'] ?>">
        </div>
        <div class="mb-3">
          <img src=<?= './images/' . $registro['foto'] ?> class="img-fluid rounded" width=250 alt="foto del empleado">
          <br>
          <label for="foto" class="form-label">Cambiar foto 👇</label>
          <input type="file" class="form-control" name="foto" id="foto" placeholder="" accept="image/jpeg">
        </div>
        <div class="mb-3">
          <a download href=<?= './documents/' . $registro['cv'] ?>>CV actual</a>
          <br>
          <label for="cv" class="form-label">Cambiar CV 👇</label>
          <input type="file" class="form-control" name="cv" id="cv" placeholder="" accept="application/pdf" title="Subir el CV en formato pdf">
        </div>
        <div class="mb-3">
          <label for="puesto" class="form-label">Puesto</label>
          <select class="form-select form-select-lg" name="idpuesto" id="puesto">
            <?php foreach ($lista_tbl_puestos as $puesto) : ?>
              <option value=<?= $puesto['id']; ?> <?= ($puesto['id'] == $registro['idpuesto']) ? "selected" : ""; ?>><?= $puesto['nombredelpuesto']; ?></option>
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