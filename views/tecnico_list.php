<?php
require_once '../config/database.php';
require_once '../controllers/TecnicoController.php';

$controller = new TecnicoController($pdo);
$tecnicos = $controller->read();
?>

<table class="table">
    <thead>
    <tr>
        <th>TecnicoId</th>
        <th>Nombres</th>
        <th>Sueldo Hora</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tecnicos as $tecnico): ?>
        <tr>
            <td><?php echo htmlspecialchars($tecnico['TecnicoId']); ?></td>
            <td><?php echo htmlspecialchars($tecnico['Nombres']); ?></td>
            <td><?php echo htmlspecialchars($tecnico['SueldoHora']); ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" name="btnUpdate" class="btnUpdate btn btn-primary" data-id="<?php echo htmlspecialchars($tecnico['TecnicoId']); ?>" >update</button>
                    <button type="button" class="btnDelete btn btn-danger" data-id="<?php echo htmlspecialchars($tecnico['TecnicoId']); ?>">delete</button>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
