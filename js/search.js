$(document).ready(function(){
  $('#search-main').keyup(function() {
      if($('#search-main').val()) {
          document.getElementById("resultados").style.display = "block";
          document.getElementById("search-main").onblur = () => {
            document.getElementById("buscador-div").style.filter = "drop-shadow(0 0 0 white)"
            document.getElementById("resultados").style.display = "none";
          }
          let search = $('#search-main').val();
          console.log(search)
          $.ajax({
              url: './backend/catalogue/catalogue-search.php?search='+$('#search').val(),
              data: {search},
              type: 'GET',
              success: function (response) {
                  if(!response.error) {
                      // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                      const resultados = JSON.parse(response);
                      console.log(resultados)
                      // resultadosTrim = [];
                      // x = 0;
                      // while(x < 8) {
                      //   resultadosTrim.push(resultados[x])
                      //   x += 1;
                      // }
                      
                      // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                      if(Object.keys(resultados).length > 0) {
                          // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                          let template = '';
                          let template_bar = '';

                          resultados.forEach(resultado => {
                              template += `
                              <a href="#" class="resultado">
                              <img class="imagen-resultado" src=".${resultado.imagen}" alt="">
                              <div class="info-resultado">
                                <p class="nombre-resultado">${resultado.titulo}</p>
                                <p class="anio-resultado">(${resultado.lanzamiento})</p>
                              </div>
                              </a>
                              `;
                          });
                          $('#resultados').html(template);    
                      }
                      else {
                        template = `
                        <a href="#" class="resultado">
                          <p class="nombre-resultado sin-resultados">Sin resultados</p>
                        </a>`;
                        $('#resultados').html(template); 
                      }
                  }
              }
          });
      }
      else {
        template = `
        <a href="#" class="resultado">
          <p class="nombre-resultado">Sin resultados</p>
        </a>`;
        $('#resultados').html(template); 
      }
  });


});
