$(document).ready(function() {

  console.log("documento listo");

$( ".linkEliminar" ).click(function( eventObject ) {
    eventObject.preventDefault();
    var elem = $(this);
    console.log(elem.context.id);
    var id=elem.context.id;
    BootstrapDialog.confirm('Realmente deseas eliminar?', function(result){

            if(result) {
              console.log("usted a confirmado");
              console.log("eliminar->>"+elem.context.id);
              eliminar(id);
              
                //confirma


            }
        });

});

$('#example').DataTable();
});

function eliminar(id){
  $.ajax({
      // En data puedes utilizar un objeto JSON, un array o un query string
       data: {"id":id},
      //Cambiar a type: POST si necesario
      type: "POST",
      // Formato de datos que se espera en la respuesta
      dataType: "json",
      // URL a la que se enviará la solicitud Ajax
      url: "controlers/EliminarContacto.php",
  })
   .done(function( data, textStatus, jqXHR ) {
     console.log(data);
     if(data[0]==="true"){
        window.location="AdministrarContactos.php";

     }
     else{
      $(".alerta2").css("display", "block");
      $(".alerta2").fadeOut(4000, function() {});
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
}
