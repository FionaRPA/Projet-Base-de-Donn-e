
<!-- Page d'Accueil du Centre Médical pour le Patient-->

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>CENTRE MEDICAL</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="shortcut icon" href="image/logo.ico">
	</head>
	<body> 
		<header>
			<div class="row">
				<div class="logo">
					<a href="page_patient.php">
						<img src="image/log.png">
					</a>
				</div>

				<ul class="main-nav">
					<li class="active"><a href="page_patient.php">ACCUEIL</a></li>
					<li><a href="page_sej_bien.php">VOS SÉJOUR</a></li>
					<li><a href="page_deconnexion.php">DECONNEXION</a></li>
					
				</ul>
			</div>

			<div class="here">
			<?php 

				if (!isset($_SESSION))
					session_start();

				/* Affiche un message d'erreur lorsque l'utilisateur n'est pas connecté. */
				if ($_SESSION == array()){
					echo "<h2 class='pascnx'> Vous n'êtes pas connectés <br> Vous serez redirigez sur la page d'accueil de notre site.</h2>";
					header('refresh:3;url=index.php');
				}
				/* Sinon, on affiche un message de bienvenue contenant son nom et son prénom */
				else{
					echo "<h1 class='bienvenue'> Bienvenue <br>",$_SESSION['nom'], " ",$_SESSION['prenom'],"</h1>";
				}
			?>
				<h1> CENTRE MEDICAL </h1>
				<h2>
					
					<li>Trouvez nous au:
					<br>40 Boulevard Descartes 75006 Paris</li>
					<br><br>
					<li>Contactez nous au:
					<br>01.65.32.65.26</li>
					<br><br>
					<li>Horaire d'ouverture:
					<br>Lundi-Vendredi: 8h00-19h00
					<br>Samedi: 8h00-17h30 </li>
					<br><br>
				</h2>
			</div>

		</header>
		<footer>
			<p>MILROY Ashley | RAVENDRAN Preanthy</p>
		</footer>
	</body>
</html>