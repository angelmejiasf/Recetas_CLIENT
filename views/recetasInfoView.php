<?php

class recetasInfoView {

    /**
     * Muestra la información detallada de una receta.
     *
     * @param object $inforeceta Información de la receta.
     * @param array $categorias Lista de categorías de recetas.
     * @param array $pasos Lista de pasos de la receta.
     */
    public function mostrarInfoReceta($inforeceta, $categorias, $pasos) {
        echo '<div class="card" style="auto;">';
        echo '<div class="card-body" style="auto;">';

        echo '<img src="data:image/jpeg;base64,' . $inforeceta->getFoto() . '" class="card-img-top" style="width:300px;height:200px; alt="Imagen de la receta">';
        echo '<h5 class="card-title">' . $inforeceta->getTitulo() . '</h5>';

        echo '<p class="card-text">' . $inforeceta->getContenido() . '</p>';

        foreach ($categorias as $categoria) {
            if ($categoria->getId() == $inforeceta->getIdCategoria()) {
                $nombreCategoria = $categoria->getNombre();
                echo '<p><strong>Categoría</strong> ' . $nombreCategoria . '</p>';
            }
        }
        echo '<h6>Pasos</h6>';
        echo '<ul>';
        foreach ($pasos as $paso) {
            if ($paso->getId_receta() == $inforeceta->getId()) {
                echo '<li>' . $paso->getDescripcion() . '</li>';
            }
        }
        echo '</ul>';

        echo '</div>';
        echo '</div>';
    }

    /**
     * Muestra un botón para volver a la lista de recetas.
     */
    public function botonVolver() {
        echo '<a href="index.php?controller=Recetas&action=mostrarTodasLasRecetas" class="btn btn-primary">Volver</a>';
    }
}
