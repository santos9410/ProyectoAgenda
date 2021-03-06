<?php
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    require_once 'controlers/db.php';
    $db1 = Conexion::getInstance();
    $sql="SELECT * FROM contactos where idCont=$id";

    $result = $db1->consultar($sql);
    $rowEmp = mysqli_fetch_assoc($result);
    $nombre =    $rowEmp['nombre'] ;
    $direccion = $rowEmp['direccion'] ;
    $telefono =  $rowEmp['telefono'] ;
    $email =     $rowEmp['email'] ;
    $cp =        $rowEmp['cp'] ;
    $edad =      $rowEmp['edad'] ;
    $gustos =    $rowEmp['gustos'] ;

  }
  else{
    header("Location:index.php");
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Agenda</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="img/icon1.jpg" />
  <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  <link rel="stylesheet" href="css/bootstrap.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/styles.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/custom-icons.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <script type="text/javascript" src="js/Modificar.js"></script>

</head>
<body>

<!-- nav  -->
<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="">Agenda</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Inicio</a></li>
      <li><a href="Agregar.php">Agregar Contacto</a></li>
      <li class="active"><a href="AdministrarContactos.php">Administrar Contactos</a></li>
      <li><a href="Calendario.php">Agregar Actividad</a></li>
      <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Exportación de datos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="ArchivoXML.php" target="_blank">Generera XML</a></li>
            <li><a href="ContactosPDF.php" target="_blank">Generar PDF</a></li>
            <li><a href="Grafica.php">Generar GRAFICA</a></li>
          </ul>
        </li>
    </ul>
  </div>
</nav>
<!--  -->
<!-- cuerpo -->
<section class="contenido ">

<div class="cajaMensaje col-xs-5 col-xs-offset-4 text-center">
  <div class="alert alert-success alerta1 fade-in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Modificación correcta!!!
  </div>
  <div class="alert alert-danger alerta2 fade-in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> Ha ocurrido un problema al Modificar!!!
  </div>
</div>
<div class="container-fluid agregar1">
  <form class="form-horizontal formModificar" id="ModificarForm">
<input type="hidden" name="idcont" id='idCont' value='<?php echo $id;?>'>

      <div class="form-group col-xs-12">
          <label class="control-label col-xs-3">Nombre:</label>
          <div class="col-xs-9">
              <input type="text" class="form-control" placeholder="Nombre" id="inputNombre" required maxlength="50" value='<?php echo $nombre ?> '>
          </div>
      </div>
      <div class="form-group col-xs-12">
          <label class="control-label col-xs-3">Dirección:</label>
          <div class="col-xs-9">
              <input type="text" class="form-control" placeholder="Dirección" id="inputDir" maxlength="50" value='<?php echo $rowEmp['direccion'] ?>'>
          </div>
      </div>

      <div class="form-group col-xs-12" >
          <label class="control-label col-xs-3" >Telefono:</label>
          <div class="col-xs-9">
              <input type="tel" class="form-control" placeholder="Telefono" id="inputTel" maxlength="10" value='<?php echo $rowEmp['telefono'] ?>' pattern="[0-9]{10}">
          </div>
      </div>
      <div class="form-group col-xs-12" >
          <label class="control-label col-xs-3" >Email:</label>
          <div class="col-xs-9">
              <input type="email" class="form-control" placeholder="Email" id="inputEmail" maxlength="70" value='<?php echo $rowEmp['email'] ?>'>
          </div>
      </div>
      <div class="form-group col-xs-12" >
          <label class="control-label col-xs-3" >Código Postal:</label>
          <div class="col-xs-9">
              <input type="text" class="form-control" placeholder="Código Postal" id="inputCP" maxlength="5" value='<?php echo $rowEmp['cp'] ?>'>
          </div>
      </div>
      <div class="form-group col-xs-12" >
          <label class="control-label col-xs-3" >Edad:</label>
          <div class="col-xs-9">
              <input type="text" class="form-control" placeholder="Edad" id="inputEdad" required maxlength="3" value='<?php echo $rowEmp['edad'] ?>'>
          </div>
      </div>
      <div class="form-group col-xs-12">

              <label class="control-label col-xs-3">Gustos:</label>
              <div class="col-xs-9">
                <textarea name="name" rows="5" cols="25" class="form-control" maxlength="250" id="inputGustos" ><?php echo $rowEmp['gustos'] ?></textarea>
              </div>

      </div>
      <br>
      <div class="form-group">
          <div class="col-xs-offset-3 col-xs-9 col-sm-12 col-md-12 ">
            <div class="col-sm-6">
              <input type="reset" class="btn btn-default" value="Limpiar">
            </div>
            <div class="col-sm-6">
              <input type="submit" class="btn btn-primary" value="Modificar">
            </div>

          </div>
      </div>
  </form>
</div>

</section>
<!--  -->
<!-- footer -->
<footer id="footerWrapper" class="footer">
	<section id="mainFooter">
		<div class="container">
			<div class="row">

				<div class="col-sm-6">
					<div class="footerWidget col-md-offset-2">

						<h3>Proyecto Final</h3>
						<address>
							<p> <i class="icon-location"></i>&nbsp;Avenida Tecnológico #100.<br>
								Ciudad Guzmán, Mpio. de Zapotlán el Grande, Jalisco, México. <br>
								<i class="icon-phone"></i>&nbsp;341 879 19 24 <br>
								<i class="icon-mail-alt"></i>&nbsp;san15lg@gmail.com </p>
							</address>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="footerWidget col-md-offset-5">
							<h3>Follow us, we are social</h3>
							<ul class="socialNetwork">
								<li><a href="https://www.facebook.com/TodoRisass/?fref=ts" class="tips" title="follow me on Facebook"><i class="icon-facebook-1 iconRounded"></i></a></li>

								<li><a href="https://plus.google.com/u/0/104801145262221262087" class="tips" title="follow me on Google+"><i class="icon-gplus-1 iconRounded"></i></a></li>


							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

</footer>
<!--  -->
</body>
</html>
