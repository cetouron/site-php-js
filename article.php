<!--Page d'article-->

<?php
header("Content-type: text/html;charset=utf-8");
session_start(); 
$cnx = mysqli_connect('localhost', 'root', 'root', 'base');

 ?>

<html>

<body>
<?php include("menu.php"); ?>

<section id="main">
<div class="inner">

<h1><a href="blog.php"> Blog </a> </h1>

        <?php
       
            //Selectionne les éléments de l'article envoyé avec GET
            $req1='SELECT * FROM blog WHERE idArt="'.$_GET["article"].'";';
            $res1=mysqli_query($cnx,$req1);
            $donnees=mysqli_fetch_array($res1);
            //Si on va chercher un article qui existe
        if (isset($_GET['article']) and $donnees) {
            //Afficher les données
            Echo'<h1 align="center"> <code >'.$donnees['titre'].'</code> </h1> <h5 align="center" > par '.$donnees['auteur'].'</h5> '; //Titre et auteur
                            
            // Image, puis contenu
                            Echo'<img  
                            class="displayed"
                            src="'.$donnees['images'].'">  <br>';

                            Echo '<span>'.$donnees['contenu'].'</span>'; 

           
            
            
            

            
            //Partie commentaire
            
            Echo'<br> <br> <br> <br> <h4>Commentaires</h4>';


     
                    //Selection des commentaires correspodnant à l'article avec le nom de l'auteur associé
                    $req2='SELECT * FROM commentaire, membre WHERE commentaire.article="'.$_GET["article"].'" AND commentaire.auteur=membre.login ORDER BY commentaire.idCom;';
                    $res2=mysqli_query($cnx,$req2);

                //Pour compter le nombre de commentaire
                    $req3 = 'SELECT count(*) AS nb FROM commentaire, membre WHERE commentaire.article="'.$_GET["article"].'" AND commentaire.auteur=membre.login ORDER BY commentaire.idCom;';
                    $res3= mysqli_query($cnx,$req3);
                    $cols = mysqli_fetch_array($res3);
                    $nb = $cols['nb'];

                    //Si il n'y a pas 0 commentaire
                    if ($nb!=0) {
                        //Affichage dans une table
                    Echo'<table align="center">';

                    // Tant que y a un commentaire, un enregistrement en plus dans les données sélectionnées
                    while ($donnees1 = mysqli_fetch_array($res2))
                    {
                        Echo'<tr>';
                        Echo'<td width=80%> <p> <strong> '.$donnees1['auteur'].'</strong> <br/> <comm>  '.$donnees1['comm'].' </comm> </a></td></tr>';
                    }
                    Echo'</table>';
                    }
                    
                    else { // Si pas de commentaire
                           Echo"<p> Il n'y a pas encore de commentaire. </p>";
                       }

                       //Partie poster un commentaire si connecté
            If (isset($_SESSION['identifie'])) 
                {
                    ?>
                    <h2>Poster un commentaire</h2>
				        Vous écrivez en tant que <?php Echo $_SESSION['pseudo'] ?> : 
				
				<?php
		//Formulaire POST pour écrire un commentaire
						Echo'<form action="article.php?article='.$_GET['article'].'" method="POST">';		
						
						
						Echo'<textarea name="comm" rows="10" cols="20"></textarea>';
						Echo'<br/><br/>';
						
						Echo'<input type="submit" size="10" value="Poster" /><input type="reset" size="10" value="Effacer" />';
						
						Echo'</p>';
						Echo'</form>';
                        
                        //Si commentaire rempli
                        If (isset($_GET["article"]) and !empty($_POST["comm"])) 
						{
                                    //On insert le nouveau commentaire dans la table
							$req3 = 'INSERT INTO commentaire (auteur, comm, article) VALUES ("'.$_SESSION['pseudo'].'","'.$_POST['comm'].'","'.$_GET['article'].'");';
							
							mysqli_query($cnx,$req3);
                            
                            //Rafraichir la page pour afficher le commentaire
                            echo '<meta http-equiv="refresh" content="2;url=article.php?article='.$_GET['article'].'"/>'; 

							Echo'<h2> Commentaire posté !</h2>';
						}
							else
								{ //Si le formulaire est vide
                                    if (isset($_POST["comm"])) {
                                       Echo'<h2> Oups ! Il manque quelque chose...</h2>';
									   Echo'<p>Merci de bien remplir tout le <strong>formulaire de commentaire</strong>';			 
                                    }
									}
                    
                }
            else
                { //Si pas inscrit
                    Echo'<p>Pour poster un commentaire, merci de <a href="connexion.php"><strong>vous identifier</strong></a> ou de <a href="inscription.php"><strong>vous inscrire</strong></a></p>';
                }
                         mysqli_close($cnx);
        }
        // Si l'article n'existe pas, retour au blog
        else     echo '<meta http-equiv="refresh" content="0;url=blog.php"/>';
        ?>				
    
    </div> 					
					</section>
</body>

<style>
    /*balise comm pour ajouter une barre vertical avant contenu du commetaire*/
    comm {
		border-left: solid 4px;
		margin: 0 0 1em 0;
		padding: 0.5em 0 0.5em 1em;
    }
    /*Balise pour photo centrale*/
    .displayed {
    display: block;
    max-height:300;
    margin-left: auto;
    margin-right: auto }
    </style>
