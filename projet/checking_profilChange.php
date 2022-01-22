<?php
    session_start();
    include_once 'include/functions.inc.php';

    $mailChange = 0;
    $telephoneChange = 0;

    if(isset($_POST['mail'])){

        //echo $_POST['mail'];
        $mailChange = checkMailChange($_POST['mail']);
    }
    if(isset($_POST['telephone'])){

        //echo $_POST['telephone'];
        $telephoneChange = checkTelephoneChange($_POST['telephone']);
        //echo $telephoneChange;
    }

    if($mailChange == 1){

        header('Location: edit_profil.php?mailError');
    }
    else if($mailChange == 2){

        updateMail($_SESSION['identifiant'], $_SESSION['password'], $_POST['mail']);
        header('Location: edit_profil.php?mailGood');
    }
    if($telephoneChange == 1){

        header('Location: edit_profil.php?telephoneError');
    }
    else if($telephoneChange == 2){

        updatePhone($_SESSION['identifiant'], $_SESSION['password'], $_POST['telephone']);
        header('Location: edit_profil.php?telephoneGood');
    }
?>