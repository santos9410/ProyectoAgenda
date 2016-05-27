<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['id']) )

        {
          $id=test_input($_POST['id']);

          require_once 'db.php';
          $db1 = Conexion::getInstance();
          $sql="DELETE FROM contactos WHERE idCont=$id";

          $result=$db1->eliminar($sql);

          if($result){
            $data[0]="true";
            echo json_encode($data);
          }
          else{
            $data[0]="false";
            $data[1]=$result;
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
