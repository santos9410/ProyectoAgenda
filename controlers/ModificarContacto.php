<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['nombre']) && isset($_POST['dir'])
             && isset($_POST['tel']) && isset($_POST['email'])
             && isset($_POST['cp']) && isset($_POST['edad'])
             && isset($_POST['gustos']) && isset($_POST['id']) )

        {
          $id=test_input($_POST['id']);
          $nombre=test_input($_POST['nombre']);
          $dir=test_input($_POST['dir']);
          $tel=test_input($_POST['tel']);
          $email=test_input($_POST['email']);
          $cp=test_input($_POST['cp']);
          $edad=test_input($_POST['edad']);
          $gustos=test_input($_POST['gustos']);

          require_once 'db.php';
          $db1 = Conexion::getInstance();
          $sql="UPDATE contactos SET nombre='$nombre',direccion='$dir',telefono='$tel',email='$email',cp='$cp',edad=$edad,gustos='$gustos' WHERE idCont=$id";

          $result=$db1->modificar($sql);

          if($result){
            $data[0]="true";
            echo json_encode($data);
          }
          else{
            $data[0]="false";
            $data[0]=$result;
            echo json_encode($data);
          }
        }
        else{
          $data[0]="error de php";
          echo json_encode($data);
        }
      }

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = addslashes ($data);
    return $data;
}
?>
