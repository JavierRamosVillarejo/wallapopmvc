<?php

class GestorUsuario {

    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function obtener($id) {

        $conn = $this->conn;
        if (!$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?")) {
            die("Error al preparar la consulta: " . $conn->error);
        }
        if (!$stmt->bind_param('i', $id)) {
            die("Error en el bind_param: " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Error en el execute: " . $stmt->error);
        }
        $result = $stmt->get_result();

        return $result->fetch_object('Usuario');
    }

    function obtener_email($email) {

        $conn = $this->conn;
        if (!$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?")) {
            die("Error al preparar la consulta: " . $conn->error);
        }
        if (!$stmt->bind_param('s', $email)) {
            die("Error en el bind_param: " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Error en el execute: " . $stmt->error);
        }
        $result = $stmt->get_result();

        if($usu = $result->fetch_object('Usuario')) {
            return $usu;
        }
        else {
            return false;
        }
    }

    /**
     * Obtiene un Usuario a partir de su UID
     * @param type $uid
     * @return Devuelve un objeto de la clase Usuario o false si no existe
     */
    function obtener_uid($uid) {

        $conn = $this->conn;
        if (!$stmt = $conn->prepare("SELECT * FROM usuarios WHERE uid = ?")) {
            die("Error al preparar la consulta: " . $conn->error);
        }
        if (!$stmt->bind_param('s', $uid)) {
            die("Error en el bind_param: " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Error en el execute: " . $stmt->error);
        }
        $result = $stmt->get_result();

        return $result->fetch_object('Usuario');
    }

    /**
     * Inserta el objeto usuario en la base de datos cifrando antes el password
     * @param Usuario $u
     * @return boolean true si se ha insertado correctamente
     */
    function insertar(Usuario $u) {
        $conn = $this->conn;
        
        $nombre = $u->getNombre();
        $email = $u->getEmail();
        $password = password_hash($u->getPassword(), PASSWORD_BCRYPT);
        $telefono = $u->getTelefono();
        $poblacion = $u->getPoblacion();
        $uid = $u->getUid();
        if (!$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, telefono, poblacion, uid) VALUES (?,?,?,?,?,?)")) {
            die("Error al preparar la consulta: " . $conn->error);
        }
        if (!$stmt->bind_param('ssssss', $nombre, $email, $password, $telefono, $poblacion, $uid)) {
            die("Error en el bind_param: " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Error en el execute: " . $stmt->error);
        }
        return true;
    }

    function existe_email() {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $gu = new GestorUsuarios(Conexion::conectar());
        if ($gu->obtener_email($email)) {
            echo 'existe';
        } else {
            echo 'no_existe';
        }
    }

}
