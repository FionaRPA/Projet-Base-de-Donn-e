<?php
	if (!isset($_SESSION))
		session_start();
	include('connexion.inc.php');

	if(isset($_GET["valider"])) {

		/* Vérifie si toute les variables récupérés à l'aide de la méthode GET ne sont pas vide */
	    if(!empty($_GET['nom']) AND !empty($_GET['prenom']) AND !empty($_GET['mail']) AND !empty($_GET['mail2']) AND !empty($_GET['adresse']) AND !empty($_GET['mdp']) AND !empty($_GET['mdp2'])) {

	    	$mail = htmlspecialchars($_GET['mail']);
			$mail2 = htmlspecialchars($_GET['mail2']);
			$adresse = htmlspecialchars($_GET['adresse']);
			$nom = htmlspecialchars($_GET['nom']);
			$prenom = htmlspecialchars($_GET['prenom']);
		    $mdp = md5($_GET['mdp']);
		    $mdp2 = md5($_GET['mdp2']);
	    	/* Vérifie si les mails correspondent. */
            if($mail == $mail2){
            
                /* Regarde si le texte récupéré pour le mail coorespond bien au format d'un mail. */
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            
                	/* Vérifie si le mail existe déjà dans la base de donnée */
                    $reqmail = $cnx->prepare("SELECT * FROM patient WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if($mailexist == 0) {
            
                    	/* Vérifie si les mots de passe sont egaux. */
        	            if($mdp == $mdp2) {
            
                        	/* Requête SQL pour insérer les données d'un nouveau patient dans le base. */
                            $insertpat = $cnx->prepare("INSERT INTO patient(nom, prenom, adresse, mail, mdp) VALUES(?, ?, ?, ?, ?)");
                            $insertpat->execute(array($nom, $prenom, $adresse, $mail, $mdp));

                            echo "<p>Votre compte a bien été créé !</p>";
                            header('refresh:3;url=page_connexion.php');
                        } else {
                            echo "<p>Vos mots de passes ne correspondent pas !</p>";
                        }
                    } else {
                        echo "<p>Adresse mail déjà utilisée !</p>";
                    }
                } else {
                    echo "<p>Votre adresse mail n'est pas valide !</p>";
                }
            } else {
                echo "<p>Vos adresses mail ne correspondent pas !</p>";
            }
	    } else {
	        echo "<p>Tous les champs doivent être complétés !</p>";
	    }
	}
?>