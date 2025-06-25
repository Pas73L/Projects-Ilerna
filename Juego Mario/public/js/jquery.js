$(document).ready(function() { // Espera a que cargue la pagina para poder ejecutar el codigo de js
  $('#reset').hide(); // Ocultara el boton Replantar 
let alturaInicial = 0; // Creamos esta variable para guardar el valor inicial de la altura del tallo y asi poder usar la funcion
                       //"Replantar" correctamente

//----------------------------------------FUNCION AL SELEECIONAR EN EL DESPLEGABLE---------------------------------------------------------------*/
$('#plantas').on('change', function() { // Cada vez que seleccionemos en el desplegable realizara los cambios indicados dentro de la funcion
let numPlantas = parseInt($('#plantas').val()); // Recoge el valor seleccionado en el desplegable
 $("#main").empty(); // Limpia los items creados dentro en el div #main cada vez que se selecciona en el desplegable
let mainDiv = $('#main'); // Creamos la variable que esta relacionada con el div #main del html
for (let i = 0; i < numPlantas; i++) { // Bucle que crea tantos conetnedores de plantas como hayamos seleccionado en el desplegable
let nuevaPlanta = $('<div class="contenedor">' + //Creamos la variable que contemndra toda la estructura de divs
'<div class="maceta">' +
'<div class="numero">' + (i + 1) + '</div>' + // Agrega el nº de cada
'<div class="tallo">' +
'<div class="flor"></div>' +
'</div>' +
'</div>' +
'</div>');
mainDiv.append(nuevaPlanta.hide());//Cada vez que termina un ciclo del for va agregando al html los contenedores de las plantas
nuevaPlanta.slideDown(50) // Creo un efecto para que la aparicion de las plantas sea mas vistosa


}

//----------------------------------------FUNCION DE CRECIMIENTO DE LAS PLANTAS---------------------------------------------------------------*/

    function crecerPlanta() {
      $('#crecer').hide(); //Ocultara el boton de Iniciar nada mas sea pulsado 
      $('#plantas').hide(); // Ocultara el desplegable 
      let ordenLlegadaTallos = []; // Creo array para las posiciones de las plantas seleccionadas
      let tallosTerminados = 0; // Variable para saber las plantas que han llegado a la meta

      $('.contenedor').each(function(i) { // Selecciona cada contenedor que se haya creado previamente - "i" representa el el indice del elemento actual
        let alturaContenedor = $(this).height();// var que recoge el valor de la altura del .contenedor
        let alturaMaceta = $(this).find(".maceta").height();// var que recoge el valor de la altura del .maceta que se encuentra dentro del div .contenedor por el metodo find
        let alturaTallo = $(this).find('.tallo').height();// var que recoge el valor de la altura del .tallo que se encuentra dentro del div .contenedor por el metodo find
        let alturaFlor = $(this).find(".flor").height();// var que recoge el valor de la altura del .flor que se encuentra dentro del div .contenedor por el metodo find
  
        alturaInicial = alturaTallo; // Añadimos el valor de la alturaTallo al valor creado alturaInicial para ser utilizado como anteriormente he comentado

        let meta = alturaContenedor - alturaMaceta + alturaTallo - alturaFlor - 10 ; //Calculo para fijar donde tiene que parar la animacion del crecimiento
                                                                                     //Ajusto con el valor 10 para que justo paren en determinado punto de la imagen
        let valorCrecimiento = Math.floor(Math.random() * 10) + 1; // Crecimiento de forma aleatoria entre 1 y 10
        let velocidadAnimacion = valorCrecimiento * 300; // Velocidad de crecimiento ajustado con 300 para que sea mas visible el recorrido
  


        $(this).find('.tallo').animate({ height: meta }, velocidadAnimacion, function() { // Animacion que se basa en llegar hasta cierto limite indicado(meta) 
          ordenLlegadaTallos.push(i); // Registra el orden en que cada tallo alcanza su meta
        tallosTerminados++; // Agrega en +1 con cada planta que haya termiando el recorddio


        // Si coincide el valor de las plantas que han terminaod con las la cantidad de contenedores que hay en el main generara la tabla
        if (tallosTerminados === $(".contenedor").length) {
            setTimeout(function() { // Es una funcion que sirve para programar la ejecucion en un tiempo en especifico
              generarTablaOrden(ordenLlegadaTallos);
            }, velocidadAnimacion - 500); //Genera la tabla al poco tiempo de que la ultima planta llegue a meta
          }
        });
      });
  
      setTimeout(function() {
        $('#reset').show(); // Mostrara el boton Replantar pasado 3s al haber pulsado el boton iniciar
      }, 3000);
    }
  //----------------------------------------FUNCION DE REINICIAR LA CARRERA---------------------------------------------------------------*/
    function Replantar() {
      //Las acciones de esta funcion sera (1)Reiniciar la animacion hasta el valor inicial (2)Mostrar de nuevo los botones 
      //(3) Ocultar el boton Replantar y la tabla ranking junto con el gif
      $('.contenedor').each(function() {
        $(this)
          .find('.tallo')
          .animate({ height: alturaInicial }, function() {//(1)
            $('#crecer').show();//(2)
            $('#plantas').show();//(2)
            $('#tablaRanking').hide();//(3)
            $("#gif").hide();//(3)
            $('#reset').hide();//(3)

          });
      });
    }
    $('#reset').on('click', Replantar);// Vuelve al tamaño inicial y se podra accionar de nuevo el boton Iniciar al pulsar
    $('#crecer').on('click', crecerPlanta);// Las plantas comenzaran a crecer al pulsar

        function generarTablaOrden(ordenLlegadaTallos) { // Genero una tabla en el orden en el que han llegado al techo
            let tabla = '<table><tr><th>PLANTA</th><th>PUESTO</th></tr>';
            for (let i = 0; i < ordenLlegadaTallos.length; i++) { // Generara tandos <td> como plantas se hayan registrado 
              if (i === 0) {// El primer <td> que se genere tendra el identificativo de la estrella como ganadora
                //Mostrara la planta con su respectiva posicion gracias al indice(i) + al lado la posicion relacionada 
                tabla += `<tr><td id="favorita" >${ordenLlegadaTallos[i] + 1}<img src="public/img/estrella.png"></td><td>${i + 1 +"º"}</td></tr>`;
              }else{// Sino es el primer <td> no tendra la insignia
                tabla += `<tr><td>${ordenLlegadaTallos[i] + 1}</td><td>${i + 1 +"º"}</td></td></tr>`;
              }
            }
            tabla += '</table>';
            $('#tablaRanking').html(tabla); // Insertar la tabla con todos lo valores que se han ido introduciendo en el div #tablaRanking
            $('#tablaRanking').show(); // Muestro la tabla con el ranking ya que se mantenia oculta por la hoja de estilo
            $("#gif").show(); // Muestro gif ya se mantenia oculto por la hoja de estilo

        }
});
});