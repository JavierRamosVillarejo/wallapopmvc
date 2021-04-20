<?php


class GestorAnuncios {
   
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }
    function obtener($id) {
        $conn = $this->conn;
        if (!$stmt = $conn->prepare("SELECT * FROM anuncio WHERE id = ?")) {
            die("Error al preparar la consulta: " . $conn->error);
        }
        if (!$stmt->bind_param('i', $id)) {
            die("Error en el bind_param: " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Error en el execute: " . $stmt->error);
        }
        $result = $stmt->get_result();

        return $result->fetch_object('Anuncio');
        
    }
    function borrar($id) {
        $conn = $this->conn;
        //$stmt = new mysqli_stmt();
        if (!$stmt = $conn->prepare("DELETE FROM aninuncio WHERE id = ?")) {
            die("Error al preparar la consulta: " . $conn->error);
        }
        if (!$stmt->bind_param('i', $id)) {
            die("Error en el bind_param: " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Error en el execute: " . $stmt->error);
        }
        if ($stmt->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    function insertar($anuncio) {
        $conn = $this->conn;
        $stmt = $conn->prepare("INSERT INTO anuncio (nombre, descripcion, precio, foto, id_usuario) "
                . "VALUES (?,?,?,?,?,?)");
        $nombre = $anuncio->getNombre();
        $descripcion = $anuncio->getDesripcion();
        $precio = $anuncio->getPrecio();
        $foto = $anuncio->getFoto();
        $id_usuario = $anuncio->getId_usuario();
        
        $stmt->bind_param('ssdbs', $nombre, $descripcion, $precio, $foto, $id_usuario);
        $stmt->execute();
    }
    function obtener_todos() {
        $conn = $this->conn;
        if (!$result = $conn->query("SELECT * FROM anuncio")) {
            die("Error en la sql: " . $this->conn->error);
        }
        $array_anuncios = $result->fetch_all(MYSQLI_ASSOC);
        $array_objetos = array();
        foreach ($array_anuncios as $a) {
            $obj_anuncio = new Anuncio();
            $obj_anuncio->setFecha($a['fecha']);
            $obj_anuncio->setId($a['id']);
            $obj_anuncio->setNombre($a['texto']);
            $obj_anuncio->setDescripcion($a['descripcion']);
            $obj_anuncio->setPrecio($a['precio']);
            $obj_anuncio->setFoto($a['foto']);
            $obj_anuncio->setId_usuario($a['id_usuario']);
            
            $array_objetos[] = $obj_anuncio;
        }
        return $array_objetos;
    }
}
