<?php 

$content = ob_start();

echo '<h1> Nom d\'utilisateur ou mot de passe invalide </h1>';
?>

<a href="/?page=login.php">Retournez sur le formulaire d'identification</a>

<?php

$content = ob_get_clean();
require '../view/templates/default.php';
