<?php
    session_start();
	$titre = "Hôpital Saint Fridrich - ";//$nomEmployer $prenomEmployer";
	$description = "Partis qui concerne la modification des informations personnel de l'employé";
	include_once 'include/header.inc.php';
	include_once 'include/util.inc.php';
?>	

<?php 

  if(!isset($_SESSION['identifiant'])){

    header('Location: index.php');
  }
  include_once 'include/functions.inc.php';
  $value = getInformationAboutUser($_SESSION['identifiant'], $_SESSION['password']);
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

    <div class="container" style="margin-top:30px; margin-bottom:30px">
    <div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="account-settings">
                <div class="user-profile">
                    <div class="user-avatar">
                        <img src="./images/imgProfil.png" alt="profil_Image"/>
                    </div>
                    <div class="mt-3">
                        <?php
                            echo "<h1>".$value['prenom']."</h1>";
                            $role = getRoleOfUser($_SESSION['identifiant'], $_SESSION['password']);
                            echo "<p class=\"text-secondary mb-1\">".$role."</p>";
                            echo "<p class=\"text-muted font-size-sm\">Hôpital Saint Fridrich</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Modification adresse mail ou telephone</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <form action="checking_profilChange.php" method="POST">
                        <div class="form-group">
                            <label for="mail">Email</label>
                            <input type="email" class="form-control" name="mail"  placeholder="Entrer votre email"/>
                            <button type="submit" class="btn btn-primary">valider</button>
                        </div>
                    </form>
                    <!--ici on met si erreur dans formulaire mail-->
                    <?php
                        if(isset($_GET['mailError'])){

                            echo "\n\t<h6 style=\"color:red\" class=`\"mb-2 text-primary\">Erreur adresse mail invalide</h6>\n";
                        }
                        else if(isset($_GET['mailGood'])){

                            echo "\n\t<h6 style=\"color:green\" class=`\"mb-2 text-primary\">Modification effectuée</h6>\n";
                        }
		            ?>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <form action="checking_profilChange.php" method="POST">
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" class="form-control" name="telephone" placeholder="Entrer votre numéro de téléphone"/>
                            <button type="submit" class="btn btn-primary">valider</button>
                        </div>
                    </form>
                    <!--ici on met si erreur dans formulaire téléphone-->
                    <?php
                        if(isset($_GET['telephoneError'])){

                            echo "\n\t<h6 style=\"color:red\" class=`\"mb-2 text-primary\">Erreur numéro de téléphone invalide</h6>\n";
                        }
                        else if(isset($_GET['telephoneGood'])){

                            echo "\n\t<h6 style=\"color:green\" class=`\"mb-2 text-primary\">Modification effectuée</h6>\n";
                        }
		            ?>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                        <a type="button" href="profil.php" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

</section>

<?php
	include_once 'include/footer.inc.php';
?>