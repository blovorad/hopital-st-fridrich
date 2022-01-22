<?php

    session_start();
    if(isset($_SESSION['identifiant'])){

        unset($_SESSION['identifiant']);
    }
    if(isset($_SESSION['password'])){

        unset($_SESSION['password']);
    }

    header('Location: index.php');
?>