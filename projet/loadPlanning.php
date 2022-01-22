<?php
    include_once 'include/functions.inc.php';
    if(isset($_POST['mois']) && isset($_POST['annee'])){
        
        $valeurMois = intval($_POST['mois'], 10);
        $valeurAnnee = intval($_POST['annee'], 10);

        if($_POST['mois'] == "00" || $_POST['annee'] == '00'){

            header('Location: planning.php?erreur=wrongMouthOrYear');
        }
        else if(($valeurMois > 12 && $valeurMois < 1) || ($valeurAnnee > 2021 && $valeurAnnee < 2021)){

            header('Location: planning.php?erreur=wrongMouthOrYear');
        }
        else{

            $redirection = 'Location: planning.php?mois='.$_POST['mois'].'&annee='.$_POST['annee'];
            header($redirection);
        }
    }
    else{

        header('Location: planning.php?erreur=wrongMouthOrYear');
    }
?>