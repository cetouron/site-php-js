<!--Page d'ajout d'article-->

<?php
header("Content-type: text/html;charset=utf-8");
session_start(); 
// Connexion à la base pour atteindre les données
$cnx = mysqli_connect('localhost', 'root', 'root', 'base');

 ?>

<html>

<?php include("menu.php"); ?>


<body>



<section id="main">
<div class="inner">
    
    
<h1><a href="blog.php"> Blog </a> </h1>

<h2> Ajouter un article : </h2>

    
    <?php
	if(isset($_SESSION['identifie'])) {  //Si connecté

        $req1="SELECT * FROM membre WHERE login='" . $_SESSION['pseudo'] ."'"; //Slectionne tout dans membre avec le pseudo de la personne conneté
        $res1=mysqli_query($cnx,$req1);
        $donnees=mysqli_fetch_array($res1); //Données corespondant à la requête


    If ($donnees['role']=="admin")  // Si le membre a le rôle d'admin
                {
                    ?>
                    <h2>Nouvel article</h2>
				
				
				<?php

				//Formulaire d'article avec méthode POST
		
						Echo'<form action="ajoutArticle.php" method="POST" enctype="multipart/form-data">';		
                        
                        Echo'Titre de l\'article : ';					//Titre
						Echo'<input name="titre" type="text"></p>';
						
						Echo'<label for="file">Photo : </label>';					//Photo de départ
						Echo'<input name="file" class="form-control" type="file">';
						Echo'</p>';
						Echo'Contenu de l\'article : ';							//Contenu
						Echo'<textarea name="cont" rows="10" cols="20"></textarea>';

						
							//Envoyer et effacer
						Echo'</p>';
						Echo'<input type="submit" size="10" value="Poster" /><input type="reset" size="10" value="Effacer" />';
						
						Echo'</p>';
						Echo'</form>';
						
                        If (!empty($_POST["cont"]) and !empty($_POST["titre"])) //Traitement de l'envoie POST
						{
							//Type de fichier accepté
							if (((($_FILES["file"]["type"] == "image/gif")
  								|| ($_FILES["file"]["type"] == "image/jpeg")
								  || ($_FILES["file"]["type"] == "image/jpg")
								  || ($_FILES["file"]["type"] == "image/png"))
								  && ($_FILES["file"]["size"] < 20000000))
							|| !(is_uploaded_file($_FILES["file"]['tmp_name']))) 
    							{
									//Si le fichier, avec un nom similaire n'est pas déjà dans la base
									if (!(file_exists("images/" . $_FILES["file"]["name"])) || !(is_uploaded_file($_FILES["file"]['tmp_name'])))
									{
										//Si fichier uplodé
							if (is_uploaded_file($_FILES["file"]['tmp_name'])) {

								move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$_FILES["file"]["name"]); 	//Envoie de la photo dans le dossier image de l'hebergeur
								//Insertion avec image uploadé de l'article 
								$req3 = 'INSERT INTO blog (titre, auteur, contenu, images) VALUES ("'.$_POST['titre'].'","'.$_SESSION['pseudo'].'","'.$_POST['cont'].'","images/'.$_FILES["file"]["name"].'");';

							}
								//Insertion avec image par défaut
							else $req3 = 'INSERT INTO blog (titre, auteur, contenu, images) VALUES ("'.$_POST['titre'].'","'.$_SESSION['pseudo'].'","'.$_POST['cont'].'","images/image.jpeg");';
							
							//Envoie de la requête
							mysqli_query($cnx,$req3);
							
							mysqli_close($cnx);
							
							Echo'<h2> Article posté !</h2>';
									}
									//si l'image uploadé (du moins son nom) est déjà hebergé
									else Echo'<p>Le nom de l\'image est déjà dans la base !'.$_FILES["file"]["name"];
								}
								//Format de l'image incorecte 
								else Echo'<p>Problème de format de votre image !'.$_FILES["file"]["type"];			 

						}
							else
								{ //Le formulaire n'est pas correctement rempli
                                    if (isset($_POST["comm"]) or isset($_POST["titre"])) {
                                       Echo'<h2> Oups ! Il manque quelque chose...</h2>';
									   Echo'<p>Merci de bien remplir tout le <strong>formulaire d\'article</strong>';			 
                                    }
									}
                }
            else
                { // Si pas de compte admin
                    Echo'<p>Pour poster un nouvel article, merci de <a href="connexion.php"><strong>vous identifier avec un compte administrateur.</strong></a></p>';
               
				} 
			}?>
		    </div> 					
					</section>

</body>


</html>
