<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="img/icon1.jpg" />

  <link rel="stylesheet" href="css/bootstrap.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/styles.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/custom-icons.css">

  <link href="css/fullcalendar.css" rel="stylesheet" />
  <link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <script src='js/moment.min.js'></script>
  <!-- <script src='js/jquery.min.js'></script> -->
  <script src='js/jquery-ui.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>






<script>

	$(document).ready(function() {

		var zone = "05:30";  //Change this to your timezone

	$.ajax({
		url: 'process.php',
        type: 'POST', // Send post data
        data: 'type=fetch',
        async: false,
        success: function(s){
        	json_events = s;
        }
	});


	var currentMousePos = {
	    x: -1,
	    y: -1
	};
		jQuery(document).on("mousemove", function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });

		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		$('#calendar').fullCalendar({
			events: JSON.parse(json_events),
			//events: [{"id":"14","title":"New Event","start":"2015-01-24T16:00:00+04:00","allDay":false}],
			utc: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			droppable: true,
			slotDuration: '00:30:00',
			eventReceive: function(event){
				var title = event.title;
				var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
				$.ajax({
		    		url: 'process.php',
		    		data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
		    		type: 'POST',
		    		dataType: 'json',
		    		success: function(response){
		    			event.id = response.eventid;
		    			$('#calendar').fullCalendar('updateEvent',event);
		    		},
		    		error: function(e){
		    			console.log(e.responseText);

		    		}
		    	});
				$('#calendar').fullCalendar('updateEvent',event);
				console.log(event);
			},
			eventDrop: function(event, delta, revertFunc) {
		        var title = event.title;
		        var start = event.start.format();
		        var end = (event.end == null) ? start : event.end.format();
		        $.ajax({
					url: 'process.php',
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')
						revertFunc();
					},
					error: function(e){
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
		    eventClick: function(event, jsEvent, view) {
		    	console.log(event.id);
		          var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
		          if (title){
		              event.title = title;
		              console.log('type=changetitle&title='+title+'&eventid='+event.id);
		              $.ajax({
				    		url: 'process.php',
				    		data: 'type=changetitle&title='+title+'&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){
				    			if(response.status == 'success')
		              				$('#calendar').fullCalendar('updateEvent',event);
				    		},
				    		error: function(e){
				    			alert('Error processing your request: '+e.responseText);
				    		}
				    	});
		          }
			},
			eventResize: function(event, delta, revertFunc) {
				console.log(event);
				var title = event.title;
				var end = event.end.format();
				var start = event.start.format();
		        $.ajax({
					url: 'process.php',
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')
						revertFunc();
					},
					error: function(e){
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
			eventDragStop: function (event, jsEvent, ui, view) {
			    if (isElemOverDiv()) {
			    	var con = confirm('Are you sure to delete this event permanently?');
			    	if(con == true) {
						$.ajax({
				    		url: 'process.php',
				    		data: 'type=remove&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){
				    			console.log(response);
				    			if(response.status == 'success'){
				    				$('#calendar').fullCalendar('removeEvents');
            						getFreshEvents();
            					}
				    		},
				    		error: function(e){
				    			alert('Error processing your request: '+e.responseText);
				    		}
			    		});
					}
				}
			}
		});

	function getFreshEvents(){
		$.ajax({
			url: 'process.php',
	        type: 'POST', // Send post data
	        data: 'type=fetch',
	        async: false,
	        success: function(s){
	        	freshevents = s;
	        }
		});
		$('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
	}


	function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }

	});

</script>
<style>

	body {
		/*margin-top: 40px;*/
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    background-color: #fff;
	}

	#trash{
		width:32px;
		height:32px;
		float:left;
		padding-bottom: 15px;
		position: relative;
	}

	#wrap {
		width: 1100px;
		margin: 0 auto;
	}

	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
    margin-left: 20px;
    margin-bottom: 20px;
    color: #000;
	}

	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}

	#external-events .fc-event {
		margin: 10px 0;
		cursor: pointer;
	}

	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
	}

	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
		float: right;
		/*width: auto;*/
    color:#000;
	}

</style>
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
        <li class="active"><a href="Calendario.php">Agregar Actividad</a></li>
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
  <section class="contenido">
  <div class="container-fluid">
    <div class="row">
<!-- <div id='wrap'> -->
      <div id='external-events' class="col-md-10">
        <h4>Draggable Events</h4>
        <div class='fc-event'>New Event</div>
        <p>
          <img src="img/trashcan.png" id="trash" alt="">
        </p>
      </div>

      <div id='calendar' class="col-md-10"></div>

      <div style='clear:both'></div>

      <xspan class="tt">x</xspan>

    <!-- </div> -->
  </div>
</div>
  </section>

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
