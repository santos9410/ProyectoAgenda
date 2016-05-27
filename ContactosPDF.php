<?php
header("content-type: aplication/pdf");

require_once 'controlers/db.php';
$db1 = Conexion::getInstance();
$sql="SELECT * FROM contactos order by idCont asc";

$result=$db1->consultar($sql);
if($result)
$l=mysqli_num_rows($result);
else
  $l=0;
$tbl="
<!DOCTYPE html>
<html>
<head>
  <title>Agenda</title>
  <meta charset='utf-8'>
<link rel='icon' type='image/png' href='img/icon1.jpg' />
  <style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;

}
th {
    background-color: #4CAF50;
    color: white;
}
tr{

}

tr:nth-child(even) {background-color: #f2f2f2}
h2{
  text-align:center;
}
</style>
</head>
<body>
<h2>Contactos Registrados</h2>
  <table  id='tablapdf' cellspacing='0'>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Domicilio</th>
        <th>Teléfono</th>
        <th>email</th>
        <th>cp</th>
        <th>Edad</th>
        <th>Gustos</th>
      </tr>
    </thead>
    ";
    while ($rowEmp = mysqli_fetch_assoc($result)) {
          $nombre=$rowEmp['nombre'];
          $direccion=$rowEmp['direccion'];
          $telefono=$rowEmp['telefono'];
          $email=$rowEmp['email'];
          $cp=$rowEmp['cp'];
          $edad=$rowEmp['edad'];
          $gustos=$rowEmp['gustos'];

          $tbl.="<tr>";
          $tbl.="<td>".$nombre."</td>";
          $tbl.="<td>".$direccion."</td>";
          $tbl.="<td>".$telefono."</td>";
          $tbl.="<td>".$email."</td>";
          $tbl.="<td>".$cp."</td>";
          $tbl.="<td>".$edad."</td>";
          $tbl.="<td>".$gustos."</td>";
          $tbl.="</tr>";
        }
   $tbl.="</table>
 </body>
 </html>";

//$pdf->writeHTML($tbl, true, false, false, false, '');
//$pdf->Output('example_048.pdf', 'I');

require_once 'dompdf/dompdf_config.inc.php';
//$noControl=12290734;

$dompdf = new DOMPDF();
//$fichero = file_get_contents('plantillaC.php', FILE_USE_INCLUDE_PATH);
if($l>0)
  $dompdf->load_html($tbl);
else
  $dompdf->load_html("<h1>Sin datos</h1>");

$dompdf->render();
$dompdf->stream('my.pdf',array('Attachment'=>0));
//$dompdf->stream("documento.pdf");
 ?>
