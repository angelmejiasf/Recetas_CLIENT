<?php

include_once './Services/RecetasService.php';
include_once './Services/categoriasService.php';
include_once './views/recetasInfoView.php';
include_once './Services/PasosService.php';
include_once './views/recetasAdminView.php';

class RecetasController {

    private $view;
    private $service;
    private $categoriaService;
    private $viewInfoReceta;
    private $pasosService;
    private $viewAdminReceta;
    private $serviceUsuarios;

    /**
     * Constructor de la clase RecetasController. Inicializa las vistas y servicios necesarios.
     */
    public function __construct() {
        $this->service = new RecetasService();
        $this->view = new recetasView();
        $this->categoriaService = new categoriasService();
        $this->viewInfoReceta = new recetasInfoView();
        $this->pasosService = new PasosService();
        $this->viewAdminReceta = new recetasAdminView();
        $this->serviceUsuarios = new UsuariosService();
    }

    /**
     * Muestra todas las recetas disponibles junto con sus categorías.
     */
    public function mostrarTodasLasRecetas() {
        $recetas = $this->service->request_curl();
        $categorias = $this->categoriaService->request_curl();

        $this->view->cabecera();
        $this->view->mostrarRecetas($recetas, $categorias);
    }

    /**
     * Muestra la información detallada de una receta.
     */
    public function mostrarInfoReceta() {
        if (isset($_GET['id'])) {
            $idreceta = $_GET['id'];
            $inforeceta = $this->service->obtenerRecetaPorId($idreceta);
            $categorias = $this->categoriaService->request_curl();
            $pasos = $this->pasosService->request_curl();

            $this->view->cabecera();
            $this->viewInfoReceta->mostrarInfoReceta($inforeceta, $categorias, $pasos);
            $this->viewInfoReceta->botonVolver();
        }
    }

    /**
     * Muestra la información detallada de una receta en el panel de administración.
     */
    public function mostrarInfoRecetaAdmin() {
        if (isset($_GET['id'])) {
            $idreceta = $_GET['id'];
            $inforeceta = $this->service->obtenerRecetaPorId($idreceta);
            $categorias = $this->categoriaService->request_curl();
            $pasos = $this->pasosService->request_curl();

            $this->viewAdminReceta->cabecera();
            $this->viewInfoReceta->mostrarInfoReceta($inforeceta, $categorias, $pasos);
            $this->viewAdminReceta->botonVolver();
        }
    }

    /**
     * Muestra las recetas en el panel de administración.
     */
    public function mostrarRecetaAdmin() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            header("Location: index.php?controller=Login&action=mostrarLogin");
            exit();
        }

        $recetas = $this->service->request_curl();
        $categorias = $this->categoriaService->request_curl();
        $this->viewAdminReceta->cabecera();
        $this->viewAdminReceta->mostrarRecetas($recetas, $categorias);
    }

    /**
     * Muestra el formulario de actualización de una receta en el panel de administración.
     */
    public function mostrarFormActualizacion() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            header("Location: index.php?controller=Login&action=mostrarLogin");
            exit();
        }
        // Verificar si el id está presente en la URL
        if (isset($_GET['id'])) {
            $idreceta = $_GET['id'];
            $inforeceta = $this->service->obtenerRecetaPorId($idreceta);
            $categorias = $this->categoriaService->request_curl();

            $this->viewAdminReceta->cabecera();
            $this->viewAdminReceta->mostrarFormActalizacion($inforeceta, $categorias);
            $this->viewAdminReceta->botonVolver();
        }
    }

    /**
     * Actualiza una receta en la base de datos.
     */
    public function actualizarReceta() {
        if (isset($_POST['actualizar_receta'])) {
            // Obtener los datos del formulario
            $id = $_POST['id_receta'];
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $id_categoria = $_POST['categoria'];

            // Llamar a la función para actualizar la receta en el servicio correspondiente
            $this->service->request_put($id, $titulo, $contenido, $id_categoria);
            $this->mostrarRecetaAdmin();
        }
    }

    /**
     * Elimina una receta de la base de datos.
     */
    public function eliminarReceta() {
        if (isset($_POST['eliminar_receta'])) {
            // Obtener los datos del formulario
            $id_receta = $_GET['id'];

            // Llamar a la función para eliminar la receta en el servicio correspondiente
            $this->service->request_delete($id_receta);
            $this->mostrarRecetaAdmin();
        }
    }

    /**
     * Inserta una nueva receta en la base de datos.
     */
    public function insertarReceta() {
        try {
            $resultado = $this->service->request_post($_POST["titulo"], $_POST["contenido"], $_POST["categoria"], $_POST['rol_usuario']);
            echo $resultado;
            $this->mostrarRecetaAdmin();
        } catch (Exception $exc) {
            error_log("Excepción capturada: " . $exc->getMessage());
            echo $exc->getMessage();
        }
    }

    /**
     * Muestra el formulario para insertar una nueva receta en el panel de administración.
     */
    public function mostrarFormInsertado() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            header("Location: index.php?controller=Login&action=mostrarLogin");
            exit();
        }

        $categorias = $this->categoriaService->request_curl();
        $usuarios = $this->serviceUsuarios->request_curl();
        $this->viewAdminReceta->cabecera();
        $this->viewAdminReceta->mostrarFormInsertado($categorias, $usuarios);
        $this->viewAdminReceta->botonVolver();
    }
}
