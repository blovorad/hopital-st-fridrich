<?php
	include_once 'include/functions.inc.php';

	if(isset($_POST["identifiant"]) && isset($_POST["password"])){
		
		$result = checkIdentifiant($_POST["identifiant"], $_POST["password"]);
		if($result == false){

			header('Location: index.php?erreur=wrongLogin');
		}
        else{
			
			session_start();
			$_SESSION['identifiant'] = $_POST["identifiant"];
			$_SESSION['password'] = crypt($_POST['password'], '$5$rounds=5000$celacgelercacheu$');
	 
            header('Location: profil.php');
        }
	}
	else{

		header('Location: index.php?erreur=noLogin');
	}
?>