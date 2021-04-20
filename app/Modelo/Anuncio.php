<?php

class Anuncio {
    //put your code here
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $fecha;
    private $foto;
    private $id_usuario;
    
    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function getFoto()
    {
        return $this->foto;
    }

    function getId_usuario()
    {
        return $this->id_usuario;
    }

    function setId($id): void
    {
        $this->id = $id;
    }

    function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio): void
    {
        $this->precio = $precio;
    }

    function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    function setFoto($foto): void
    {
        $this->foto = $foto;
    }

    function setId_usuario($id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }


}
