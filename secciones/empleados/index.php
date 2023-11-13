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
              <th scope="col">Nombre</th>
              <th scope="col">Foto</th>
              <th scope="col">CV</th>
              <th scope="col">Puesto</th>
              <th scope="col">Fecha de ingreso</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr class="">
              <td scope="row">Fabio D. Argañaraz A.</td>
              <td>imagen.jpg</td>
              <td>CV.pdf</td>
              <td>Profesor de Des.Web.</td>
              <td>20/12/2020</td>
              <td>
                <a class="btn btn-success" href="carta.php" role="button">Carta</a>
                <a class="btn btn-info" href="editar.php" role="button">Editar</a>
                <a class="btn btn-danger" href="#" role="button">Eliminar</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<?php require_once('../../templates/footer.php') ?>