
$(document).ready(function () {
    //SE OCULTAN TODOS LOS CAMPOS DEL FORMULARIO
    $('#status-bar').hide();
    listarCatalogo();
    let edit = false; 
    let tipoElemento = "";
    hideForm();
    function hideForm(){
        $('#form-region').hide();
        $('#form-genre').hide();
        $('#form-clasification').hide();
        $('#form-year').hide();
        $('#form-title').hide();
        $('#form-duration').hide();
        $('#form-image').hide();
        $('#form-available').hide();
        $('#form-seasons').hide();
        $('#form-chapters').hide();
        $('#btn-agregar').hide();
    }
    
    //MUESTRA LOS CAMPOS CORRESPONDIENTES PARA AGREGAR UNA PELÍCULA
    $('#link-movies').click(function (e) {
        edit = false;
        resetForm();
        $('#btn-agregar').text("Agregar Película");
        tipoElemento= "Pelicula";
        e.preventDefault();
        $('#form-seasons').hide();
        $('#form-chapters').hide();
        $('#form-region').show();
        $('#form-genre').show();
        $('#form-clasification').show();
        $('#form-year').show();
        $('#form-title').show();
        $('#form-duration').show();
        $('#form-image').show();
        $('#form-available').show();
        $('#btn-agregar').show();
    });

    //MUESTRA LOS CAMPOS CORRESPONDIENTES PARA AGREGAR UNA SERIE
    $('#link-series').click(function (e) {
        edit = false;
        resetForm();
        $('#btn-agregar').text("Agregar Serie");
        tipoElemento= "Serie";
        e.preventDefault();
        $('#form-region').show();
        $('#form-genre').show();
        $('#form-clasification').show();
        $('#form-year').show();
        $('#form-title').show();
        $('#form-duration').hide();
        $('#form-image').show();
        $('#form-available').show();
        $('#form-title').show();
        $('#btn-agregar').show();
        $('#form-seasons').show();
        $('#form-chapters').show();
    });

    //FUNCIÓN QUE PERMITE EDITAR O AGREGAR SEGÚN SEA EL CASO
    $('#movies-form').submit(function (e) {
        e.preventDefault();
        if(edit === false)
        {
            if(tipoElemento === "Pelicula")
            {
                $.post('./backend/catalogue/catalogue-add.php', {
                    id: $('#form-id').val(),
                    title: $('#form-title').val(),
                    duration: $('#form-duration').val(),
                    image: $('#form-image').val(),
                    region: $('#form-region').val(),
                    genre: $('#form-genre').val(),
                    clasification: $('#form-clasification').val(),
                    year: $('#form-year').val(),
                    tipoElemento
                }, function (response) {
                    console.log(response);
                    let respuesta = JSON.parse(response);
                    console.log(respuesta);
                });
                
            }
            else
            {
                $.post('./backend/catalogue/catalogue-add.php', {
                    id: $('#form-id').val(),
                    title: $('#form-title').val(),
                    seasons: $('#form-seasons').val(),
                    chapters: $('#form-chapters').val(),
                    image: $('#form-image').val(),
                    region: $('#form-region').val(),
                    genre: $('#form-genre').val(),
                    clasification: $('#form-clasification').val(),
                    year: $('#form-year').val(),
                    tipoElemento
                }, function (response) {
                    //console.log(response);
                    let respuesta = JSON.parse(response);
                    console.log(respuesta);
                });
            }
            listarCatalogo();
        }
        else
        {
            if(tipoElemento === "Pelicula")
            {
                $.post('./backend/catalogue/catalogue-edit.php', {
                    id: $('#form-id').val(),
                    title: $('#form-title').val(),
                    duration: $('#form-duration').val(),
                    image: $('#form-image').val(),
                    region: $('#form-region').val(),
                    genre: $('#form-genre').val(),
                    clasification: $('#form-clasification').val(),
                    year: $('#form-year').val(),
                    available: $('#form-available').val(),
                    tipoElemento
                }, function (response) {
                    //console.log(response);
                    let respuesta = JSON.parse(response);
                    console.log(respuesta);
                });
            }
            else
            {
                $.post('./backend/catalogue/catalogue-edit.php', {
                    id: $('#form-id').val(),
                    title: $('#form-title').val(),
                    seasons: $('#form-seasons').val(),
                    chapters: $('#form-chapters').val(),
                    image: $('#form-image').val(),
                    region: $('#form-region').val(),
                    genre: $('#form-genre').val(),
                    clasification: $('#form-clasification').val(),
                    year: $('#form-year').val(),
                    available: $('#form-available').val(),
                    tipoElemento
                }, function (response) {
                    //console.log(response);
                    let respuesta = JSON.parse(response);
                    console.log(respuesta);
                });
            }
            listarCatalogo();
        }

    });

    //FUNCIÓN PARA LIMPIAR EL FORMULARIO
    function resetForm(){
        $("form select").each(function(){this.selectedIndex=0});
        $("form input[type=text]").each(function(){this.value=""});
    }
    //EVENTO CLICK DEL BOTON EDITAR
    $(document).on('click', '#btn-editar', function () {
        let elemento = $(this)[0].parentElement.parentElement;
        //console.log(elemento);
        let id = $(elemento).attr('contenidoId');
        let tipo = $(elemento).attr('contenidoTipo');
        //console.log(id);
        //console.log(tipo);
        $.post('./backend/catalogue/catalogue-single.php', {
            id,
            tipo
        }, function (response) {
            //console.log(response);
            let contenido = JSON.parse(response);
            //console.log(contenido);
            if(tipo == 'Pelicula')
            {
                $('#btn-agregar').text("Editar Película");
                tipoElemento = 'Pelicula';
                $("#form-chapters").hide();
                $("#form-seasons").hide(); 
                $('#form-region').show();
                $('#form-genre').show();
                $('#form-clasification').show();
                $('#form-year').show();
                $('#form-title').show();
                $('#form-duration').show();
                $('#form-image').show();
                $('#form-available').show();
                $('#btn-agregar').show();    
                $('#form-id').val(contenido.id);          
                $('#form-region').val(contenido.region);
                $('#form-genre').val(contenido.genero);
                $('#form-clasification').val(contenido.clasificacion);
                $('#form-year').val(contenido.lanzamiento);
                $('#form-title').val(contenido.titulo);
                $('#form-duration').val(contenido.duracion);
                $('#form-image').val(contenido.imagen);
                $('#form-available').val(contenido.eliminado);
            }
            else 
            {
                tipoElemento = 'Serie';
                $('#btn-agregar').text("Editar Serie");
                $("#form-duration").hide(); 
                $('#form-region').show();
                $('#form-genre').show();
                $('#form-clasification').show();
                $('#form-year').show();
                $('#form-title').show();
                $('#form-duration').hide();
                $('#form-image').show();
                $('#form-available').show();
                $('#form-title').show();
                $('#btn-agregar').show();
                $('#form-seasons').show();
                $('#form-chapters').show(); 
                $('#form-id').val(contenido.id);           
                $('#form-region').val(contenido.region);
                $('#form-genre').val(contenido.genero);
                $('#form-clasification').val(contenido.clasificacion);
                $('#form-year').val(contenido.lanzamiento);
                $('#form-title').val(contenido.titulo);
                $('#form-seasons').val(contenido.temporadas);
                $('#form-chapters').val(contenido.capitulos);
                $('#form-image').val(contenido.imagen);
                $('#form-available').val(contenido.eliminado);

            } ;
            edit = true;
        });

    });
    //EVENTO CLICK DEL BOTON ELIMINAR
    $(document).on('click', '#btn-eliminar', function () {
        let elemento = $(this)[0].parentElement.parentElement;
        console.log(elemento);
        let id = $(elemento).attr('contenidoId');
        let tipo = $(elemento).attr('contenidoTipo');
        console.log(id);
        console.log(tipo);
        if(confirm('¿Está seguro de querer eliminar este elemento?')){
            $.post('./backend/catalogue/catalogue-delete.php', {
                id,
                tipo
            }, function (response) {
                //console.log(response);
                let contenido = JSON.parse(response);
                console.log(contenido); 
            });
            listarCatalogo();
        }
    });

    function listarCatalogo() {
        $.ajax({
            url: './backend/catalogue/catalogue-list.php',
            type: 'GET',
            success: function (response) {
                //console.log(response);
                let peliculas = JSON.parse(response);
                
                if (Object.keys(peliculas).length > 0) {
                    let template = '';
                    peliculas.forEach(pelicula => {
                        let disponible = "Sí";
                        if(pelicula.eliminado == 1)
                        {
                            disponible = "No";
                        }
                        let descripcion = '';
                        descripcion += '<li>Tipo: ' + pelicula.tipo + '</li>';
                        descripcion += '<li>Región: ' + pelicula.region + '</li>';
                        descripcion += '<li>Clasificación: ' + pelicula.clasificacion + '</li>';
                        descripcion += '<li>Lanzamiento: ' + pelicula.lanzamiento + '</li>';
                        descripcion += '<li>Género: ' + pelicula.genero + '</li>';
                        descripcion += '<li>Disponible: ' + disponible + '</li>';
                        descripcion += '<li>Ruta imagen: ' + pelicula.imagen + '</li>';

                        template += `
                            <tr contenidoId="${pelicula.id}" contenidoTipo="${pelicula.tipo}">
                                <td>${pelicula.id}</td>
                                <td>${pelicula.titulo}</td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class=" btn btn-primary" id="btn-editar">
                                        Editar
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" id="btn-eliminar">
                                    Eliminar
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

