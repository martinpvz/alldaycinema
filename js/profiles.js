$(document).ready(function(){
  $.ajax({
    url: './backend/profile/profile-list.php',
    type: 'GET',
    data: {cuenta:"2"},
    success: function(response) {
        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
        console.log(response);
        const perfiles = JSON.parse(response);
        console.log(perfiles);
        
    
        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
        if(Object.keys(perfiles).length > 0) {
            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
            let template = '';
            console.log(perfiles);
            perfiles.forEach(perfil => {
              // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
              template += `
              <a href="./mainPage.php" class="profile">
                <img src="${perfil.rutaImagen}" alt="Foto perfil" class="profile-image">
                <p class="profile-name">${perfil.nombre}</p>
                <img src="./img/edit.png" alt="Editar perfil" class="edit-image">
              </a>
              `;
          });
          template += `
          <a href="./createProfile.php" class="add-profile" id="add-profile">
            <img src="./img/add.png" alt="Añadir perfil">
          </a>
          `;
          // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
          $('#profiles-list').html(template);
        }
      }
    });

});

let editarPerfil = () => {
  let botones = document.getElementsByClassName("edit-image");
  for (let boton of botones) {
    boton.style.display = "block";
  }
  let perfiles = document.getElementsByClassName("profile");
  for (let perfil of perfiles) {
    perfil.href = "./editProfile.php"
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
      perfil.href = "./mainPage.php"
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


document.getElementById("search-main").onfocus = () => {
  document.getElementById("buscador-div").style.filter = "drop-shadow(0 0.4rem 0.25rem #ee6c4d)"
  console.log('hola')
}
document.getElementById("search-main").onblur = () => {
  document.getElementById("buscador-div").style.filter = "drop-shadow(0 0 0 white)"
  console.log('hola')
}