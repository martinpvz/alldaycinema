
/*Dropdown Menu*/
$('.dropdown').click(function () {
  $(this).attr('tabindex', 1).focus();
  $(this).toggleClass('active');
  $(this).find('.dropdown-menu').slideToggle(300);
});
$('.dropdown').focusout(function () {
  $(this).removeClass('active');
  $(this).find('.dropdown-menu').slideUp(300);
});
$('.dropdown .dropdown-menu li').click(function () {
  $(this).parents('.dropdown').find('span').text($(this).text());
  $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
});
/*End Dropdown Menu*/


$('.dropdown-menu li').click(function () {
var input = '<strong>' + $(this).parents('.dropdown').find('input').val() + '</strong>',
msg = '<span class="msg">Hidden input value: ';
$('.msg').html(msg + input + '</span>');
}); 


document.getElementById("peliculas-selector").onclick = () => {
    localStorage.setItem("valor","Movies");
}

document.getElementById("series-selector").onclick = () => {
    localStorage.setItem("valor","Series");
}

document.getElementById("accion-card").onclick = () => {
  localStorage.setItem("valor","Acción");
}

document.getElementById("ciencia-card").onclick = () => {
  localStorage.setItem("valor","Ciencia Ficción");
}

document.getElementById("drama-card").onclick = () => {
  localStorage.setItem("valor","Drama");
}

document.getElementById("misterio-card").onclick = () => {
  localStorage.setItem("valor","Suspenso");
}


function imprimirPeliculas(numero, posicion) {
  $.ajax({
    url: './backend/catalogue/catalogue-list.php',
    type: 'GET',
    data: {type: numero},
    success: function(response) {
        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
        console.log(response);
        const peliculas = JSON.parse(response);
        peliculasTrim = [];
        x = 0;
        while (x < 5) {
          peliculasTrim.push(peliculas[x]);
          x += 1;
        }
        console.log(peliculasTrim)
        
    
        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
        if(Object.keys(peliculasTrim).length > 0) {
            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
            let template = '';
            // console.log(peliculas);
            peliculasTrim.forEach(pelicula => {
              // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
              // console.log(pelicula.rutaPortada)
              template += `
              <div class="carousel2-item">
                <img src=".${pelicula.rutaPortada}" alt="Foto de pelicula" class="carousel-item__imagen">
                <div class="carousel-item__details">
                  <div>
                    <img src="./img/play-icon.png" alt="Boton de play">
                    <img src="./img/plus-icon.png" alt="Boton de plus">
                  </div>
                  <p class="carousel-item__details--title">${pelicula.titulo}</p>
                  <p class="carousel-item__details--subtitle">${pelicula.lanzamiento} ${pelicula.clasificacion} ${pelicula.duracion}</p>
                </div>
              </div>
              `;
          });
          // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
          $(posicion).html(template);
        }
      }
    });
}
imprimirPeliculas(2, '#carousel-accion');
imprimirPeliculas(3, '#carousel-comedy');
imprimirPeliculas(6, '#carousel-musical');
imprimirPeliculas(4, '#carousel-fantasy');

document.getElementById('perfil-main').onmouseover = () => {
  document.getElementById('controles-main').style.display = "inherit";
}
document.getElementById('controles-main').onmouseleave = () => {
  document.getElementById('controles-main').style.display = "none";
}
