function plantilla(string) {
    let template_bar = '';
    template_bar += `
    <li style="list-style: none;">Estatus:</li>
    <li style="list-style: none;">${string}</li>
    `;
    $('#product-result').show();
    $('#container').html(template_bar);
}

$(document).ready(function () {
    $('#product-result').hide();
    let edit = false;
    listarProductos();
    $('#search').keyup(function (e) {
        let search = $('#search').val();
        $.ajax({
            url: './backend/product-search.php',
            type: 'GET',
            data: {
                search
            },
            success: function (response) {
                let productos = JSON.parse(response);
                if (Object.keys(productos).length > 0) {
                    let template = '';
                    let template_bar = '';
                    productos.forEach(producto => {

                        let descripcion = '';
                        descripcion += '<li>marca: ' + producto.marca + '</li>';
                        descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                        descripcion += '<li>precio: ' + producto.precio + '</li>';
                        descripcion += '<li>detalles: ' + producto.detalles + '</li>';
                        descripcion += '<li>unidades: ' + producto.unidades + '</li>';

                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                        template_bar += `
                        <li>${producto.nombre}</il>
                    `;
                    });
                    $('#product-result').show();
                    $('#container').html(template_bar);
                    $('#products').html(template);
                }
            }
        })
    })

    $("#nombre").focusout(function () {
        $('#product-result').hide();
        let search = $('#nombre').val();
        console.log(search);
        $.ajax({
            url: './backend/product-unique.php',
            type: 'GET',
            data: {
                search
            },
            success: function (response) {
                let respuesta = JSON.parse(response);
                console.log(respuesta);

                let template_bar = '';
                if (Object.keys(respuesta).length > 0) {
                    template_bar += `
                                <li style="list-style: none;">Estatus: ${respuesta.estatus}</li>
                                <li style="list-style: none;">${respuesta.mensaje}</li>
                            `;
                    $('#product-result').show();
                    $('#container').html(template_bar);
                } else {
                    if (search.length == 0 || search.length > 100) {
                        plantilla('<p>El NOMBRE no puede quedar vacío.</p><p>El NOMBRE no puede exceder los 100 caracteres.</p>');
                    } else {
                        plantilla('<p>La información capturada es correcta<p>');
                    }
                }
            }
        })
    });

    $("#marca").focusout(function () {
        $('#product-result').hide();
        let marca = $('#marca').val();
        if (marca.length == 0 || marca.length > 25) {
            plantilla('<p>La MARCA no puede quedar vacía.</p><p>La MARCA no puede exceder los 25 caracteres.</p>');
        } else {
            plantilla('<p>La información capturada es correcta<p>');
        }
    });

    $("#modelo").focusout(function () {
        $('#product-result').hide();
        let modelo = $('#modelo').val();
        if (modelo.length == 0 || modelo.length > 25) {
            plantilla('<p>El MODELO no puede quedar vacío.</p><p>El MODELO no puede exceder los 25 caracteres.</p>');
        } else {
            plantilla('<p>La información capturada es correcta<p>');
        }
    });

    $("#unidades").focusout(function () {
        $('#product-result').hide();
        let unidades = $('#unidades').val();
        if (unidades.length == 0 || isNaN(parseInt(unidades)) || unidades < 1 || unidades % 1 !== 0) {
            plantilla('<p>La CANTIDAD no puede quedar vacía.</p><p>La CANTIDAD debe ser un valor entero.</p><p>La CANTIDAD debe ser mayor a 0.</p><p>La CANTIDAD debe ser un valor entero.</p>');
        } else {
            plantilla('<p>La información capturada es correcta<p>');
        }
    });

    $("#precio").focusout(function () {
        $('#product-result').hide();
        let precio = $('#precio').val();
        if (precio.length == 0 || isNaN(parseInt(precio)) || precio < 99.99) {
            plantilla('<p>El PRECIO no puede quedar vacío y debe ser mayor a 99.99.</p><p>El PRECIO debe ser un valor numérico.</p><p>El PRECIO debe ser un valor mayor a 99.99.</p>');
        } else {
            plantilla('<p>La información capturada es correcta<p>');
        }
    });

    $("#detalles").focusout(function () {
        $('#product-result').hide();
        let detalles = $('#detalles').val();
        if (detalles.length == 0 || detalles.length > 250) {
            plantilla('<p>Los DETALLES no pueden quedar vacíos.</p><p>Los DETALLES no pueden exceder los 250 caracteres.</p>');
        } else {
            plantilla('<p>La información capturada es correcta<p>');
        }
    });

    $('#product-form').submit(function (e) {
        e.preventDefault();
        const producto = {
            id: $('#productId').val(),
            nombre: $('#nombre').val(),
            marca: $('#marca').val(),
            modelo: $('#modelo').val(),
            unidades: $('#unidades').val(),
            precio: $('#precio').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val()
        };
        console.log(producto);
        let url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        let nombre = $('#nombre').val();
        let marca = $('#marca').val();
        let modelo = $('#modelo').val();
        let unidades = $('#unidades').val();
        let precio = $('#precio').val();
        let detalles = $('#detalles').val();
        let imagen = $('#imagen').val();
        var alerta = "";

        // Validar NOMBRE
        if (nombre.length == 0) {
            alerta += '<p>El NOMBRE no puede quedar vacío.</p>';
        }
        if (nombre.length > 100) {
            alerta += '<p>El NOMBRE no puede exceder los 100 caracteres.</p>';
        }

        // Validar MARCA
        if (marca.length == 0) {
            alerta += '<p>La MARCA no puede quedar vacía.</p>';
        }

        // Validar MODELO
        if (modelo.length == 0) {
            alerta += '<p>El MODELO no puede quedar vacío.</p>';
        }
        if (modelo.length > 25) {
            alerta += '<p>El MODELO no puede exceder los 25 caracteres.</p>';
        }

        // Validar UNIDADES
        if (unidades.length == 0) {
            alerta += '<p>La CANTIDAD no puede quedar vacía.</p>';
        }
        if (isNaN(parseInt(unidades))) {
            alerta += '<p>La CANTIDAD debe ser un valor entero.</p>';
        }
        if (unidades < 1) {
            alerta += '<p>La CANTIDAD debe ser mayor a 0.</p>';
        }
        if (unidades % 1 !== 0) {
            alerta += '<p>La CANTIDAD debe ser un valor entero.</p>';
        }

        // Validar PRECIO
        if (precio.length == 0) {
            alerta += '<p>El PRECIO no puede quedar vacío y debe ser mayor a 99.99.</p>';
        }
        if (isNaN(parseInt(precio))) {
            alerta += '<p>El PRECIO debe ser un valor numérico.</p>';
        }
        if (precio < 99.99) {
            alerta += '<p>El PRECIO debe ser un valor mayor a 99.99.</p>';
        }

        // Validar DETALLES
        if (detalles.length == 0) {
            alerta += '<p>Los DETALLES no pueden quedar vacíos.</p>';
        }
        if (detalles.length > 250) {
            alerta += '<p>Los DETALLES no pueden exceder los 250 caracteres.</p>';
        }

        // Validar IMAGEN
        if (imagen.length == 0) {
            imagen = 'img/imagen.png';
        }

        if (alerta.length == 0) {
            $.post(url, producto, function (response) {
                console.log(response);
                let respuesta = JSON.parse(response);
                let template_bar = '';
                template_bar += `
                        <li style="list-style: none;">Etatus: ${respuesta.estatus}</li>
                        <li style="list-style: none;">${respuesta.mensaje}</li>
                    `;
                //document.getElementById("product-result").className = "card my-4 d-block";
                $('#product-result').show();
                $('#container').html(template_bar);
                $('#product-form').trigger('reset');
                listarProductos();
            });
        } else {
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Estatus:</li>
                    <li style="list-style: none;"><p>No se pudo agregar el producto<p>${alerta}</li>
                `;
            //document.getElementById("product-result").className = "card my-4 d-block";
            $('#product-result').show();
            $('#container').html(template_bar);
        }
    });

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function (response) {
                let productos = JSON.parse(response);
                if (Object.keys(productos).length > 0) {
                    let template = '';
                    productos.forEach(producto => {

                        let descripcion = '';
                        descripcion += '<li>marca: ' + producto.marca + '</li>';
                        descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                        descripcion += '<li>precio: ' + producto.precio + '</li>';
                        descripcion += '<li>detalles: ' + producto.detalles + '</li>';
                        descripcion += '<li>unidades: ' + producto.unidades + '</li>';

                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>
                                    <a href="#" class="product-item">${producto.nombre}</a>
                                </td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#products').html(template);
                }
            }
        });
    }

    $(document).on('click', '.product-item', function () {
        let elemento = $(this)[0].parentElement.parentElement;
        console.log(elemento);
        let id = $(elemento).attr('productId');
        console.log(id);
        $.post('./backend/product-single.php', {
            id
        }, function (response) {
            let producto = JSON.parse(response);
            $('#nombre').val(producto.nombre);
            $('#marca').val(producto.marca);
            $('#modelo').val(producto.modelo);
            $('#unidades').val(producto.unidades);
            $('#precio').val(producto.precio);
            $('#detalles').val(producto.detalles);
            $('#imagen').val(producto.imagen);
            $('#productId').val(id);
            console.log(producto);
            edit = true;
        });
    });

    $(document).on('click', '.product-delete', function () {
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('productId');
        if (confirm("Realmente deseas eliminar el Producto")) {
            $.post('./backend/product-delete.php', {
                id
            }, function (response) {
                let respuesta = JSON.parse(response);
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">Estatus: ${respuesta.estatus}</li>
                            <li style="list-style: none;">${respuesta.mensaje}</li>
                        `;
                //document.getElementById("product-result").className = "card my-4 d-block";
                $('#product-result').show();
                document.getElementById("container").innerHTML = template_bar;
                listarProductos();
            });
        }
    });
});