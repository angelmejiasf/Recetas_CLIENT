<?php

class loginView {

    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @param string|null $error Mensaje de error opcional a mostrar.
     */
    public function mostrarLogin($error) {
        echo '<div class="container d-flex align-items-center justify-content-center">';
        echo '<div class="card" style="width: 20rem;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-center">Login</h5>';
        if ($error) {
            echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error) . '</div>';
        }
        echo '<form action="index.php?controller=Login&action=autenticar" method="POST">';
        echo '<div class="form-group">';
        echo '<label for="username">Usuario</label>';
        echo '<input type="text" class="form-control" id="username" name="username" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="password">Contraseña</label>';
        echo '<input type="password" class="form-control" id="password" name="password" required>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary btn-block">Login</button>';
        echo '</form>';
        echo "<br>";
        echo '<a href="index.php?controller=Recetas&action=mostrarTodasLasRecetas" class="btn btn-primary">Volver a la pagina principal</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
