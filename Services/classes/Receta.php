<?php

class Receta {

    private $id;
    private $titulo;
    private $contenido;
    private $id_usuario;
    private $fecha_publicacion;
    private $id_categoria;
    private $editado;
    private $fecha_edicion;
    private $foto;

    public function __construct($assoc) {
        $this->id = $assoc['id'] ?? null;
        $this->titulo = $assoc['titulo'] ?? null;
        $this->contenido = $assoc['contenido'] ?? null;
        $this->id_usuario = $assoc['id_usuario'] ?? null;
        $this->fecha_publicacion = $assoc['fecha_publicacion'] ?? null;
        $this->id_categoria = $assoc['id_categoria'] ?? null;
        $this->editado = $assoc['editado'] ?? null;
        $this->fecha_edicion = $assoc['fecha_edicion'] ?? null;
        $this->foto = $assoc['foto'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getFechaPublicacion() {
        return $this->fecha_publicacion;
    }

    public function getIdCategoria() {
        return $this->id_categoria;
    }

    public function getEditado() {
        return $this->editado;
    }

    public function getFechaEdicion() {
        return $this->fecha_edicion;
    }

    public function getFoto() {
        return $this->foto;
    }

    /**
    public function getFotoDataURL() {
        if ($this->foto) {
            return 'data:image/jpeg;base64,' . $this->foto;
        }
        return null;
    }*/
}
