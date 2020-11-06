<?php


class errorController
{
    public function Index() {
        echo '<div class="contenedor error404">
                <h1 class="error404">Page Not Found</h1>
                <p class="error404">Sorry, but the page you were trying to view does not exist.</p>
            </div>';

    }

    public  static function showError() {
        $error = new errorController();
        $error->Index();
    }
}