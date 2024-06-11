<?php

class Usuario {

    private $id;
    private $nombre;
    private $rol;
    private $nombre_usuario;
    private $contraseña;

    public function __construct($assoc) {
        $this->id = $assoc['id'] ?? null;
        $this->nombre = $assoc['nombre'] ?? null;
        $this->rol = $assoc['rol'] ?? null;
        $this->nombre_usuario = $assoc['nombre_usuario'] ?? null;
        $this->contraseña = $assoc['contraseña'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getNombre_usuario() {
        return $this->nombre_usuario;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }

    public function setNombre_usuario($nombre_usuario): void {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }
}
