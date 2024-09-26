<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Tecnicos</title>
    <link href="../public/css/style.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Registro de Tecnicos</h2>
    <form id="tecnico-form" method="POST">
        <input type="hidden" id="tecnicoId" value="">
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" class="form-control" id="nombres" name="name" required>
        </div>
        <div class="form-group">
            <label for="sueldoHora">Sueldo Hora:</label>
            <input type="number" class="form-control" id="sueldoHora" name="sueldoHora" step="0.01" placeholder="Introduce valor por hora" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" id="btnClear" class="btn btn-danger">Limpiar</button>
    </form>
    <div id="message"></div>
    <hr>
    <div id="tecnico-list"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../public/js/script.js"></script>
</body>
</html>
