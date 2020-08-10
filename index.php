
<!-- Page d'Accueil du Centre Médical -->

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
					<a href="index.php">
						<img src="image/log.png">
					</a>
				</div>
				<ul class="main-nav">
					<li class="active"><a href="index.php">ACCUEIL</a></li>
					<li><a href="page_connexion.php">ESPACE PATIENT</a></li>
					<li><a href="apropos.php">A PROPOS</a></li>
				</ul>
			</div>
			<?php
				if (isset($_SESSION))
					header('refresh:3;url=page_patient.php');
			?>
			<div class="here">
				<!-- Information sur le Centre -->
				<h1> CENTRE MÉDICAL </h1>
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