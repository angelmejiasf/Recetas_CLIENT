<?php

require_once './services/UsuariosService.php';

class LoginController {

    private $view;
    private $service;
    private $viewUser;

    /**
     * Constructor de la clase LoginController. Inicializa las vistas y servicios necesarios.
     */
    public function __construct() {
        $this->view = new loginView();
        $this->service = new UsuariosService();
        $this->viewUser = new recetasView();
    }

    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @param string|null $error Mensaje de error opcional a mostrar.
     */
    public function mostrarLogin() {
        $error = isset($_GET['error']) ? $_GET['error'] : null;

        $this->viewUser->cabecera();
        $this->view->mostrarLogin($error);
    }

    /**
     * Autentica un usuario mediante el formulario de inicio de sesión.
     * Redirige al usuario según su rol.
     */
    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            // Convertir la contraseña ingresada en SHA-256
            $hashedPassword = hash('sha256', $password);

            $usuarios = $this->service->request_curl();

            if ($usuarios !== false) {
                foreach ($usuarios as $usuario) {
                    // Asume que los métodos getNombre_usuario y getContraseña existen en la clase Usuario
                    if ($usuario->getNombre_usuario() === $username && $usuario->getContraseña() === $hashedPassword) {

                        session_start();
                        $_SESSION['user_id'] = $usuario->getId();
                        $_SESSION['username'] = $usuario->getNombre_usuario();
                        $_SESSION['role'] = $usuario->getRol();
                        // Si el rol es de administrador 
                        if ($usuario->getRol() == 1) {
                            header("Location: index.php?controller=Recetas&action=mostrarRecetaAdmin");
                        } else {
                            header("Location: index.php");
                        }

                        exit();
                    }
                }
            }

            // Si no se encontró el usuario o las credenciales no coinciden
            header("Location: index.php?controller=Login&action=mostrarLogin");
            exit();

            // Si la autenticación falla, redirige de nuevo al login con un mensaje de error
            header("Location: index.php?controller=Login&action=mostrarLogin&error=Credenciales incorrectas");
            exit();
        }
    }

    /**
     * Cierra la sesión del usuario y redirige al formulario de inicio de sesión.
     */
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=Login&action=mostrarLogin");
        exit();
    }
}
