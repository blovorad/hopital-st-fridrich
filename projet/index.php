<?php
	$titre = "Hôpital Saint Fridrich - intranet";
	$description = "Site interne pour l'hôpital Saint Fridrich ou chaque employé peut consulter les informations qui le concerne";
	include_once 'include/header.inc.php';
	include_once 'include/util.inc.php';

	/*pour mdp toto
	 doit être egal a 
	 $5$rounds=5000$celacgelercacheu$sFbtF2YljEHyw9.B0bt1Sstr46GQqTiJ4L9Vy6hpU41
	 et identifiant test
	 */
?>	

<div class="content">
	<section id="wrapper">
		<h1>Hôpital Saint Fridrich</h1>
		<form action="checkingConnection.php" method="POST">
			<input type="text" name="identifiant" placeholder="identifiant" autofocus>
			<input type="password" name="password" placeholder="mot de passe">
			<input style="  background: #43434C; color: #FFFEFC; cursor: pointer"type="submit" value="connexion">
		</form>
		<?php
			if(isset($_GET['erreur'])){

				echo "\n\t<p>Identifiant et/ou mot de passe incorrecte</p>\n";
			}
		?>

		<script>
			src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"
			$(function() 
			{
				$('#submit').click(function()
				{
					$(this).attr("disabled", "disabled");
				});
			});
		</script>
	</section>
</div>


<?php
	include_once 'include/footer.inc.php';
?>	