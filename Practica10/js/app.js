$(document).ready(function(){
    // Ruta corregida para la estructura de AwardSpace
    const urlAPI = "API/biblioteca/";

    // CARGAR LIBROS (GET)
    $("#libros").on('click', function(){
        $.getJSON(urlAPI + "titulo/lista", function(datos){
            $("#resultadosLibros ul").html("");
            $.each(datos, function(i, v){
                $("#resultadosLibros ul").append(
                    `<li>ID: ${v.id} - <strong>${v.titulo}</strong> 
                        <button onclick="eliminar(${v.id})">Borrar</button>
                        <button onclick="editar(${v.id})">Editar</button>
                    </li>`
                );
            });
        });
    });

    // GUARDAR NUEVO (POST)
    $("#btnGuardar").click(function(){
        const datos = {
            autor: $("#inAutor").val(),
            titulo: $("#inTitulo").val()
        };
        // Enviamos por POST a la ruta que ya tienes en libros.php
        $.post(urlAPI + "autor/nuevo", datos, function(){
            alert("Libro guardado");
            location.reload();
        });
    });
});

// FUNCIONES GLOBALES PARA BOTONES DINÁMICOS
function eliminar(id) {
    if(confirm('¿Seguro que deseas borrarlo?')) {
        $.ajax({
            url: "API/biblioteca/libros/" + id, // detalle = id
            type: 'DELETE',
            success: function() { location.reload(); }
        });
    }
}

function editar(id) {
    let nuevoTitulo = prompt("Ingrese el nuevo título:");
    if(nuevoTitulo) {
        $.ajax({
            url: "API/biblioteca/libros/" + id,
            type: 'PUT',
            data: { titulo: nuevoTitulo },
            success: function() { location.reload(); }
        });
    }
}