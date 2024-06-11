<?php

class Categoria {

    private $id;
    private $nombre;
    private $descripcion;

    public function __construct($assoc) {

        $this->id = $assoc['id'] ?? null;
        $this->nombre = $assoc['nombre'] ?? null;
        $this->descripcion = $assoc['descripcion'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }
}
