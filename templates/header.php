<?php 
session_start();
$url_base = "http://localhost/CRUD-empleados/";
if(!isset($_SESSION['usuario'])){
  header("Location:".$url_base."login.php");
}
?>
<header>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="<?= $url_base ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Sistema de empleados</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?= $url_base ?>" class="nav-link active" aria-current="page">Inicio</a></li>
        <li class="nav-item"><a href="<?= $url_base ?>secciones/empleados" class="nav-link">Empleados</a></li>
        <li class="nav-item"><a href="<?= $url_base ?>secciones/puestos" class="nav-link">Puestos</a></li>
        <li class="nav-item"><a href="<?= $url_base ?>secciones/usuarios" class="nav-link">Usuarios</a></li>
        <?php 
        if ($_SESSION['logueado']) : ?>
          <li class="nav-item"><a href="<?= $url_base ?>cerrar.php" class="nav-link">Cerrar Sesion</a></li>
        <?php else : ?>
          <li class="nav-item"><a href="<?= $url_base ?>login.php" class="nav-link">Iniciar Sesion</a></li>
        <?php endif; ?>
      </ul>
    </header>
  </div>
</header>