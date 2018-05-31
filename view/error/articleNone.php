<?php
$content = ob_start();

echo '<h2>Il n\'y a malheureusement aucun article à consulter sur le site pour le moment, merci de revenir plus tard !</h2>';

$content = ob_get_clean();
require '../view/templates/default.php';