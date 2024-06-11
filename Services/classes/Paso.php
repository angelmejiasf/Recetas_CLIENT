<?php

class Paso {

    private $id;
    private $descripcion;
    private $orden;
    private $id_receta;

    public function __construct($assoc) {
        $this->id = $assoc['id'] ?? null;
        $this->descripcion = $assoc['descripcion'] ?? null;
        $this->orden = $assoc['orden'] ?? null;
        $this->id_receta = $assoc['id_receta'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getOrden() {
        return $this->orden;
    }

    public function getId_receta() {
        return $this->id_receta;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setOrden($orden): void {
        $this->orden = $orden;
    }

    public function setId_receta($id_receta): void {
        $this->id_receta = $id_receta;
    }
}
