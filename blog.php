<!--Affichage des articles-->
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

<h1> Blog </h1>

<h2> Dernières publications : </h2>
		
				<?php

					$req='SELECT * FROM blog ORDER BY idArt DESC;'; //Selection des articles
					$res=mysqli_query($cnx,$req);
					
					Echo'							<hr />					';
					//Tant qu'il y a des articles enregistrés
					while ($donnees = mysqli_fetch_array($res))
						{   
                         //   Affichage de l'article, titre avec lein vers lui et auteur
                           Echo'<div class="row">
							
								<h3><a href="article.php?article='.$donnees['idArt'].'"><code>'.$donnees['titre'].'</code></a></h3> par '.$donnees['auteur'].'</div>';
                            //Affichage de l'image
                            Echo'<div class="row"> <div class="imag" id="col1"> <img  src="'.$donnees['images'].'"></div>';

							//Affichage du contenu avec un maximum de 250 caractères
                            if (strlen($donnees['contenu'])>250) 
                                {
                                    $descr=substr($donnees['contenu'], 0, 250);
                                    $fin=strrpos($descr," ");
									$descr=substr($descr,0,$fin);
									//On découpe et ajoute un "Lire la suite" avec lien vers l'article
                                    $descr.="...<a href='article.php?article=".$donnees['idArt']."'>Lire la suite</a>";
                                }
                            else {
                            $descr = $donnees['contenu'];
                            }
							//Affichage avec les changements effectués
                            Echo ' 	<div id="col2">	<blockquote>'.$descr.'</blockquote> 	</div>	</div>	'; 
							Echo'<hr />';
                            

						}
                    mysqli_close($cnx);	
                    //Si on est admin on peut ajouter un article 
                    	if((isset($_SESSION['identifie'])) && ($donnees['role']=="admin")){
					Echo'<h3><a href="ajoutArticle.php">Ajouter un nouvel article</a></h3>';
                    	}
				?>	
				
					</div> 					
					</section>


</body>


</html>


<style>


/*Afficher en colonne image et description*/ 
div#col1 {
	float: left;
	width: 15%;

}
div#col2 {
	float: right;
	width: 85%;
}

/*Tentative de centrer et découper mieux l'image*/
	.imag {
		width: 15%; 
    overflow: hidden; 
    border: 0px solid black;

	}

	.imag img{
		height:150px;
		margin: -10px 0px 0px -40px;
		align: center;

	}

	/* Trait a côté de la description */
	blockquote {
		border-left: solid 4px;
		font-style: italic;
		margin: 10 10 1em 10;
		padding: 0.5em 0 0.5em 1em;
	}
	blockquote {
		border-left-color: #e5474b;
	}
			
	</style>
