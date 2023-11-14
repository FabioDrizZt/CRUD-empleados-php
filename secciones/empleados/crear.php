
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
          <input type="text" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer Apellido</label>
          <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo Apellido</label>
          <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Elija su foto</label>
          <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">Suba su CV</label>
          <input type="file" class="form-control" name="cv" id="cv" placeholder="" aria-describedby="fileHelpId">
        </div>
        <div class="mb-3">
          <label for="puesto" class="form-label">Puesto</label>
          <select class="form-select form-select-lg" name="puesto" id="puesto">
            <option selected>Seleccione su puesto</option>
            <option value="1">Backend</option>
            <option value="2">Frontend</option>
            <option value="3">Fullstack</option>
          </select>
        </div>
        <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-primary">Agregar</button>
      </form>
    </div>
  </div>
</main>
<?php require_once('../../templates/footer.php') ?>