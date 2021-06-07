<?php  

//carga el modelo y los controladores
require_once '../app/modelo/Anuncio.php';
require_once '../app/modelo/Conexion.php';
require_once '../app/modelo/GestorAnuncio.php';
require_once '../app/modelo/MensajeFlash.php';
require_once '../app/modelo/Session.php';
require_once '../app/modelo/Usuario.php';
require_once '../app/modelo/GestorUsuario.php';
require_once '../app/modelo/funciones.php';
require_once '../app/controlador/controladorAnuncios.php';
require_once '../app/controlador/controladorUsuarios.php';



//enrutamiento
$map = array( 
   //Anuncios
    'listar_anuncios'=>array('controlador'=>'ControladorAnuncios','metodo'=>'listar','publica'=>true),
    'ver_anuncio'=>array('controlador'=>'ControladorAnuncios','metodo'=>'ver','publica'=>true),
    'insertar_anuncio'=> array('controlador'=>'ControladorAnuncios','metodo'=>'insertar','publica'=> false),
    'borrar_anuncio'=>array('controlador'=>'ControladorAnuncios','metodo'=>'borrar','publica'=>false),
);


// Parseo de la ruta
 if(!empty($_GET['accion'])){
    if(isset($mapa[$_GET['accion']])){
        $accion = $_GET['accion'];
    }
    else{
        $accion = 'inicio';
        MensajeFlash::anadir_mensaje('La acción indicada no existe');
    }
}
else{
    $accion = 'listar_anuncios';    //Acción por defecto
}

 //Si no ha iniciado sesión pero sí tiene cookie, iniciamos la sesión de forma automática
if(!Session::esta_iniciada() && Session::existe_cookie()){
    $gu = new GestorUsuario(Conexion::conectar());
    if($usuario = $gu->obtener_uid(Session::obtener_cookie())){
        Session::crear_cookie($usuario->getUid());
        Session::iniciar($usuario);
    }
}

if(!Session::esta_iniciada() && !$mapa[$accion]['publica']) {
    MensajeFlash::anadir_mensaje("Debes iniciar sesión para entrar en la página $accion.");
    header("Location:" . RUTA . "listar_anuncios");
    die();
}

$clase_controlador = $mapa[$accion]['controlador'];
$metodo_controlador = $mapa[$accion]['metodo'];
//Ejecutamos el método del controlador
$objeto = new $clase_controlador();
$objeto->$metodo_controlador();