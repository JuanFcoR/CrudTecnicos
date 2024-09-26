<?php
require_once '../config/database.php';
require_once '../controllers/TecnicoController.php';

$controller = new TecnicoController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'delete':
            $id = $_POST['id'];
            $controller->delete($id);
            break;
        case 'getTecnico':
            $id = $_POST['id'];
            $controller->getTecnico($id);
            break;
        case 'update':
            $id = $_POST['id'];
            $nombres = $_POST['nombres'];
            $sueldoHora = $_POST['sueldoHora'];
            $controller->update($id, $nombres, $sueldoHora);
            break;
        case 'create':
            $nombres = $_POST['nombres'];
            $sueldoHora = $_POST['sueldoHora'];
            $controller->create($nombres, $sueldoHora);
            break;

    }

}

include '../views/tecnico_form.php';
