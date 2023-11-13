<?php

try {
  $server = "localhost"; // 127.0.0.1
  $dbname = "crud_empleados";
  $user = "root";
  $password = "";

  $dsn = "mysql:host=$server;dbname=$dbname";
  $conexion = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
  echo $e->getMessage();
}
