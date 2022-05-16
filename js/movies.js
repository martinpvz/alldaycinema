
$(document).ready(function () {
    listarCatalogo();
    let edit = false;
    $('#movies-form').submit(function (e) {
        e.preventDefault();
        console.log("entro a funcion");
        let url = edit === false ? './backend/catalogue/catalogue-add.php' : './backend/catalogue/catalogue-edit.php';
        $.post(url, {
            idMovies: $('#form-id').val(),
            title: $('#form-title').val(),
            duration: $('#form-duration').val(),
            image: $('#form-image').val(),
            region: $('#form-region').val(),
            genre: $('#form-genre').val(),
            clasification: $('#form-clasification').val(),
            year: $('#form-year').val()
        }, function (response) {
            let respuesta = JSON.parse(response);
            console.log(respuesta);
        });
    });

    $(document).on('click', '#btn-editar', function () {
        let elemento = $(this)[0].parentElement.parentElement;
        console.log(elemento);
        let id = $(elemento).attr('contenidoId');
        let tipo = $(elemento).attr('contenidoTipo');
        console.log(id);
        console.log(tipo);
        $.post('./backend/catalogue/catalogue-single.php', {
            id,
            tipo
        }, function (response) {
            console.log(response);
            let contenido = JSON.parse(response);
            console.log(contenido);
            if(tipo == 'Pelicula')
            {
                $("#form-chapters").hide();
                $("#form-seasons").hide();               
                $('#form-region').val(contenido.region);
                $('#form-genre').val(contenido.genero);
                $('#form-clasification').val(contenido.clasificacion);
                $('#form-year').val(contenido.lanzamiento);
                $('#form-title').val(contenido.titulo);
                $('#form-duration').val(contenido.duracion);
                $('#form-image').val(contenido.imagen);
                $('#form-available').val(contenido.eliminado);
                console.log(contenido);
            }
            else 
            {
                $("#form-duration").hide();             
                $('#form-region').val(contenido.region);
                $('#form-genre').val(contenido.genero);
                $('#form-clasification').val(contenido.clasificacion);
                $('#form-year').val(contenido.lanzamiento);
                $('#form-title').val(contenido.titulo);
                $('#form-seasons').val(contenido.temporadas);
                $('#form-chapters').val(contenido.capitulos);
                $('#form-image').val(contenido.imagen);
                $('#form-available').val(contenido.eliminado);
                console.log(contenido);
            } ;
            edit = true;
        });
        $("#form-chapters").show();
        $("#form-seasons").show();
        $("#form-duration").show();
    });

    function listarCatalogo() {
        $.ajax({
            url: './backend/catalogue/catalogue-list.php',
            type: 'GET',
            success: function (response) {
                console.log(response);
                let peliculas = JSON.parse(response);
                
                if (Object.keys(peliculas).length > 0) {
                    let template = '';
                    peliculas.forEach(pelicula => {

                        let descripcion = '';
                        descripcion += '<li>Tipo: ' + pelicula.tipo + '</li>';
                        descripcion += '<li>Región: ' + pelicula.region + '</li>';
                        descripcion += '<li>Clasificación: ' + pelicula.clasificacion + '</li>';
                        descripcion += '<li>Lanzamiento: ' + pelicula.lanzamiento + '</li>';
                        descripcion += '<li>Género: ' + pelicula.genero + '</li>';
                        descripcion += '<li>Disponible: ' + pelicula.eliminado + '</li>';
                        descripcion += '<li>Ruta imagen: ' + pelicula.imagen + '</li>';

                        template += `
                            <tr contenidoId="${pelicula.id}" contenidoTipo="${pelicula.tipo}">
                                <td>${pelicula.id}</td>
                                <td>
                                    <a href="#" class="">${pelicula.titulo}</a>
                                </td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" id="btn-editar">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#peliculas').html(template);
                }
            }
        });
        console.log("prueba");
    }
});

