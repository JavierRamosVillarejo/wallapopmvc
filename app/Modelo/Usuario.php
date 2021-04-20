<?php

class Usuario {
    //put your code here
    private $id;
    private $email;
    private $password;
    private $nombre;
    private $telefono;
    private $poblacion;
    private $uid;
    
    function getId()
    {
        return $this->id;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getTelefono()
    {
        return $this->telefono;
    }

    function getPoblacion()
    {
        return $this->poblacion;
    }

    function getUid()
    {
        return $this->uid;
    }

    function setId($id): void
    {
        $this->id = $id;
    }

    function setEmail($email): void
    {
        $this->email = $email;
    }

    function setPassword($password): void
    {
        $this->password = $password;
    }

    function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    function setPoblacion($poblacion): void
    {
        $this->poblacion = $poblacion;
    }

    function setUid($uid): void
    {
        $this->uid = $uid;
    }


    
}
