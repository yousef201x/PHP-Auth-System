<?php

// Check if the 'userId' key is empty in the session.
if (empty($_SESSION['userId'])) {
    // If the current script is neither 'login.php' nor 'signup.php', redirect to 'login.php'.
    $currentScript = basename($_SERVER['PHP_SELF']);
    if ($currentScript !== 'login.php' && $currentScript !== 'signup.php') {
        header('location: login.php');
        exit();
    }
} else {
    // If the 'userId' key is not empty in the session.
    // If the current script is not 'index.php', redirect to 'index.php'.
    if (basename($_SERVER['PHP_SELF']) == 'login.php' && $currentScript !== 'signup.php') {
        header('location: index.php');
        exit();
    }
}
