<?php

use App\Repository\DBAuthRepository as DBAuth;

$content = ob_start();

echo '<h1>Login</h1>';

$auth = new DBAuth();
if (isset($_POST['username'])) {
    $auth = $auth->login();
    
    if ($auth === true) {
        die('Connecté');
    } /*else {
        die('Pas connecté');
    }*/
}

?>

<form method="POST" action="/?page=login">
    <label>Utilisateur</label><br/><input type="text" name="username"><br/>
    <label>Mot de passe</label><br/><input type="password" name="password"><br/>
    <br/><input type="submit" value="Valider">
</form>

<?php

$content = ob_get_clean();
require '../view/templates/default.php';