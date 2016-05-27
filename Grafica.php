
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

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script type="text/javascript" src="js/Grafica.js"></script>
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
      <li><a href="AdministrarContactos.php">Administrar Contactos</a></li>
      <li><a href="Calendario.php">Agregar Actividad</a></li>
      <li class="dropdown active">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Exportación de datos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="ArchivoXML.php" target="_blank">Generera XML</a></li>
            <li><a href="ContactosPDF.php" target="_blank">Generar PDF</a></li>
            <li class="active"><a href="Grafica.php">Generar GRAFICA</a></li>
          </ul>
        </li>
    </ul>
  </div>
</nav>
<!--  -->
<!-- cuerpo -->
<section class="contenido">

<div id="contenidoGrafica"></div>
</section>
<!--  -->
<!-- footer -->
<footer id="footerWrapper" class="footer navbar-fixed-bottom">
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
