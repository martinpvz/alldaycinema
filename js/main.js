
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


let editarPerfil = () => {
  let botones = document.getElementsByClassName("edit-image");
  for (let boton of botones) {
    boton.style.display = "block";
  }
  let perfiles = document.getElementsByClassName("profile");
  for (let perfil of perfiles) {
    perfil.href = "./editProfile.html"
    perfil.style.animation = "tilt-shaking 0.5s infinite";
  }
  let agregar = document.getElementById("add-profile");
  agregar.style.display = "none";
  document.getElementById("create-text").innerHTML = "¿Qué perfil deseas modificar?";
  document.getElementById("editarPerfil").innerHTML = "Cancelar";
  document.getElementById("editarPerfil").style.backgroundColor = "#ee2222";
  document.getElementById("editarPerfil").onclick = () => {
    let botones = document.getElementsByClassName("edit-image");
    for (let boton of botones) {
      boton.style.display = "none";
    }
    let perfiles = document.getElementsByClassName("profile");
    for (let perfil of perfiles) {
      perfil.href = "./mainPage.html"
      perfil.style.animation = "none";
    }
    let agregar = document.getElementById("add-profile");
    agregar.style.display = "block";
    document.getElementById("editarPerfil").innerHTML = "Editar perfiles";
    document.getElementById("create-text").innerHTML = "¿Quién eres?";
    document.getElementById("editarPerfil").style.backgroundColor = "#ee5622";
    document.getElementById("editarPerfil").onclick = editarPerfil;
  }
}

document.getElementById('perfil-main').onmouseover = () => {
  document.getElementById('controles-main').style.display = "inherit";
}
document.getElementById('controles-main').onmouseleave = () => {
  document.getElementById('controles-main').style.display = "none";
}

document.getElementById("search-main").onfocus = () => {
  document.getElementById("buscador-div").style.filter = "drop-shadow(0 0.4rem 0.25rem #ee6c4d)"
  console.log('hola')
}
document.getElementById("search-main").onblur = () => {
  document.getElementById("buscador-div").style.filter = "drop-shadow(0 0 0 white)"
  console.log('hola')
}

//MENSAJE DE ÉXITO DE REGISTRO
$.ajax({
  url: './backend/cuenta-registro.php',
  type: 'POST',
  success: function(response){
      console.log(response);
      let respuesta = JSON.parse(response);
      alert("registro exitoso");
  }
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