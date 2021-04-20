<?php

 class Controller
 {
    function listar() {
        $conn = Conexion::conectar();
        $gm = new GestorAnuncios($conn);
        $mensajes = $gm->obtener_todos();
        require '../app/vistas/listar_anuncios.php';
    }
    function insertar(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $anuncio = new Anuncio();
            $anuncio->setId_usuario(Session::obtener()->getId());
            $anuncio->setNombre(filter_var($_POST['nombre'], FILTER_SANITIZE_SPECIAL_CHARS));
            $anuncio->setDescripcion(filter_var($_POST['descripcion'], FILTER_SANITIZE_SPECIAL_CHARS));
            $anuncio->setPrecio(filter_var($_POST['precio'], FILTER_SANITIZE_SPECIAL_CHARS));
            
            $partes = explode(".", limpiar_datos($_FILES['foto']['name']));
            $extension = $partes[count($partes) - 1];
            do {
                $nombre_foto = md5(time() + rand()) . '.' . $extension;
            } while (file_exists("imagenes/$nombre_foto"));

            move_uploaded_file($_FILES['foto']['tmp_name'], "imagenes/$nombre_foto");

            $anuncio->setFoto($nombre_foto);
            
            $ga = new GestorAnuncios(Conexion::conectar());
            $ga->insertar($anuncio);
            header('Location: ' . RUTA . 'listar_anuncios');
            die();
        }
        require '../app/vistas/insertar_mensaje.php';
    }

 }