<?php

  require_once 'controlers/db.php';
  $db1 = Conexion::getInstance();
  $sql="SELECT * FROM contactos ORDER BY idCont ASC";

  $result=$db1->consultar($sql) or die("Sin resultados");
  if(!$result){
    header("Content-Type: text/plain");
    die("Sin resltados");

}
else{
  header("Content-type: text/xml");  
}
  $salida_xml = "<?xml version=\"1.0\"?>\n";
  $salida_xml .= "<Contactos>\n";
  while ($rowEmp = mysqli_fetch_assoc($result)) {
    $id=(string) $rowEmp['idCont'];

    $salida_xml .= "\t<id_$id>\n";
    $salida_xml .= "\t\t<titulo>" . $rowEmp['nombre'] . "</titulo>\n";
    $salida_xml .= "\t\t<direccion>" . $rowEmp['direccion'] . "</direccion>\n";
    $salida_xml .= "\t\t<telefono>" . $rowEmp['telefono'] . "</telefono>\n";
    $salida_xml .= "\t\t<email>" . $rowEmp['email'] . "</email>\n";
    $salida_xml .= "\t\t<cp>" . $rowEmp['cp'] . "</cp>\n";
    $salida_xml .= "\t\t<edad>" . $rowEmp['edad'] . "</edad>\n";
      $salida_xml .= "\t\t<gustos>" . $rowEmp['gustos'] . "</gustos>\n";
    $salida_xml .= "\t</id_$id>\n";

   }


  $salida_xml .= "</Contactos>";

echo $salida_xml;

?>
