<?php
class ControladorUsuarios {
  
   function login() {
        
        $gu = new GestorUsuario(Conexion::conectar());
        if (!$usuario = $gu->obtener_email(limpiar_datos($_POST['email']))) {
            MensajeFlash::anadir_mensaje('Usuario o contraseña incorrectos');
        } else if (password_verify($_POST['password'], $usuario->getPassword())) {
            Session::iniciar($usuario);
            Session::crear_cookie($usuario->getUid());
        } else {
            MensajeFlash::anadir_mensaje('Usuario o contraseña incorrectos');
        }
        header("Location: " . RUTA . "listar_anuncios");
        
       
    }
    
   function logout() {
        Session::cerrar();
        Session::borrar_cookie();
        header("Location: ". RUTA . "listar_anuncios");
   }
    
   function registrar() {
       if($_SERVER['REQUEST_METHOD'] == 'POST') {
           // Recogemos datos del formulario y los validamos
           $email = limpiar_datos($_POST['email']);
           $pwd = limpiar_datos($_POST['password']);
           $nombre = limpiar_datos($_POST['nombre']);
           $telefono = limpiar_datos($_POST['telefono']);
           $poblacion = limpiar_datos($_POST['poblacion']);
           
           $correcto = true;
           
           if(empty($email)) {
               $correcto = false;
               MensajeFlash::anadir_mensaje("El campo email no puede estar vacío");
           }
           
           if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $correcto = false;
               MensajeFlash::anadir_mensaje("Formato de email incorrecto");
           }
           
           if(empty($pwd)) {
               $correcto = false;
               
               MensajeFlash::anadir_mensaje("El campo contraseña no puede estra vacío");
           }
           
           if(strlen($pwd) < 4) {
               $correcto = false;
               MensajeFlash::anadir_mensaje("La contraseña tiene que ser de al menos 4 caracteres");
           }
           
           if(empty($nombre)) {
               $nombre = "";
           }
           
           if(empty($telefono)) {
               $telefono = "";
           }
           
           if(empty($poblacion)) {
               $poblacion = "";
           }
           if($correcto) {
               $usu = new Usuario();
               $usu->setEmail($email);
               $usu->setNombre($nombre);
               $usu->setPassword($pwd);
               $usu->setPoblacion($poblacion);
               $usu->setTelefono($telefono);
               $usu->setUid(sha1(time() + rand()));
               $gu = new GestorUsuario(Conexion::conectar());
               MensajeFlash::anadir_mensaje("Usuario registrado correctamente");
               $gu->insertar($usu);
                header('Location: ' . RUTA . 'listar_anuncios');
           }
           else
               require '../app/vistas/registro.php';
           
       }else
           require '../app/vistas/registro.php';
   }
    
   function existe_email() {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $gu = new GestorUsuario(Conexion::conectar());
        sleep(1);
        if ($gu->obtener_email($email)) {
            echo 'existe';
        } else {
            echo 'no_existe';
        }
   }
   
}
