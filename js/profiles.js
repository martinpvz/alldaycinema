$(document).ready(function(){
  $.ajax({
    url: './backend/profile/profile-list.php',
    type: 'GET',
    // data: {cuenta:"2"},
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
              <a href="./mainPage.php?profile=${perfil.idperfil}" class="profile">
                <img src="${perfil.rutaImagen}" alt="Foto perfil" class="profile-image">
                <p class="profile-name" id="${perfil.idperfil}">${perfil.nombre}</p>
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

    $.ajax({
      url: './backend/profile/profile-listNumber.php',
      type: 'GET',
      // data: {cuenta:"2"},
      success: function(response) {
          const perfiles = JSON.parse(response);
          // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
          if(Object.keys(perfiles).length > 0) {
              // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
              perfilesNum = perfiles["COUNT(*)"];
              console.log("Numero de perfiles: "+ perfiles["COUNT(*)"]);
              if (perfilesNum >= 7) {
                document.getElementById("add-profile").style.display = "none";
              } 
              if (perfilesNum == 2) {
                document.getElementById("profiles-list").style.width = "50%";
              } else if (perfilesNum == 3) {
                document.getElementById("profiles-list").style.width = "60%";
              } else if (perfilesNum == 4) {
                document.getElementById("profiles-list").style.width = "70%";
              } else if (perfilesNum >= 5) {
                document.getElementById("profiles-list").style.width = "90%";
              }
              
          }
        }
      });

});


let editarPerfil = () => {
  // var id = $("p").attr("id");
  let botones = document.getElementsByClassName("edit-image");
  for (let boton of botones) {
    boton.style.display = "block";
  }
  let perfiles = document.getElementsByClassName("profile");
  let perfilesId = document.getElementsByClassName("profile-name");
  let id = []
  for (let perfil of perfilesId) {
    id.push($(perfil).attr("id"));
  }
  console.log(id)
  i = 0;
  for (let perfil of perfiles) {
    // console.log(id)
    perfil.href = `./editProfile.php?profile=${id[i]}`;
    // perfil.href = `./editProfile.php`;
    perfil.style.animation = "tilt-shaking 0.5s infinite";
    i += 1;
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
    let perfilesId = document.getElementsByClassName("profile-name");
    let id = []
    for (let perfil of perfilesId) {
      id.push($(perfil).attr("id"));
    }
    console.log(id)
    i = 0;
    for (let perfil of perfiles) {
      perfil.href = `./mainPage.php?profile=${id[i]}`;
      perfil.style.animation = "none";
      i += 1;
    }
    let agregar = document.getElementById("add-profile");
    agregar.style.display = "block";
    document.getElementById("editarPerfil").innerHTML = "Editar perfiles";
    document.getElementById("create-text").innerHTML = "¿Quién eres?";
    document.getElementById("editarPerfil").style.backgroundColor = "#ee5622";
    document.getElementById("editarPerfil").onclick = editarPerfil;
  }
}
