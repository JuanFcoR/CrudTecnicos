let
    tecnico_id = $('#tecnicoId'),
    nombres = $('#nombres'),
    sueldoHora = $('#sueldoHora')
;

function loadTecnicos() {
    $.ajax({
        url: '../views/tecnico_list.php',
        type: 'GET',
        success: function(data) {
            $('#tecnico-list').html(data);
        }
    });
}
$(document).ready(function() {

    $('button[name="btnUpdate"]').on('click', function(e){
        e.preventDefault();
        console.log("hola");
    });

    $('#btnClear').on('click',function(e){
        if (confirm('¿Estás seguro de que deseas limpiar la el formulario?')) {
            nombres.val('');
            sueldoHora.val('');
            tecnico_id.val('');
        }

    });

    $('#tecnico-form').on('submit', function(event) {
        event.preventDefault();
        let tecnicoId = tecnico_id.val();
        let action = parseInt(tecnicoId) > 0 ? 'update' : 'create';
        $.ajax({
            url: '../public/index.php',
            type: 'POST',
            data: {
                action: action,
                id: tecnicoId,
                nombres: nombres.val(),
                sueldoHora: sueldoHora.val()
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                    loadTecnicos();  // Recargar la lista de Tecnicos
                } else {
                    $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            }
        });
    });

    loadTecnicos();
});

$(document).on('click', '.btnDelete', function() {
    let tecnicoId = $(this).data('id');
    if (confirm('¿Estás seguro de que quieres eliminar a este estudiante?')) {
        $.ajax({
            url: '../public/index.php',
            type: 'POST',
            data: {
                action: 'delete',
                id: tecnicoId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                    loadTecnicos();  // Recargar la lista de estudiantes
                } else {
                    $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            }
        });
    }
});

$(document).on('click', '.btnUpdate', function() {
    let tecnicoId = $(this).data('id');
    let data = $(this).serialize();

    $.ajax({
        url: '../public/index.php',
        type: 'POST',
        data: {
            action: 'getTecnico',
            id: tecnicoId,
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Cargar los datos en el formulario de actualización
                nombres.val(response.data.Nombres);
                sueldoHora.val(response.data.SueldoHora);
                tecnico_id.val(response.data.TecnicoId);  // Añadir un campo oculto para el ID
            }
        }
    });
});

