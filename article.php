<?php
header("Content-type: text/html;charset=utf-8");
session_start(); // Comme setcookie, doit être appelée avant tout contenu (mais appel possible après un autre header)

$cnx = mysqli_connect('localhost', 'root', 'root', 'base');

 ?>

<html>

<body>
<?php include("menu.php"); ?>

<section id="main">
<div class="inner">

<h1><a href="blog.php"> Blog </a> </h1>


	 
    
        
        <?php
        
            
            

            $req1='SELECT * FROM blog WHERE idArt="'.$_GET["article"].'";';
            $res1=mysqli_query($cnx,$req1);
            $donnees=mysqli_fetch_array($res1);

            Echo'<h1 align="center"> <code >'.$donnees['titre'].'</code> </h1> <h5 align="center" > par '.$donnees['auteur'].'</h5> '; //faire page d'auteur ?
                            
                            Echo'<img  
                            class="displayed"
                            src="'.$donnees['images'].'">  <br>';

                            Echo '<span>'.$donnees['contenu'].'</span>'; 

           
            
            
            

            
            /* PARTIE COMMENTAIRE */
            
            Echo'<br> <br> <br> <br> <h4>Commentaires</h4>';


     
                    
                    $req2='SELECT * FROM commentaire, membre WHERE commentaire.article="'.$_GET["article"].'" AND commentaire.auteur=membre.login ORDER BY commentaire.idCom;';
                    $res2=mysqli_query($cnx,$req2);
                    $nbcom=0;


                    $req3 = 'SELECT count(*) AS nb FROM commentaire, membre WHERE commentaire.article="'.$_GET["article"].'" AND commentaire.auteur=membre.login ORDER BY commentaire.idCom;';
                    $res3= mysqli_query($cnx,$req3);
                    $cols = mysqli_fetch_array($res3);
                    $nb = $cols['nb'];
                    
                    if ($nb!=0) {
                    Echo'<table align="center">';
                    while ($donnees1 = mysqli_fetch_array($res2))
                    {
                        $nbcom++;
                        Echo'<tr>';
                        Echo'<td width=80%> <p> <strong> '.$donnees1['auteur'].'</strong> <br/> <comm>  '.$donnees1['comm'].' </comm> </a></td></tr>';
                    }
                    Echo'</table>';
                    }
                    
                    else {
                           Echo"<p> Il n'y a pas encore de commentaire. </p>";
                       }

            If (isset($_SESSION['identifie'])) 
                {
                    ?>
                    <h2>Poster un commentaire</h2>
				        Vous écrivez en tant que <?php Echo $_SESSION['pseudo'] ?> : 
				
				<?php
		
						Echo'<form action="article.php?article='.$_GET['article'].'" method="POST">';		
						
						
						Echo'<textarea name="comm" rows="10" cols="20"></textarea>';
						Echo'<br/><br/>';
						
						Echo'<input type="submit" size="10" value="Poster" /><input type="reset" size="10" value="Effacer" />';
						
						Echo'</p>';
						Echo'</form>';
						
                        If (isset($_GET["article"]) and !empty($_POST["comm"])) 
						{
							
							
					
							
							$req3 = 'INSERT INTO commentaire (auteur, comm, article) VALUES ("'.$_SESSION['pseudo'].'","'.$_POST['comm'].'","'.$_GET['article'].'");';
							
							mysqli_query($cnx,$req3);
							
                            echo '<meta http-equiv="refresh" content="2;url=article.php?article='.$_GET['article'].'"/>'; 

							Echo'<h2> Commentaire posté !</h2>';
						}
							else
								{
                                    if (isset($_POST["comm"])) {
                                       Echo'<h2> Oups ! Il manque quelque chose...</h2>';
									   Echo'<p>Merci de bien remplir tout le <strong>formulaire de commentaire</strong>';			 
                                    }
									}
                    
                }
            else
                {
                    Echo'<p>Pour poster un commentaire, merci de <a href="connexion.php"><strong>vous identifier</strong></a> ou de <a href="inscription.php"><strong>vous inscrire</strong></a></p>';
                }
                         mysqli_close($cnx);
            
           /* FIN PARTIE COMMENTAIRE */
        ?>				
    
    </div> 					
					</section>
</body>

<style>
    comm {
		border-left: solid 4px;
		margin: 0 0 1em 0;
		padding: 0.5em 0 0.5em 1em;
    }
    .displayed {
    display: block;
    max-height:300;
    margin-left: auto;
    margin-right: auto }
    </style>
