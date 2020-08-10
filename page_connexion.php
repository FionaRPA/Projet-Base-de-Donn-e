
<!-- Page de Connexion d'un Patient -->

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
					<li class="active"><a href="page_connexion.php">ESPACE PATIENT</a></li>
					<li><a href="apropos.php">A PROPOS</a></li>

				</ul>
			</div>

			<div class="login-page">
				<div class="form">

					<!--Formulaire de Connexion -->
					
					<form name="Page de connexion" methode=GET class="login">
						Mail<input type="text" name="mail" placeholder="exemple@mail.com" required>
						Mot de Passe<input type="password" name="mdp" placeholder="mot de Passe" required>
						<input type="submit" name="valider" value="Valider" class='valider'/>
						<p class="message">Première visite dans notre centre ? <a href="page_inscription.php">Cliquez ici</a></p>
					</form>
					<?php
						if (isset($_SESSION))
							header('refresh:3;url=page_patient.php');
						session_start();
						if(isset($_GET["valider"])) {
							if (empty($_GET['mail']) || empty($_GET['mdp'])){
								echo 'Tout les champs ne sont pas remplis...';
								header('refresh:3;url=connexion_patient.php');
							}
							else{
							    $_SESSION['mail'] = $_GET['mail'];
							    $_SESSION['mdp'] = $_GET['mdp'];
							}
							include('connexion.inc.php');

							$test_mail = FALSE;
							$test_mdp = FALSE;
							$mail = $_SESSION['mail'];
							$mdp = md5($_SESSION['mdp']);


							$sql = "SELECT * from patient";
							$resultat = $cnx->query($sql);

							foreach($resultat as $ligne){
								/* Vérifie si le mail et le mot de passe existe dans la base en parcourant la table Patient. */
								if ($ligne['mail'] == $mail && $ligne['mdp'] != $mdp)
									$test_mail = TRUE;
								
								else if ($ligne['mail'] != $mail && $ligne['mdp'] == $mdp)
									$test_mdp = TRUE;
								
								else if ($ligne['mail'] == $mail && $ligne['mdp'] == $mdp){
									$test_mail = TRUE;
									$test_mdp = TRUE;
									$_SESSION['nom'] = $ligne['nom'];
									$_SESSION['prenom'] = $ligne['prenom'];
									$_SESSION['ipu'] = $ligne['ipu'];
								}
							}
							/* S'ils n'existent pas alors on renvoie un essage d'erreur. */
							if ($test_mail == FALSE || $test_mdp == FALSE){
								echo "<p>Mail ou Mot de passe incorrect...</p>";
								header('refresh:3;url=page_connexion.php');
							}

							/* S'ils existent et qu'ils correspondent aux résultats de la requête alors l'authentification ce fais*/
							else if ($test_mail == TRUE && $test_mdp == TRUE){
								echo "<p>Authentification réussie</p>";
								header("refresh:2;url=page_patient.php");
							}
							
							else{
								echo "<p>Authentification échouée...</p>";	
								header("refresh:3;url=page_connexion.php");
							}

						}
					?>
				</div>
			</div>
		</header>
		<footer>
			<p>MILROY Ashley | RAVENDRAN Preanthy</p>
		</footer>
	</body>
</html>