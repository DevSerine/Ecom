<?php
// Assurez-vous que session_start() est appelé au début de chaque page utilisant des sessions
session_start();

// Détruit toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également le cookie de session
// Note : cela détruira la session et non seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, on détruit la session
session_destroy();

// Affichez une alerte avec un message de déconnexion réussie
echo '<script>alert("Logout successful! Returning to the initial page."); window.location.href = "/php admin crud/first.php";</script>';
?>
