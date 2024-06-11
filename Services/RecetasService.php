<?php

require_once __DIR__ . '/classes/Receta.php';

class RecetasService {

    /**
     * Realiza una solicitud cURL para obtener las recetas desde un servicio web.
     *
     * @return array|bool Un array de objetos Receta si la solicitud es exitosa, false si hay algún error.
     */
    public function request_curl() {
        $urlmiservicio = "http://localhost/_servWeb/serRecetas/Recetas.php";
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        curl_close($conexion);

        if ($res) {
            $recetasData = json_decode($res, true);

            if ($recetasData !== null) {
                $recetas = [];
                foreach ($recetasData as $recetaData) {
                    $receta = new Receta($recetaData);
                    $recetas[] = $receta;
                }
                return $recetas;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Obtiene una receta por su ID.
     *
     * @param int $idreceta ID de la receta.
     * @return Receta|bool Un objeto Receta si la solicitud es exitosa, false si hay algún error.
     */
    public function obtenerRecetaPorId($idreceta) {
        $urlMiServicio = "http://localhost/_servWeb/serRecetas/Recetas.php?idreceta=" . urlencode($idreceta);

        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlMiServicio);
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        curl_close($conexion);

        if ($res) {
            $recetaData = json_decode($res, true);
            if ($recetaData !== null) {
                return new Receta($recetaData);
            }
        }
        return false;
    }

    /**
     * Realiza una solicitud cURL para actualizar una receta usando el método PUT.
     *
     * @param int $id ID de la receta.
     * @param string $titulo Título de la receta.
     * @param string $contenido Contenido de la receta.
     * @param int $id_categoria ID de la categoría de la receta.
     * @return void
     */
    function request_put($id, $titulo, $contenido, $id_categoria) {
        $datos = array(
            "id_receta" => $id,
            "titulo" => $titulo,
            "contenido" => $contenido,
            "categoria" => $id_categoria
        );

        $envio = json_encode($datos);
        $urlMiServicio = "http://localhost/_servWeb/serRecetas/Recetas.php";

        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlMiServicio);
        curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Content-Length: ' . mb_strlen($envio)));
        curl_setopt($conexion, CURLOPT_POSTFIELDS, $envio);
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($conexion);

        if ($res) {
            echo $res;
        }

        curl_close($conexion);
    }

    /**
     * Realiza una solicitud cURL para eliminar una receta usando el método DELETE.
     *
     * @param int $id_receta ID de la receta a eliminar.
     * @return void
     */
    public function request_delete($id_receta) {
        $urlmiservicio = "http://localhost/_servWeb/serRecetas/Recetas.php?id=" . $id_receta;

        $data = ['id' => $id_receta];

        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($conexion, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);

        if ($res) {
            echo $res;
        }

        curl_close($conexion);
    }

    /**
     * Realiza una solicitud cURL para crear una nueva receta usando el método POST.
     *
     * @param string $titulo Título de la receta.
     * @param string $contenido Contenido de la receta.
     * @param int $categoria ID de la categoría de la receta.
     * @param int $rolusuario Rol del usuario que crea la receta.
     * @return void
     */
    function request_post($titulo, $contenido, $categoria, $rolusuario) {
        $envio = json_encode(array(
            "titulo" => $titulo,
            "contenido" => $contenido,
            "categoria" => $categoria,
            "rol_usuario" => $rolusuario
        ));

        $urlmiservicio = "http://localhost/_servWeb/serRecetas/Recetas.php";
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($conexion, CURLOPT_POST, TRUE);
        curl_setopt($conexion, CURLOPT_POSTFIELDS, $envio);
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($conexion);

        $respuesta = json_decode($res, true);

        echo $respuesta['resultado'];
    }
}
