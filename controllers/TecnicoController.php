<?php
require_once __DIR__ . '/../models/Tecnico.php';

class TecnicoController {
    private $tecnicoModel;

    public function __construct($pdo) {
        $this->tecnicoModel = new Tecnico($pdo);
    }

    public function create($nombres, $sueldoHora) {
        $tecnicoObj['nombres'] = $nombres;
        $tecnicoObj['sueldoHora'] = $sueldoHora;
        $tecnico = $this->tecnicoModel->create($tecnicoObj);
        if($tecnico){
            echo json_encode(['success' => true, 'message' => 'Tecnico creado exitosamente']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error al registrar Tecnico.']);
        }
        exit();

    }

    public function read() {
        return $this->tecnicoModel->read();
    }

    public function update($id, $nombres, $sueldoHora) {
        $tecnico = $this->tecnicoModel->find($id);
        if ($tecnico) {
            $tecnicoObj['nombres'] = $nombres;
            $tecnicoObj['sueldoHora'] = $sueldoHora;
            $this->tecnicoModel->update($id, $tecnicoObj);
            echo json_encode(['success' => true, 'message' => 'Tecnico actualizado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tecnico no encontrado']);
        }
        exit();
    }

    public function delete($id) {
        $tecnico = $this->tecnicoModel->find($id);
        if ($tecnico) {
            $this->tecnicoModel->delete($id);
            echo json_encode(['success' => true, 'message' => 'Tecnico eliminado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tecnico no encontrado']);
        }
        exit();
    }
    public function getTecnico($id) {
        $tecnico = $this->tecnicoModel->find($id);
        if ($tecnico) {
            echo json_encode(['success' => true, 'data' => $tecnico]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tecnico no encontrado']);
        }
        exit();
    }
}
