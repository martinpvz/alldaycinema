function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
  results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var profile = getParameterByName('profile');
console.log(profile)
$.ajax({
  url: './backend/profile/profile-searchById.php',
  type: 'GET',
  data: {search: profile},
  success: function(response) {
      // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
      console.log(response);
      const perfiles = JSON.parse(response);
      console.log(perfiles);
      
  
      // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
      if(Object.keys(perfiles).length > 0) {
          // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
          document.getElementById("nombre-perfil").innerText = perfiles[0].nombre;
          document.getElementById("imagen-perfil").src = perfiles[0].rutaImagen;
      }
    }
  });

$.ajax({
  url: './backend/catalogue/catalogue-list.php',
  type: 'GET',
  data: {type: localStorage.getItem("valor")},
  success: function(response) {
      // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
      console.log(response);
      const peliculas = JSON.parse(response);
      console.log(peliculas);
      
  
      // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
      if(Object.keys(peliculas).length > 0) {
          // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
          let template = '';
          // console.log(peliculas);
          peliculas.forEach(pelicula => {
            // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
            console.log(pelicula.rutaPortada)
            template += `
            <a href="#" class="list-item">
              <img src=".${pelicula.rutaPortada}" alt="Foto de pelicula">
            </a>
            `;
        });
        // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
        $('#list-container').html(template);
      }
    }
  });

let valor = localStorage.getItem("valor");
document.getElementById("title-list").innerText = `${valor}`;

document.getElementById("peliculas-selector").onclick = () => {
  localStorage.setItem("valor","Movies");
  // location.reload();
  document.getElementById("peliculas-selector").href=`./list.php?profile=${profile}`;
}

document.getElementById("series-selector").onclick = () => {
  localStorage.setItem("valor","Series");
  // location.reload();
  location.href=`./list.php?profile=${profile}`;
}

document.getElementById("home-list").onclick = () => {
  document.getElementById("home-list").href=`./mainPage.php?profile=${profile}`;
}
