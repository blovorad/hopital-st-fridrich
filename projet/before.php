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
                    <h5 class="user-name">Gautier</h5>
                    <h6 class="user-email">gautier@hotmail.fr</h6>
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
                    <h6 class="mb-2 text-primary">Détails personnel</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="mail">Email</label>
                        <input type="mail" class="form-control" id="mail" placeholder="Entrer votre email">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" class="form-control" id="phone" placeholder="Entrer votre numéro de téléphone">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Adresse</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="rue">Rue</label>
                        <input type="name" class="form-control" id="rue" placeholder="Entrer votre rue">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="code_postale">Code postale</label>
                        <input type="name" class="form-control" id="code_postale" placeholder="Entrer votre code postale">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="name" class="form-control" id="ville" placeholder="Entrer votre ville">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                        <button type="button" id="submit" name="submit" class="btn btn-secondary">Retour</button>
                        <button type="button" id="submit" name="submit" class="btn btn-primary">Appliquer</button>
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