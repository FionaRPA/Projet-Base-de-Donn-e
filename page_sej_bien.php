
<!-- Page d'Historique du Patient -->

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
					<li><a href="page_deconnexion.php">DECONNEXION</a></li>
					<?php 
						if (!isset($_SESSION))
							session_start();

						/* Affiche un message d'erreur lorsque l'utilisateur n'est pas connecté. */
						if ($_SESSION == array()){
							header('refresh:3;url=index.php');
						}
						/* Sinon, on affiche le nom et le prénom du patient connecté */
						else{
							echo "<li class='nom'>Compte de <br>",$_SESSION['prenom'], " ",$_SESSION['nom'],"</li>";
						}
					?>
				</ul>
			</div>

			<div class="affiche">
				<?php
					if ($_SESSION == array()){
						echo "<h2 style='color:white;' class='pascnx'> Vous n'êtes pas connectés <br> Vous serez redirigez sur la page d'accueil de notre site.</h2>";
						header('refresh:3;url=index.php');
					}
					else{
						include('connexion.inc.php');
						echo "<h2 align=\"center\">Vos Derniers Séjours</h2>";

						/* Requête affichant tout les séjours du patient connecté à l'aide de son IPU*/
						$sql = "SELECT * FROM sejour WHERE ipu = $_SESSION[ipu]";
						$resultat = $cnx->query($sql);
						$row_cnt = $resultat->rowCount();
						$nb = 1;
						if ($row_cnt != 0){
							foreach($resultat as $ligne){
								if ($nb%2 == 0)
									$clas = "right";
								else
									$clas = "left";
								echo "<div class=".$clas.">";
							    echo "<p align=\"center\">Séjour ",$nb,": Datant du $ligne[date_deb] jusqu'au $ligne[date_fin].</p><br>\n";
							    /*echo "<h3><a name=\"ajout\" href=\"ajout_bien.php\" class=\"boutton\"> Ajouter des Biens</a></h3>";*/
							    ++$nb;
							    echo "<h2>Vos Biens déposé durant ce séjour: </h2>";

							    /*---------------------------------- Requête pour la table: EFFET  ----------------------------------*/
						    	/* Requête récupérant tout les effet déposé durant les différents séjours occupé par le patient. */

						    	$sql = "SELECT * FROM effet NATURAL JOIN bien NATURAL JOIN sejour WHERE num_sej = $ligne[num_sej]";
							    $res = $cnx->query($sql);
								$row_cnt = $res->rowCount();
								if ($row_cnt != 0){
									echo "<br><p class=\"titr\">EFFET<p/>";
									foreach($res as $line){
								    	echo "<p>Type = $line[type] du séjour numéro $line[num_sej].<br>Description: $line[description] <br> <a name=\"modif\" href=\"mod_sup.php?sej=$line[num_sej]&bien=effet&modif=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Modifier </a> <a href=\"mod_sup.php?supp=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Retirer </a></p>";
									}
								}
							    $res = NULL;

							    /*---------------------------------- Requête pour la table: BIJOU  ----------------------------------*/

							    $sql = "SELECT * FROM bijou NATURAL JOIN bien NATURAL JOIN sejour WHERE num_sej = $ligne[num_sej]";
								$res = $cnx->query($sql);
								$row_cnt = $res->rowCount();
								if ($row_cnt != 0){
									echo "<br><p class=\"titr\">BIJOU<p/>";
									foreach($res as $line){
								    	echo "<p>Type: $line[type]<br>Estimation compris entre [$line[estimation_min],$line[estimation_max]] du séjour numéro $line[num_sej].<br>Description: $line[description]<br> <a href=\"mod_sup.php?sej=$line[num_sej]&bien=bijou&modif=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Modifier </a> <a href=\"mod_sup.php?supp=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Retirer </a></p>";
									}
								}
							    $res = NULL;
							    
							    /*---------------------------------- Requête pour la table: CHEQUIER  ----------------------------------*/

							    $sql = "SELECT * FROM chequier NATURAL JOIN bien NATURAL JOIN sejour WHERE num_sej = $ligne[num_sej]";
								$res = $cnx->query($sql);
								$row_cnt = $res->rowCount();
								if ($row_cnt != 0){
									echo "<br><p class=\"titr\">CHEQUIER<p/>";
									foreach($res as $line){
								    	echo "<p>Nom de Banque: $line[nom_banque],<br> Num dernier chèque: $line[num_dernier_ch], du séjour numéro $line[num_sej].<br>Description: $line[description] <br> <a href=\"mod_sup.php?sej=$line[num_sej]&bien=chequier&modif=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Modifier </a> <a href=\"mod_sup.php?supp=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Retirer </a></p>";
									}
								}
								$res = NULL;

							    /*---------------------------------- Requête pour la table: LIQUIDITE  ----------------------------------*/

								$sql = "SELECT * FROM liquidite NATURAL JOIN bien NATURAL JOIN sejour WHERE num_sej = $ligne[num_sej]";
								$res = $cnx->query($sql);
								$row_cnt = $res->rowCount();
								if ($row_cnt != 0){
									echo "<br><p class=\"titr\">LIQUIDITE<p/>";
									foreach($res as $line){
								    	echo "<p>Montant = $line[montant] $line[devise] du séjour numéro $line[num_sej].<br>Description: $line[description] <br> <a name=\"modif\" href=\"mod_sup.php?sej=$line[num_sej]&bien=liquidite&modif=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Modifier </a> <a href=\"mod_sup.php?supp=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Retirer </a></p>";
									}
								}
							    $res = NULL;
							    
							    /*---------------------------------- Requête pour la table: OBJET_BANCAIRE  ----------------------------------*/

							    $sql = "SELECT * FROM objet_bancaire NATURAL JOIN bien NATURAL JOIN sejour WHERE num_sej = $ligne[num_sej]";
								$res = $cnx->query($sql);
								$row_cnt = $res->rowCount();
								if ($row_cnt != 0){
									echo "<br><p class=\"titr\">OBJET BANCAIRE<p/>";
									foreach($res as $line){
								    	echo "<p'>Nom de Banque = $line[nom_banque], Numéro de carte: $line[num_carte] du séjour numéro $line[num_sej].<br>Description: $line[description] <br><a name=\"modif\" href=\"mod_sup.php?sej=$line[num_sej]&bien=objet_bancaire&modif=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Modifier </a> <a href=\"mod_sup.php?supp=1&idb=".$line["id_bien"]."\" class=\"boutton\"> Retirer </a></p>";
									}
								}
							    $res = NULL;
								echo "</div>";
							}
						}else{
							echo "<p> Vous avez passé aucun séjour dans notre centre. <br> Vous avez donc déposé aucun bien.</p>";
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