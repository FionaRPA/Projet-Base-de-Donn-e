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
					<a href="page_patient.php">
						<img src="image/log.png">
					</a>
				</div>

				<ul class="main-nav">
					<li><a href="page_patient.php">ACCUEIL</a></li>
					<li class="active"><a href="page_sej_bien.php">VOS SÉJOUR</a></li>
					<li><a href="index.php">DECONNEXION</a></li>
					<?php 
						if (!isset($_SESSION))
							session_start();
						if ($_SESSION != array()){
							echo "<li class='nom'>Compte de <br>",$_SESSION['prenom'], " ",$_SESSION['nom'],"</li>";
						}
					?>
				</ul>
			</div>

			<?php
				if (!isset($_SESSION))
					session_start();
				include('connexion.inc.php');

				if(isset($_GET["valide"])) {
					$nomb = $_SESSION["nomb"];
					$idb = $_SESSION["idb"];

					if ($nomb == "effet"){
						//type:
						$type = $_GET["type"];
						$sql = "UPDATE effet SET type = '$type' WHERE id_bien = '$idb' " ;
					}
					if ($nomb == "bijou"){
						//estimation_min:
						$estimation_min = $_GET["estimation_min"];
						//estimation_max:
						$estimation_max = $_GET["estimation_max"];
						$sql = "UPDATE bijou SET estimation_max = '$estimation_max', estimation_min = '$estimation_min' WHERE id_bien = '$idb' " ;
					}
					if ($nomb == "chequier"){
						//nom_banque:
						$nom_banque = $_GET["nom_banque"];
						//num_dernier_ch:
						$num_dernier_ch = $_GET["num_dernier_ch"];
						$sql = "UPDATE chequier SET nom_banque='$nom_banque', num_dernier_ch='$num_dernier_ch' WHERE id_bien = '$idb' " ;
					}
					if ($nomb == "liquidite"){
						//montant:
						$montant = $_GET["montant"];
						//devise:
						$devise = $_GET["devise"];
						$sql = "UPDATE liquidite SET montant = '$montant' devise = '$devise' WHERE id_bien = '$idb' " ;
					}
					if ($nomb == "objet_bancaire"){
						//nom_banque:
						$nom_banque = $_GET["nom_banque"];
						//num_carte:
						$num_carte = $_GET["num_carte"];
						$sql = "UPDATE objet_bancaire SET nom_banque = '$nom_banque', num_carte = '$num_carte' WHERE id_bien = '$idb' " ;
					}
					
					//exécution de la requête SQL:
					$res = $cnx->query($sql) or die($cnx->error()) ;
				 
				 
					//affichage des résultats, pour savoir si la modification a marchée:
					if($res)
					{
					  echo("<h2 class='pascnx'>La modification à été correctement effectuée</h2>") ;
					  header('refresh:3;url=page_sej_bien.php');
					}
					else
					{
					  echo("<h2 class='pascnx'>La modification à échouée</h2>") ;
					  header('refresh:3;url=page_sej_bien.php');

					}
				}
				else{
					echo "<h2 class='pascnx'>marche pas /h2>";
					header('refresh:3;url=page_sej_bien.php');

				}
			?>
		</header>
		<footer>
			<p>MILROY Ashley | RAVENDRAN Preanthy</p>
		</footer>
	</body>
</html>