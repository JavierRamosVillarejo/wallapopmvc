<?php  

//carga el modelo y los controladores
require_once __DIR__ . '';

//enrutamiento
$map = array( 
    'inicio' => array('controller' => 'Controller', 'action'=>'inicio'),
    'listar' => array('controller' =>'Controller', 'action' =>'listar'),
    'insertar' => array('controller' =>'Controller', 'action' =>'insertar'),
    'ver' => array('controller' =>'Controller', 'action' =>'ver')
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
    $accion = 'inicio';    //Acción por defecto
}
 
 $controlador = $map[$ruta];
 // Ejecución del controlador asociado a la ruta

 if (method_exists($controlador['controller'],$controlador['action'])) {
     call_user_func(array(new $controlador['controller'], $controlador['action']));
 } else {

     header('Status: 404 Not Found');
     echo '<html><body><h1>Error 404: El controlador <i>' .
             $controlador['controller'] .
             '->' .
             $controlador['action'] .
             '</i> no existe</h1></body></html>';
 }
