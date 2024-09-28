<?php

class Crud {
    private $conn;     // La conexión a la base de datos
    private $table;    // Nombre de la tabla con la que trabajaremos

    // Constructor: requiere una conexión de base de datos y el nombre de la tabla
    public function __construct($db, $table) {
        $this->conn = $db;
        $this->table = $table;
    }

    // Método para crear un nuevo registro
    public function create($data) {
        // Obtener las claves del array de datos como columnas
        $columns = implode(", ", array_keys($data));

        // Crear una lista de marcadores de posición para valores
        $placeholders = ":" . implode(", :", array_keys($data));

        // Consulta SQL para insertar datos
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);

        // Bindear los valores a los marcadores de posición
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Método para leer registros (opcionalmente con condiciones)
    public function read($conditions = null) {
        // Consulta base
        $sql = "SELECT * FROM {$this->table}";

        // Si hay condiciones, las agregamos
        if ($conditions) {
            $sql .= " WHERE " . $this->buildConditions($conditions);
        }

        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);

        // Ejecutar la consulta
        $stmt->execute();

        // Devolver todos los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para actualizar registros
    public function update($data, $conditions) {
        // Crear la parte SET de la consulta
        $setPart = "";
        foreach ($data as $key => $value) {
            $setPart .= "$key = :$key, ";
        }
        $setPart = rtrim($setPart, ", ");  // Eliminar la última coma

        // Crear la consulta SQL
        $sql = "UPDATE {$this->table} SET {$setPart} WHERE " . $this->buildConditions($conditions);

        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);

        // Bindear los valores a los marcadores de posición
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Bindear las condiciones
        foreach ($conditions as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Método para eliminar registros
    public function delete($conditions) {
        // Crear la consulta SQL
        $sql = "DELETE FROM {$this->table} WHERE " . $this->buildConditions($conditions);

        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);

        // Bindear las condiciones
        foreach ($conditions as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Método privado para construir la parte WHERE de la consulta con condiciones
    private function buildConditions($conditions) {
        $conditionPart = "";
        foreach ($conditions as $key => $value) {
            $conditionPart .= "$key = :$key AND ";
        }
        return rtrim($conditionPart, " AND ");  // Eliminar el último "AND"
    }
}
