<?php

class recetasView {

    /**
     * Muestra la cabecera de la vista de recetas.
     */
    public function cabecera() {
        echo '<h2>Lista de recetas</h2>';
        echo '<div>';
        echo '<a href="index.php?controller=Recetas&action=mostrarTodasLasRecetas">Principal</a>';
        echo '<a href="index.php?controller=Login&action=mostrarLogin">Login</a>';
        echo '</div>';
    }

    /**
     * Muestra las recetas en la vista de recetas.
     *
     * @param array $recetas Lista de recetas a mostrar.
     * @param array $categorias Lista de categorías de recetas.
     */
    public function mostrarRecetas($recetas, $categorias) {
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
                    echo '<p><strong>Categoría</strong> ' . $nombreCategoria . '</p>';
                }
            }
            $idreceta = $receta->getId();
            echo '<a href="index.php?controller=Recetas&action=mostrarInfoReceta&id=' . $idreceta . '" class="btn btn-primary">Ver más</a>';
            echo '</div>'; // card-body

            echo '<div class="card-footer text-muted">';
            echo 'Publicado el ' . $receta->getFechapublicacion();
            echo '</div>'; // card-footer

            echo '</div>'; // card
            echo '</div>'; // col-md-4
        }

        echo '</div>'; // row
    }
}
