
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

			<div class="login-page">
				<?php
					if (!isset($_SESSION))
						session_start();
					
					include('connexion.inc.php');

					// Si on appuie sur le bouton Supprimer alors le bien selectionné est supprimer.
					if ($_SESSION == array()){
						echo "<h2 class='pascnx'> Vous n'êtes pas connectés <br> Vous serez redirigez sur la page d'accueil de notre site.</h2>";
						header('refresh:3;url=index.php');
					}
					/* Sinon, on affiche le nom et le prénom du patient connecté */
					else{
						if(isset($_GET["supp"])) {
							$id = $_GET["idb"];
							$sql = "DELETE FROM bien WHERE id_bien = ".$id;
							echo $sql ;	    
							//exécution de la requête:
							$requete = $cnx->query($sql) ;
							if($requete){
								echo "<br/>\n";
								echo "<h2>Vous pouvez venir récupérer votre bien quand vous le souhaitez<br>Le bien selecionné a bien été supprimé de la base .<br/></h2>\n";
								header('refresh:3;url=page_sej_bien.php');
							}
						}

						// Si on appuie sur le bouton Modifier alors le bien selectionné sera modifier à l'aide d'un formulaire. 

						if(isset($_GET["modif"])) {
							$nomb = $_GET["bien"];
							$idb = $_GET["idb"];
							$num_sej = $_GET["sej"];
							$_SESSION["nomb"] = $nomb;
							$_SESSION["idb"] = $idb;


							$sql = "SELECT * FROM $nomb NATURAL JOIN bien NATURAL JOIN sejour WHERE id_bien = $idb and ipu = $_SESSION[ipu]";
							$result = $cnx->query($sql);
					
							//exécution de la requête:
							
							//affichage des données:
							while($requete = $result->fetch(PDO::FETCH_ASSOC)){
							
								echo '<div class="form"><h2> Modification </h2><br/>
								<form name="Modification" action="modification.php" method="GET" class="login">
									<table align="center">

									<p>description <br></p>
									<textarea style="width:270px; height:70px;" name="description">'.$requete["description"].'</textarea>';
										
									if ($nomb == "effet"){
										
								echo '<p>type <br></p>
										<input type="text" name="type" value="'.$requete["type"].'">';

									} if ($nomb == "bijou"){
								echo '<p>estimation_max <br></p>
										<input type="text" name="estimation_max" value="'.$requete["estimation_max"].'">
									<p>estimation_min <br></p>
										<input type="text" name="estimation_min" value="'.$requete["estimation_min"].'">';

								} if ($nomb == "chequier"){
								echo '<p>nom_banque <br></p>
										<input type="text" name="nom_banque" value="'.$requete["nom_banque"].'">
									<p>num_dernier_ch <br></p>
										<input type="text" name="num_dernier_ch" value="'.$requete["num_dernier_ch"].'">';

								} if ($nomb == "liquidite"){

								echo '<p>montant <br></p>
										<input type="text" name="montant" value="'.$requete["montant"].'">
									<p>devise <br></p>
										<input type="text" name="devise" value="'.$requete["devise"].'">';

								} if ($nomb == "objet_bancaire"){

								echo '<tr align="center">
										<p>nom banque <br></p>
										<input type="text" name="nom_banque" value="'.$requete["nom_banque"].'">
									<p>num carte <br></p>
										<input type="text" name="num_carte" value="'.$requete["num_carte"].'">';
								}
								echo '<input type="submit" name="valide" value="Valider" class="valider">
									</table></form></div>';
							}
						}
					}
					
				?>
			</div>
		</header>
		<footer>
			<p>MILROY Ashley | RAVENDRAN Preanthy</p>
		</footer>
	</body>
</html>