<?php
require_once BASE_DIR .  '../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function crearUsuario($data) {
        return $this->usuarioModel->crearUsuario($data);
    }

    public function mostrarUsuarios() {
        return $this->usuarioModel->leerUsuarios();
    }

    public function actualizarUsuario($data, $id) {
        return $this->usuarioModel->actualizarUsuario($data, ['id' => $id]);
    }

    public function eliminarUsuario($id) {
        return $this->usuarioModel->eliminarUsuario(['id' => $id]);
    }
}
?>
