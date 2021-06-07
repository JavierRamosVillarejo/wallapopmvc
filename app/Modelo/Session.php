<?php


class Session {
    
    public static function iniciar($usuario) {
        $_SESSION['uid_app_usuario'] = serialize($usuario);
    }
    
    public static function obtener(){
        if(self::esta_iniciada())
        {
            return unserialize($_SESSION['uid_app_usuario']);
        }
        else
        {
            return false;
        }
    }

    public static function cerrar() {
        unset($_SESSION['uid_app_usuario']);
    }

    public static function esta_iniciada(): bool {
        return isset($_SESSION['uid_app_usuario']);
    }

    public static function existe_cookie(): bool {
        return isset($_COOKIE['uid']);
    }

    public static function crear_cookie($uid) {
        setcookie('uid', $uid, time() + 20 * 24 * 60 * 60, '/');
    }

    public static function borrar_cookie() {
        setcookie('uid', '', time() - 5, '/');
    }

    public static function obtener_cookie() {
        if (self::existe_cookie()) {
            return filter_var($_COOKIE['uid'], FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            false;
        }
    }


}
