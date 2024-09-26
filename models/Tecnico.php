<?php
require_once '../config/database.php';

class Tecnico {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function read() {
        $stmt = $this->pdo->prepare("SELECT * FROM tecnicos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve un array asociativo con todos los tecnicos
    }
    public function create($data): bool {
        $stmt = $this->pdo->prepare("INSERT INTO tecnicos (Nombres, SueldoHora) VALUES (:nombres, :sueldoHora)");
        $stmt->bindParam(':nombres', $data['nombres']);
        $stmt->bindParam(':sueldoHora', $data['sueldoHora']);
        return $stmt->execute();  // Devuelve true si se insertó correctamente
    }

    // Método para encontrar un tecnico por su ID
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tecnicos WHERE TecnicoId = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);  // Devuelve el resultado como array asociativo
    }

    // Método para eliminar un tecnico por su ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tecnicos WHERE TecnicoId = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();  // Devuelve true si se eliminó correctamente
    }

    // Método para actualizar un tecnico
    public function update($id, $data): bool {
        $stmt = $this->pdo->prepare("UPDATE tecnicos SET Nombres = :nombres, SueldoHora = :sueldoHora WHERE TecnicoId = :id");
        $stmt->bindParam(':nombres', $data['nombres']);
        $stmt->bindParam(':sueldoHora', $data['sueldoHora']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();  // Devuelve true si se actualizó correctamente
    }
}
