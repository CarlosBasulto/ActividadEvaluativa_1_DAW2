<?php
require_once BASE_DIR .  '../models/Cliente.php';

class ClienteController {
    private $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
    }

    public function crearCliente($data) {
        return $this->clienteModel->crearCliente($data);
    }

    public function mostrarClientes() {
        return $this->clienteModel->leerClientes();
    }

    public function actualizarCliente($data, $id) {
        return $this->clienteModel->actualizarCliente($data, ['id' => $id]);
    }

    public function eliminarCliente($id) {
        return $this->clienteModel->eliminarCliente(['id' => $id]);
    }
}
?>
