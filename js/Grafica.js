$(document).ready(function() {


  $.ajax({
      // En data puedes utilizar un objeto JSON, un array o un query string
     //  data: {"noControl":control,"nombre":numero},
       data: {},
      //Cambiar a type: POST si necesario
      type: "POST",
      // Formato de datos que se espera en la respuesta
      dataType: "json",
      // URL a la que se enviará la solicitud Ajax
      url: "controlers/ConsultarDatos.php",
  })
   .done(function( data, textStatus, jqXHR ) {
      //console.log(data);
      if(data.length>0){
        var nombre = [];
        var edad = [];
        $.each(data, function(i, item) {
        //    console.log(item.nombre +" i: "+i);
            nombre[i]=item.nombre;
            edad[i]=parseInt(item.edad, 10);
          });
          Graficar(nombre,edad);
        console.log("la longitud es mayor a cero"+data.length);
      }
        if ( console && console.log ) {
           console.log( "La solicitud se ha completado correctamente." );

       }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
       if ( console && console.log ) {
           console.log( "La solicitud a fallado: " +  textStatus);
           console.log(jqXHR);
       }
  });



});



function Graficar(nombre,edad){
  /**
   * Sand-Signika theme for Highcharts JS
   * @author Torstein Honsi
   */

  // Load the fonts
  Highcharts.createElement('link', {
     href: 'https://fonts.googleapis.com/css?family=Signika:400,700',
     rel: 'stylesheet',
     type: 'text/css'
  }, null, document.getElementsByTagName('head')[0]);

  // Add the background image to the container
  Highcharts.wrap(Highcharts.Chart.prototype, 'getContainer', function (proceed) {
     proceed.call(this);
     this.container.style.background = 'url(http://www.highcharts.com/samples/graphics/sand.png)';
  });


  Highcharts.theme = {
     colors: ["#f45b5b", "#8085e9", "#8d4654", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
        "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
     chart: {
        backgroundColor: null,
        style: {
           fontFamily: "Signika, serif"
        }
     },
     title: {
        style: {
           color: 'black',
           fontSize: '16px',
           fontWeight: 'bold'
        }
     },
     subtitle: {
        style: {
           color: 'black'
        }
     },
     tooltip: {
        borderWidth: 0
     },
     legend: {
        itemStyle: {
           fontWeight: 'bold',
           fontSize: '13px'
        }
     },
     xAxis: {
        labels: {
           style: {
              color: '#6e6e70'
           }
        }
     },
     yAxis: {
        labels: {
           style: {
              color: '#6e6e70'
           }
        }
     },
     plotOptions: {
        series: {
           shadow: true
        },
        candlestick: {
           lineColor: '#404048'
        },
        map: {
           shadow: false
        }
     },

     // Highstock specific
     navigator: {
        xAxis: {
           gridLineColor: '#D0D0D8'
        }
     },
     rangeSelector: {
        buttonTheme: {
           fill: 'white',
           stroke: '#C0C0C8',
           'stroke-width': 1,
           states: {
              select: {
                 fill: '#D0D0D8'
              }
           }
        }
     },
     scrollbar: {
        trackBorderColor: '#C0C0C8'
     },

     // General
     background2: '#E0E0E8'

  };

  // Apply the theme
  Highcharts.setOptions(Highcharts.theme);
  $('#contenidoGrafica').highcharts({
      chart: {
          type: 'bar'
      },
      title: {
          text: 'Edades de los contactos registrados'
      },
      subtitle: {

      },
      xAxis: {
          categories: nombre,
          title: {
              text: null
          }
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Edades',
              align: 'high'
          },
          labels: {
              overflow: 'justify'
          }
      },
      tooltip: {
          valueSuffix: ''
      },
      plotOptions: {
          bar: {
              dataLabels: {
                  enabled: true
              }
          }
      },
      legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: -40,
          y: 80,
          floating: true,
          borderWidth: 1,
          backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
          shadow: true
      },
      credits: {
          enabled: false
      },
      series: [{
         name: 'Edades',
        data:edad
          //data: [107, 31, 635, 203, 2,4,5,7,8,9,10,20,30,40]
          //data
      }, ]
  });

}
