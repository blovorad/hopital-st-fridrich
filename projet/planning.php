<?php
  session_start();
	$titre = "Hôpital Saint Fridrich - ";//$nomEmployer $prenomEmployer";
	$description = "Partis qui concerne l'affichage du planning de l'employé";
	include_once 'include/header.inc.php';
	include_once 'include/util.inc.php';
  include_once 'include/functions.inc.php';
?>

<?php 

  if(!isset($_SESSION['identifiant'])){

    header('Location: index.php');
  }
    if(isset($_GET['mois']) && isset($_GET['annee'])){

      $valeurMois = intval($_GET['mois'], 10);
      $valeurAnnee = intval($_GET['annee'], 10);
      if(($valeurMois > 12 || $valeurMois < 1) || ($valeurAnnee > 2021 || $valeurAnnee < 2021)){

        header('Location: planning.php?erreur=wrongMouthOrYear');
      }
      $mois = $_GET['mois'];
      $annee = $_GET['annee'];
      $planning = getPlanning($_SESSION['identifiant'], $mois, $annee);
    }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">

	<a class="navbar-brand me-2">
      <img
        src="./images/imgProfil.png"
        height="30"
        alt="imgProfil"
        loading="lazy"
        style="margin-top: -1px;"
      />
    </a>

    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="profil.php">Mon profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="planning.php">Planning</a>
        </li>
		    <li class="nav-item">
          <a class="nav-link" href="deconnection.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<section class="content">

	<h1 style="text-align:center">Planning Employé</h1>

  <form action="loadPlanning.php" method="POST">
    <select style="margin-left:36%" name="mois" id="mois-select">
        <option value="00">--Choix du mois--</option>
        <option value="01">Janvier(01)</option>
        <option value="02">Février(02)</option>
        <option value="03">Mars(03)</option>
        <option value="04">Avril(04)</option>
        <option value="05">Mai(05)</option>
        <option value="06">Juin(06)</option>
        <option value="07">Juillet(07)</option>
        <option value="08">Août(08)</option>
        <option value="09">Septembre(09)</option>
        <option value="10">Octobre(10)</option>
        <option value="11">Novembre(11)</option>
        <option value="12">Décembre(12)</option>
    </select>
    <select style="margin-left:2%" name="annee" id="annee-select">
        <option value="00">--Choix de l'annee--</option>
        <option value="2021">2021</option>
    </select>
    <input type="submit" value="afficher planning"/>
  </form>

  <table style="margin-top:30px" class="table table-hover">
  <?php
    if(isset($planning)){

      $donnee = pg_fetch_array($planning);
      $moisCode = substr($donnee['date'], 5, 2);
      switch($moisCode){

        case '02' :
          $mois = "Février";
          break;
        case '03' :
          $mois = "Mars";
          break;
        case '04' :
          $mois = "Avril";
          break;
        case '05' :
          $mois = "Mai";
          break;
        case '06' :
          $mois = "Juin";
          break;
        case '07' :
          $mois = "Juillet";
          break;
        case '08' :
          $mois = "Août";
          break;
        case '09' :
          $mois = "Septembre";
          break;
        case '10' :
          $mois = "Octobre";
          break;
        case '11' :
          $mois = "Novembre";
          break;
        case '12' : 
          $mois = "Décembre";
          break;
        default :
          $mois = "Janvier";
      }
      echo "<caption style=\"text-align:center\">Planning du mois de ".$mois."</caption>";
    }
  ?>
  <thead>
    <tr>
      <th>Jour</th>
      <th>Horaire</th>
      <th>Consultation</th>
    </tr>
  </thead>
  <tbody>
    <?php

      if(isset($planning)){

        while($donnee != false){

          $currentMois = substr($donnee['date'], 5, 2);
          $currentHoraire = $donnee['heure'];
          $currentJour = substr($donnee['date'], 8, 2);
          $date = $donnee['date'];
          $jour = $currentJour;
          echo "<tr>";
          echo "<th>".$jour."</th>";
          $horaireJour = array(1 =>"n", 2 =>"n", 3=>"n", 4 =>"n", 5 =>"n", 6 =>"n", 7 =>"n", 8 =>"n", 9 =>"n", 10 =>"n", 11 =>"n", 12 =>"n", 13 =>"n", 14 =>"n", 15 =>"n", 16 =>"n", 17 =>"n", 18 =>"n", 19 =>"n", 20 =>"n", 21 =>"n", 22 =>"n", 23 =>"n", 24 =>"n");

          while($donnee != false && $currentJour == substr($donnee['date'], 8, 2)){
            
            $currentHoraire = $donnee['heure'];
            $horaireValue = intval($currentHoraire, 10);
            if($horaireValue == 0){

              $horaireValue = 24;
            }

            $horaireJour[$horaireValue] = "y";
            $donnee = pg_fetch_array($planning);
            /*$horaireFinValue = intval($horaireFin, 10);
            if($horaireFinValue == 0){
              
              $horaireFinValue = 24;
            }
            $horaireFin = $donnee['heure'];
            if(intval($horaireFin, 10) > $horaireFinValue + 2){

              echo " ".$horaireDebut."h à ".$horaireFinValue."h\n";
              $horaireDebut = $donnee['heure'];
              $horaireFin = $donnee['heure'];
            }
            $currentJour = substr($donnee['date'], 8, 2);
            if($currentJour != substr($donnee['date'], 8, 2)){

              echo " ".$horaireDebut."h à ".$horaireFinValue."h\n";
            }*/
          }
          $horaireDebut = "n";
          //echo "<td>";
          for($i=1;$i<25;$i++){

            if($horaireDebut == "n" && $horaireJour[$i] == "y"){

              $horaireDebut = $i;
            }
            else if($horaireJour[$i] == "y"){

              $horaireFin = $i;
            }
            /*else if($i>1 && $horaireJour[$i] == "n" && $horaireJour[$i - 1] == "y"){

              echo "".$horaireDebut."h à ".$horaireFin."h";
              $horaireDebut = "n";
            }*/
          }
          echo "<td>".$horaireDebut."h à ".$horaireFin."h</td>";
         //echo "</td>";

          $patientIdArray = getConsultationIdPatient($_SESSION['identifiant'], $date);
          if($patientIdArray != false){

            $idPatient = pg_fetch_array($patientIdArray);
            echo "<td>";
            if($idPatient != false){

              echo $idPatient['id_patient'];
              while($idPatient != false){

                $idPatient = pg_fetch_array($patientIdArray);
                if($idPatient != false){

                  echo ",".$idPatient['id_patient'];
                }
              }
            }
            else{

              echo "non";
            }
            echo "</td>";
          }
          else{

            echo "<td>Non</td>";
          }
          echo "</tr>";
        }
      }
    ?>
  </tbody>
</table>

</section>

<?php
	include_once 'include/footer.inc.php';
?>	