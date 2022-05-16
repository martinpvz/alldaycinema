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
          document.getElementById("nombre-perfil").placeholder = perfiles[0].perfil;
          document.getElementById("age").innerText = perfiles[0].perfil;
          document.getElementById("image").src = perfiles[0].imagen;
      }
    }
  });