<?php

class recetasAdminView {

    public function cabecera() {
        echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
        echo '<a class="navbar-brand" href="#">Admin</a>';
        echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
        echo '<span class="navbar-toggler-icon"></span>';
        echo '</button>';
        echo '<div class="collapse navbar-collapse" id="navbarNav">';
        echo '<ul class="navbar-nav">';
        echo '<li class="nav-item active">';
        echo '<a class="nav-link" href="index.php?controller=Recetas&action=mostrarRecetaAdmin">Adminstrar Recetas <span class="sr-only">(current)</span></a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="index.php?controller=Recetas&action=mostrarFormInsertado">Añadir Receta</a>';
        echo '</li>';

        echo '</ul>';
        echo '<a href="index.php?controller=Login&action=logout" class="btn btn-warning">Cerrar Sesion</a>';
        echo '</div>';
        echo '</nav>';
    }

    public function mostrarRecetas($recetas, $categorias) {
        echo '<script>
            function confirmDelete(event) {
                if (!confirm("¿Estás seguro de que deseas eliminar esta receta?")) {
                    event.preventDefault();
                }
            }
        </script>';

        echo '<div class="row">';

        foreach ($recetas as $receta) {
            echo '<div class="col-md-4">';
            echo '<div class="card" style="width: 18rem;">';

            echo '<img src="data:image/jpeg;base64,' . $receta->getFoto() . '" class="card-img-top" style="width:288px;height:200px; alt="Imagen de la receta">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $receta->getTitulo() . '</h5>';
            echo '<p class="card-text">' . substr($receta->getContenido(), 0, 100) . '...</p>';
            foreach ($categorias as $categoria) {
                if ($categoria->getId() == $receta->getIdCategoria()) {
                    $nombreCategoria = $categoria->getNombre();
                    echo '<p><strong>Categoria</strong> ' . $nombreCategoria . '</p>';
                }
            }
            $idreceta = $receta->getId();
            echo '<a href="index.php?controller=Recetas&action=mostrarInfoRecetaAdmin&id=' . $idreceta . '" class="btn btn-primary">Ver más</a>';
            echo '<a href="index.php?controller=Recetas&action=mostrarFormActualizacion&id=' . $idreceta . '" class="btn btn-warning">Editar</a>';

            echo '<form action="index.php?controller=Recetas&action=eliminarReceta&id=' . $idreceta . '" method="post" style="display:inline;" onsubmit="confirmDelete(event);">';

            echo "<input type='hidden' name='id_receta' value='$idreceta'>";
            echo "<input type='submit' name='eliminar_receta' value='Eliminar' class='btn btn-danger'>";
            echo '</form>';
            echo '</div>'; // card-body



            echo '<div class="card-footer text-muted">';
            echo 'Publicado el ' . $receta->getFechapublicacion();
            echo '</div>'; // card-footer

            echo '</div>'; // card
            echo '</div>'; // col-md-4
        }

        echo '</div>'; // row
        //echo '</div>'; // container
    }

    public function mostrarFormActalizacion($inforeceta, $categorias) {

        echo "<form action='index.php?controller=Recetas&action=actualizarReceta' method='post' class='pasaje-form'>";
        
        echo '<img src="data:image/jpeg;base64,' . $inforeceta->getFoto() . '" class="card-img-top" alt="Imagen de la receta">';
        echo "<input type='hidden' name='id_receta' value='{$inforeceta->getId()}'>";

        echo "<label class='clase-label'>Titulo</label><br>";
        echo "<input type='text' name='titulo' value='{$inforeceta->getTitulo()}'><br>";

        echo "<label class='clase-label'>Contenido</label><br>";
        echo "<textarea name='contenido'>{$inforeceta->getContenido()}</textarea><br>";

        echo "<label class='clase-label'>Categoria</label><br>";
        echo "<select name='categoria'>";
        foreach ($categorias as $categoria) {

            echo "<option value='{$categoria->getId()}'>{$categoria->getNombre()}</option>";
        }
        echo "</select><br>";
        echo "<br>";

        echo "<input type='submit' name='actualizar_receta' value='Actualizar' class='submit-btn'><br>";

        echo "</form>";
        echo "<br>";
    }

    public function mostrarFormInsertado($categorias, $usuarios) {
        echo "<h2>Insertar Receta</h2>";
        echo "<form action='index.php?controller=Recetas&action=insertarReceta' method='post' class='pasaje-form'>";

        foreach ($usuarios as $usuario) {
            echo "<input type='hidden' name='rol_usuario' value='{$usuario->getRol()}'>";
        }

        echo "<label class='clase-label'>Titulo</label><br>";
        echo "<input type='text' name='titulo'><br>";

        echo "<label class='clase-label'>Contenido</label><br>";
        echo "<textarea name='contenido'></textarea><br>";

        echo "<label class='clase-label'>Categoria</label><br>";
        echo "<select name='categoria'>";
        foreach ($categorias as $categoria) {
            echo "<option value='{$categoria->getId()}'>{$categoria->getNombre()}</option>";
        }
        echo "</select><br>";
        echo "<br>";

        echo "<input type='submit' name='insertar_receta' value='Insertar' class='submit-btn'><br>";

        echo "</form>";
        echo "<br>";
    }

    public function botonVolver() {
        echo '<a href="index.php?controller=Recetas&action=mostrarRecetaAdmin" class="btn btn-primary">Volver</a>';
    }
}
