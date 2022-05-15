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
              <a href="./mainPage.html" class="profile">
                <img src="${perfil.rutaImagen}" alt="Foto perfil" class="profile-image">
                <p class="profile-name">${perfil.nombre}</p>
                <img src="./img/edit.png" alt="Editar perfil" class="edit-image">
              </a>
              `;
          });
          template += `
          <a href="./createProfile.html" class="add-profile" id="add-profile">
            <img src="./img/add.png" alt="Añadir perfil">
          </a>
          `;
          // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
          $('#profiles-list').html(template);
        }
      }
    });

});