function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
  results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var profile = getParameterByName('profile');
console.log(profile);
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
          document.getElementById("user").value = perfiles[0].nombre;
          document.getElementById("age").value = perfiles[0].edad;
          document.getElementById("image").value = perfiles[0].rutaImagen;
          document.getElementById("image-edit").src = perfiles[0].rutaImagen;
          document.getElementById("idaccount").value = perfiles[0].idcuenta;
          document.getElementById("idprofile").value = perfiles[0].idperfil;
      }
    }
  });

document.getElementById("eliminar-perfil").onclick = () => {
  id = document.getElementById("idprofile").value;
  console.log(id)
  $.ajax({
    url: './backend/profile/profile-delete.php',
    type: 'POST',
    data: {id: id},
    success: function(response) {
        console.log(response);
        location.href = './profiles.php';
      }
    });
}
