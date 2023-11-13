<?php require_once('../../templates/head.php') ?>
<?php include_once('../../templates/header.php') ?>
<main class="container">
  <h1>Usuarios</h1>
  <div class="table-responsive">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary" href="crear.php" role="button">Agregar puesto</a>
      </div>
      <table class="table ">
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
          <tr class="">
            <td scope="row">1</td>
            <td>FabioDrizzt</td>
            <td>***********</td>
            <td>ing.fabio.arg@gmail.com</td>
            <td><a class="btn btn-info" href="editar.php" role="button">Editar</a>
              <a class="btn btn-danger" href="#" role="button">Eliminar</a>
            </td>
          </tr>
          <tr class="">
            <td scope="row">2</td>
            <td>FabioDrizzt</td>
            <td>***********</td>
            <td>ing.fabio.arg@gmail.com</td>
            <td><a class="btn btn-info" href="editar.php" role="button">Editar</a>
              <a class="btn btn-danger" href="#" role="button">Eliminar</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>
<?php require_once('../../templates/footer.php') ?>