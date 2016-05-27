$(document).ready(function() {

  $( "#inputNombre" ).keypress(function(e) {
      key = e.keyCode ? e.keyCode : e.which;
      patron =/[A-Za-z\sÑñ]/;
      te = String.fromCharCode(key);
      return patron.test(te);

    });
    $( "#inputEdad" ).keypress(function(e) {
      key = e.keyCode ? e.keyCode : e.which;
        if(key>47 && key<58){
          return true;
        }
        else{
          return false;
        }
    });
    $( "#inputCP" ).keypress(function(e) {
      key = e.keyCode ? e.keyCode : e.which;
        if(key>47 && key<58){
          return true;
        }
        else{
          return false;
        }
    });
    $( "#inputTel" ).keypress(function(e) {
      key = e.keyCode ? e.keyCode : e.which;
        if(key>47 && key<58){
          return true;
        }
        else{
          return false;
        }
    });

  $('.formAgregar').submit(function(e) {
     e.preventDefault();
       $(".formAgregar").serializeArray();

       var nombre = $("#inputNombre").val();
       var dir=$("#inputDir").val();
       var tel=$("#inputTel").val();
       var email=$("#inputEmail").val();
       var cp=$("#inputCP").val();
       var edad=$("#inputEdad").val();
       var gustos=$("#inputGustos").val();

       var expreg =/^[A-Za-záéíóúñ]{2,}(([\s]{1,3})*[A-Za-záéíóúñ]{2,})*$/;

       if(expreg.test(nombre)) {
             $("#inputNombre").closest('.form-group').removeClass('has-error');

       }
        else{
             $("#inputNombre").closest('.form-group').addClass('has-error');
         }
         guardarContacto(nombre,dir,tel,email,cp,edad,gustos);
         console.log('esto se debe imprimir despues!!!');

        return false;
   });

});

function guardarContacto(nombre,dir,tel,email,cp,edad,gustos){
  $.ajax({
      // En data puedes utilizar un objeto JSON, un array o un query string
     //  data: {"noControl":control,"nombre":numero},
       data: {"nombre":nombre,"dir":dir,"tel":tel,"email":email,"cp":cp,"edad":edad,"gustos":gustos},
      //Cambiar a type: POST si necesario
      type: "POST",
      // Formato de datos que se espera en la respuesta
      dataType: "json",
      // URL a la que se enviará la solicitud Ajax
      url: "controlers/AgregarContacto.php",
  })
   .done(function( data, textStatus, jqXHR ) {
     console.log(data);
     if(data[0]==="true"){
        $(".alerta1").css("display", "block");
        $(".alerta1").fadeOut(4000, function() {

				});
        // $(".alerta1").css("display", "none");
        limpiar();
     }
     else{
      $(".alerta2").css("display", "block");
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


function limpiar(){
    $(':input','#agregarForm')
    .removeAttr('checked')
    .removeAttr('selected')
    .not(':button, :submit, :reset, :hidden, :radio, :checkbox')
    .val('');
    $(":input").closest('.form-group').removeClass('has-error');
}
