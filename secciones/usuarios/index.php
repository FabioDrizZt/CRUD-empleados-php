<?php require_once('../../templates/head.php') ?>
<?php require_once('../../bd.php');
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`"); // Traer datos desde la BD
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC); // Almacenar los datos de manera asociativa
if (isset($_GET['mensaje'])) : ?>
  <script>
    Swal.fire({
      title: "¡<?=$_GET['mensaje']?>!",
      text: "El usuario ha sido <?=$_GET['mensaje']?>.",
      icon: "success"
    });
  </script>
<?php 
endif;
if (isset($_GET['txtID'])) {
  //Validamos que los datos hayan sido cargado correctamente
  $txtID = $_GET['txtID'];
  $sentencia = $conexion->prepare("DELETE FROM `tbl_usuarios` WHERE `id`=:id"); // Traer datos desde la BD
  $sentencia->bindParam(":id", $txtID);
  try {
    $sentencia->execute(); // Ejecutar la consulta previamente preparada
    header("Location:index.php?mensaje=borrado");
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}
?>
<?php include_once('../../templates/header.php') ?>
<main class="container">
  <h1>Usuarios</h1>
  <div class="table-responsive">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary" href="crear.php" role="button">Agregar Usuario</a>
      </div>
      <table id="tabla_id" class="table ">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del usuario</th>
            <th scope="col">contraseña</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lista_tbl_usuarios as $registro) { ?>
            <tr class="">
              <td scope="row"><?= $registro['id'] ?></td>
              <td><?= $registro['usuario'] ?></td>
              <td>*********</td>
              <td><?= $registro['correo'] ?></td>
              <td>
                <a class="btn btn-info" href="editar.php?txtID=<?= $registro['id'] ?>" role="button">Editar</a>
                <a class="btn btn-danger" href="javascript:borrar(<?= $registro['id'] ?>)" role="button">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    function borrar(id) {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertirlo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, bórralo!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = `index.php?txtID=${id}`
        }
      });
    }
  </script>
</main>
<?php require_once('../../templates/footer.php') ?>