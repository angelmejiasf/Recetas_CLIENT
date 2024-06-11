<?php

require_once __DIR__ . '/classes/Categoria.php';

class CategoriasService {

    /**
     * Realiza una solicitud cURL para obtener las categorías desde un servicio web.
     *
     * @return array|bool Un array de objetos Categoria si la solicitud es exitosa, false si hay algún error.
     */
    public function request_curl() {
        $urlmiservicio = "http://localhost/_servWeb/serRecetas/Categorias.php";
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        curl_close($conexion);

        if ($res) {
            $categoriasData = json_decode($res, true);

            if ($categoriasData !== null) {
                $categorias = [];
                foreach ($categoriasData as $categoriaData) {
                    $categoria = new Categoria($categoriaData);
                    $categorias[] = $categoria;
                }
                return $categorias;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
