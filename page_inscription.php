
<!-- Page d'Inscription d'un Patient -->

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
					<li><a href="index.php">ACCUEIL</a></li>
					<li class="active"><a href="page_connexion.php">ESPACE PATIENT</a></li>
					<li><a href="apropos.php">A PROPOS</a></li>
				</ul>
			</div>

			<div class="login-page">
				<div class="form">

					<!-- Formulaire d'Inscription -->

					<h2> Inscription </h2><br/>
					<form name="Page d'inscription" action="insertion_patient.php" methode=GET class="login">
						Mail<input type="text" name="mail" placeholder="exemple@mail.com" required>
						Comfirmer votre mail<input type="text" name="mail2" placeholder="exemple@mail.com" required>
						Nom<input type="text" name="nom" placeholder="Leroy" required>
						Prénom<input type="text" name="prenom" placeholder="Julien" required>
						Adresse<input type="text" name="adresse" placeholder="4 Rue du General de Gaulle, Lognes" required>
						Mot de Passe<input type='password' name='mdp' placeholder='Mot de passe'required>
						Comfirmer votre mot de Passe<input type='password' name='mdp2' placeholder='Mot de passe'required>
						<input type="submit" name="valider" value="Valider" class='valider'/>
						<p class="message">Vous êtes déja adhérent dans notre centre ? <a href="page_connexion.php"> Cliquez ici</a></p>
					</form>

				</div>
			</div>

		</header>
		<footer>
			<p>MILROY Ashley | RAVENDRAN Preanthy</p>
		</footer>
	</body>
</html>
