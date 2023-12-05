<?php require_once('../../bd.php');
$txtID = $_GET['txtID'];
$sentencia = $conexion->prepare("SELECT *,
(SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto) as puesto
FROM tbl_empleados WHERE id=:id"); // Traer datos desde la BD
$sentencia->bindParam(":id", $txtID);
$sentencia->execute(); // Ejecutar la consulta previamente preparada
$registro = $sentencia->fetch(PDO::FETCH_LAZY); // Almacenar los datos de manera asociativa

$nombreCompleto = $registro['primernombre'] . " " . $registro['segundonombre'] . " " . $registro['primerapellido'] . " " . $registro['segundoapellido'];

$fechaInicio = new DateTime($registro['fechadeingreso']);
$fechaFin = new DateTime(date('Y-m-d'));
$intervalo = date_diff($fechaInicio, $fechaFin);
ob_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carta de recomendación</title>
</head>

<body>
  <h1>Carta de recomendación laboral</h1>
  <p><strong>Nombre del trabajador: </strong><?= $nombreCompleto ?>
    <br />
  <p>Buenos Aires, Argentina. <strong>04/12/2023</strong></p>
  <p>A quien pueda interesar.</p>
  <br>
  <p>Reciba un cordial y repetuoso saludo</p>
  <p>A traves de estas lineas deseo hacer de su conocimiento que el/la Sr(a) <strong><?= $nombreCompleto ?></strong></p>
  <p>quien laboró en mi organización durante <strong><?= $intervalo->y ?> años</strong></p>
  <p>quien es un ciudadano con una conducta intachable. Ha demostrado ser un gran trabajador, comprometido, responsable y fiel cumplidor de sus tareas.</p>
  <p>Durante estos años se ha desempeñado como <strong><?= $registro['puesto'] ?></strong></p>
  <p>Es por ello le sugiero considere esta recomendación, con la confianza de que estará siempre a la altura de las circunstancias.</p>
  <p>y su compromiso con el trabajo es incuestionable.</p>
  <p>Sin mas nada a que referirme y, esperando que esta misiva sea tomada en cuenta, dejo mi nro de contacto: +541132145697</p>
  <br>
  <p>Atentamente, </p>
  <br>
  <p> Ing. Manuel Perez.</p>
</body>
</html>

<?php 
$HTML = ob_get_clean();
require_once('../../libs/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
// Instanciamos dompdf para generar nuestro PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($HTML);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('carta_recomendacion.pdf', array("Attachment"=>false));

