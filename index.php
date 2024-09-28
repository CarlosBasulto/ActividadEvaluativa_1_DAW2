<h1>Página de prueba para testear las vistas generadas por servidor</h1>

<?php
session_start(); // Si vas a usar sesiones, siempre debe ir primero
// Definir ruta base para incluir archivos
define('BASE_DIR', __DIR__);  // c:/xampp/htdocs/Super
// Definir url base para estilos y enlaces
define('BASE_URL', ''); // http://tu_host_virtual

require_once BASE_DIR . '/views/usuarios.php';  // Mostrar usuarios
require_once BASE_DIR . '/views/clientes.php';  // Mostrar clientes
?>


