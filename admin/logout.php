<?php 
    session_start();          // START The Session
    session_unset();         // DESTROY The Data & Cookies
    session_destroy();      // DESTROY The Session To Logout

    header('Location: index.php');
    exit();
?>