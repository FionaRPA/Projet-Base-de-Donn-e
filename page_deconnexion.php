

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
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
					<li><a href="index.php">ACCUEIL</a></li>
					<li><a href="page_connexion.php">ESPACE PATIENT</a></li>
					<li><a href="index.php">A PROPOS</a></li>
				</ul>
			</div>

			<div class="affiche">
				<?php
				session_start();
				$_SESSION = array();
				session_unset();
				session_destroy();

				echo '<h2>Vous êtes à présent déconnecté <br>
				Cliquez <a style="color:white;"href="./index.php">ici</a> pour revenir à la page principale</h2>';

				echo '</div></body></html>';

				?>
			</div>
		</header>
		<footer>
			<p>MILROY Ashley | RAVENDRAN Preanthy</p>
		</footer>
	</body>
</html>