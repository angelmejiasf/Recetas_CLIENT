<?php

require_once __DIR__ . '/classes/Paso.php';

class PasosService {

    /**
     * Realiza una solicitud cURL para obtener los pasos desde un servicio web.
     *
     * @return array|bool Un array de objetos Paso si la solicitud es exitosa, false si hay algún error.
     */
    public function request_curl() {
        $urlmiservicio = "http://localhost/_servWeb/serRecetas/Pasos.php";
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        curl_close($conexion);

        if ($res) {
            $pasosData = json_decode($res, true);

            if ($pasosData !== null) {
                $pasos = [];
                foreach ($pasosData as $pasoData) {
                    $paso = new Paso($pasoData);
                    $pasos[] = $paso;
                }
                return $pasos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
