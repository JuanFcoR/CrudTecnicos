<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Tecnicos</title>
    <link href="public/css/style.css" rel="stylesheet">
    <!-- Bootstrap 5.3.2 CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5.3.2 JS -->
    <script src="public/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Registro de Tecnicos</h2>
    <form id="frmTecnico" method="POST">
        <input type="hidden" id="tecnicoId" value="">
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" class="form-control" id="nombres" name="name" required>
            <div id="nombresError" class="text-danger"></div>
        </div>
        <div class="form-group">
            <label for="sueldoHora">Sueldo Hora:</label>
            <input type="number" class="form-control" id="sueldoHora" name="sueldoHora" step="0.01" placeholder="Introduce valor por hora" required>
            <div id="sueldoHoraError" class="text-danger"></div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Guardar</button>
        <button type="button" id="btnClear" class="btn btn-danger">Limpiar</button>
    </form>
    <!-- Toast de éxito -->
    <div class="toast align-items-center text-bg-success border-0" id="success-toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
        <div class="d-flex">
            <div class="toast-body">
                El tecnico se guardó con éxito.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <!-- Toast de error -->
    <div class="toast align-items-center text-bg-danger border-0" id="error-toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
        <div class="d-flex">
            <div class="toast-body">
                Ocurrió un error al guardar el tecnico.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <hr>
    <div id="tecnico-list"></div>
</div>


<script src="public/js/jquery-3.6.0.min.js"></script>
<script src="public/js/script.js"></script>
</body>
</html>
