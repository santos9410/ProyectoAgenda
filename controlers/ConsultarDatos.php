<?php
  require_once 'db.php';
  $db1 = Conexion::getInstance();
  $sql="SELECT nombre,edad FROM contactos ";

  $result=$db1->consultar($sql);

  //guardamos en un array multidimensional todos los datos de la consulta
  $i=1;
  $l=mysqli_num_rows($result);
  if($l>0){

    //$data[]=array();
  while ($rowEmp = mysqli_fetch_assoc($result)) {
    $data[]=$rowEmp;
      $i++;
   }

  echo json_encode($data);

  }
  else{
  $data[0]=null;
  echo json_encode($data);
  }
 ?>
