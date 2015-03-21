$(function() {
  //Select Marca
  var inputMarca = $("#inputMarca");
  var inputCategoriaId = $("#inputCategoriaId");

  inputMarca.change(function(event){
    //$("#inputMarcaId").val( inputMarca.val() );
    //$("#formData").submit();
    //alert(inputMarca.val());
    //window.location.replace("productos/filtrarXmarca/" + inputMarca.val() );
    window.location.replace( sConfig.url + "productos/filtrarXmarca/" + inputMarca.val() + "/" + inputCategoriaId.val() );
  });

  //Slider Range
  var inputMinInicial = $("#inputMinInicial");
  var inputMaxInicial = $("#inputMaxInicial");
  var inputMin = $("#inputPrecioMin");
  var inputMax = $("#inputPrecioMax");
  var sliderUI = $("#slider-range");

  var minimoInicial = parseInt(inputMinInicial.val());
  var maximoInicial = parseInt(inputMaxInicial.val());
  var minimo = parseInt(inputMin.val());
  var maximo = parseInt(inputMax.val());

  sliderUI.slider({
    range: true,
    min: minimoInicial,
    max: maximoInicial,
    values: [minimo, maximo],
    slide: function( event, ui ) 
    {
      $( "#amount-min" ).text( "$" + ui.values[ 0 ] );
      $( "#amount-max" ).text( "$" + ui.values[ 1 ] );
      
      inputMinInicial.val( ui.values[ 0 ] );
      inputMaxInicial.val( ui.values[ 1 ] );
    },
    change: function(event, ui)
    {
      //alert("Valor Min: "+sliderUI.slider('values')[0]+" valor max: "+sliderUI.slider('values')[1]);
      window.location.replace(sConfig.url + "productos/filtrarXprecio/" + sliderUI.slider('values')[0] +"/"+sliderUI.slider('values')[1]+"/"+inputCategoriaId.val());      
      //$('#formPriceRange').submit();
    }
  });

  //alert($("#inputMin").val() + " je");

  //Valores iniciales
  $( "#amount-min" ).text( "$" + $( "#slider-range" ).slider( "values", 0 ) );
  $( "#amount-max" ).text( "$" + $( "#slider-range" ).slider( "values", 1 ) );

});