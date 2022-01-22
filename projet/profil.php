<?php
  session_start();
	$titre = "Hôpital Saint Fridrich - ";//$nomEmployer $prenomEmployer";
	$description = "Partis qui concerne l'affichage des informations personnel de l'employé";
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

  <div class="container" style="margin-top:30px">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="./images/imgProfil.png" alt="profil_Image" class="rounded-circle" width="150"/>
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
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nom</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                        echo $value['nom'];
                      ?>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Prenom</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                        echo $value['prenom'];
                      ?>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                        echo $value['mail'];
                      ?>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Téléphone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                        echo $value['telephone'];
                      ?>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Adresse</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                        echo $value['adresse'];
                      ?>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Fonction</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                        $value['fonction'] = str_replace('_', ' ', $value['fonction']);
                        echo $value['fonction'];
                      ?>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Service</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                        $serviceName = getServiceOfUser($_SESSION['identifiant'], $_SESSION['password']);
                        echo $serviceName;
                      ?>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="edit_profil.php">Edit</a>
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