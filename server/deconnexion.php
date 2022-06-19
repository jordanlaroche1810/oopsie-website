<?php
    session_start();
    session_unset();
    $_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';
    header('Location: ../index.php');
?>