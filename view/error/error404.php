<?php
$content = ob_start();

echo '<h1> Erreur 404 : Page introuvable </h1>';

$content = ob_get_clean();
require '../view/templates/default.php';