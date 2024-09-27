let
    tecnico_id = $('#tecnicoId'),
    nombres = $('#nombres'),
    sueldoHora = $('#sueldoHora')
;

const toastMessage = (message, valid = true)=>{
    if(valid){
        // Cambiar el mensaje del toast en función de la respuesta
        $('#success-toast .toast-body').text(message || 'El registro se guardó con éxito.');
        // Mostrar el toast de éxito
        let successToast = new bootstrap.Toast($('#success-toast'));
        successToast.show();
    }else{
        // Cambiar el mensaje del toast en caso de error
        $('#error-toast .toast-body').text(message);
        // Mostrar el toast de error
        let errorToast = new bootstrap.Toast($('#error-toast'));
        errorToast.show();
    }
}

const loadTecnicos = ()=> {
    $.ajax({
        url: 'views/tecnico_list.php',
        type: 'GET',
        success: function(data) {
            $('#tecnico-list').html(data);
        }
    });
}
$(document).ready(function() {
    $('.toast').toast({
        delay: 3000 // Los toasts se ocultarán automáticamente después de 3 segundos
    });

    /**
     *Este metodo es para validar el formulario, existe una libreria
     * en jquery que faciliat por mucho esto, pero no coinicidira con el proposito
     * de hacer un CRUD lo mas sencillo y 'vanilla' posible en PHP
     */
    const validation = ()=>{
        let valid = true;
        let nombresValidation = nombres.val().trim();
        let nombresError = $('#nombresError');
        let sueldoHoraError = $('#sueldoHoraError');
        nombresError.text(''); // Limpiar mensajes de error anteriores

        // Expresión regular para validar el nombre completo
        /**
         * Explicación del Regex:
         * ([A-Za-zÁÉÍÓÚáéíóúÑñ]{2,}\s): Coincide con una palabra (mínimo 2 caracteres) seguida de un espacio. Esta parte se repite entre 1 y 3 veces (para permitir 1 o 2 nombres y 1 apellido).
         *
         * [A-Za-zÁÉÍÓÚáéíóúÑñ]{2,}: Coincide con una última palabra (mínimo 2 caracteres), que será el apellido o un apellido adicional.
         *
         * El total de palabras: Permite hasta 4 partes (2 nombres y 2 apellidos), pero no menos de 2.
         *
         * Longitud del nombre completo: El total de caracteres (incluyendo espacios) debe estar entre 1 y 60.
         *
         *
         */
        let nameRegex = /^([A-Za-zÁÉÍÓÚáéíóúÑñ]{2,}\s){1,3}[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,}$/;

        // Validar longitud total
        if (nombresValidation.length < 1 || nombresValidation.length > 60) {
            nombresError.text('El nombre debe tener entre 1 y 60 caracteres.');
            valid = false;
        }

        // Validar la estructura del nombre completo usando el regex
        if (!nameRegex.test(nombresValidation)) {
            nombresError.text('El nombre debe tener entre 1-2 nombres y 1-2 apellidos.');
            valid = false;
        }

        if(sueldoHora.val() <= 0){
            sueldoHoraError.text('El sueldo por hora debe ser mayor que 0');
            valid = false;
        }
        if(valid){
            nombresError.text('');
            sueldoHoraError.text('');
        }
        return valid;
    }
    const limpiar = ()=>{
        nombres.val('');
        sueldoHora.val('');
        tecnico_id.val('');
    }

    $('#btnClear').on('click',function(e){
        if (confirm('¿Estás seguro de que deseas limpiar la el formulario?')) {
            limpiar();
        }

    });

    $('#frmTecnico').on('submit', function(event) {
        event.preventDefault();
        let tecnicoId = tecnico_id.val();
        let action = parseInt(tecnicoId) > 0 ? 'update' : 'create';
        if(!validation()){
            return false;
        }
        $.ajax({
            url: 'index.php',
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
                    toastMessage(response.message);
                    loadTecnicos();  // Recargar la lista de Tecnicos
                    limpiar();
                } else {
                    let message = response.hasOwnProperty('message') ? response.message : 'Ocurrió un error.';
                    toastMessage(message);
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
            url: 'index.php',
            type: 'POST',
            data: {
                action: 'delete',
                id: tecnicoId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    toastMessage(response.message);
                    loadTecnicos();  // Recargar la lista de estudiantes
                } else {
                    toastMessage(response.message);
                }
            }
        });
    }
});

$(document).on('click', '.btnUpdate', function() {
    let tecnicoId = $(this).data('id');
    let data = $(this).serialize();

    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: {
            action: 'getTecnico',
            id: tecnicoId,
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                toastMessage(response.message);
                // Cargar los datos en el formulario de actualización
                nombres.val(response.data.Nombres);
                sueldoHora.val(response.data.SueldoHora);
                tecnico_id.val(response.data.TecnicoId);  // Añadir un campo oculto para el ID
            }
        }
    });
});

