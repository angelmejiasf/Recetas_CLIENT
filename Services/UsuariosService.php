<?php

require_once __DIR__ . '/classes/Usuario.php';

class UsuariosService {

    /**
     * Realiza una solicitud cURL para obtener los usuarios desde un servicio web.
     *
     * @return array|bool Un array de objetos Usuario si la solicitud es exitosa, false si hay algún error.
     */
    public function request_curl() {
        $urlmiservicio = "http://localhost/_servWeb/serRecetas/Usuarios.php";
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        curl_close($conexion);

        if ($res) {
            $usuariosData = json_decode($res, true);

            if ($usuariosData !== null) {
                $usuarios = [];
                foreach ($usuariosData as $usuarioData) {
                    $usuario = new Usuario($usuarioData);
                    $usuarios[] = $usuario;
                }
                return $usuarios;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
