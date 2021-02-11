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

<h1> Blog </h1>

<h2> Dernières publications : </h2>


				
				<?php
					
					
					$connexionBD=mysqli_connect("localhost","root","root");
					mysqli_select_db($connexionBD,"base");
					
					$req='SELECT * FROM blog ORDER BY idArt DESC;';
					$res=mysqli_query($connexionBD,$req);
					
					Echo'							<hr />					';
					while ($donnees = mysqli_fetch_array($res))
						{   
                         //   Echo'</br>';
                           Echo'<div class="row">
								
								<h3><a href="article.php?article='.$donnees['idArt'].'"><code>'.$donnees['titre'].'</code></a></h3> par '.$donnees['auteur'].'</div>'; //faire page d'auteur ?
                            
                            Echo'<div class="row"> <div class="imag" id="col1"> <img  src="'.$donnees['images'].'"></div>';


                            if (strlen($donnees['contenu'])>250) 
                                {
                                    $descr=substr($donnees['contenu'], 0, 250);
                                    $fin=strrpos($descr," ");
                                    $descr=substr($descr,0,$fin);
                                    $descr.="...<a href='article.php?article=".$donnees['idArt']."'>Lire la suite</a>";
                                }
                            else {
                            $descr = $donnees['contenu'];
                            }

                            Echo ' 	<div id="col2">	<blockquote>'.$descr.'</blockquote> 	</div>	</div>	'; 
							Echo'<hr />';
                            

						}
                    mysqli_close($connexionBD);	
                    
                    //Faire ça avec que l'admin
					Echo'<h3><a href="ajoutArticle.php">Ajouter un nouvel article</a></h3>';
				?>	
				
					</div> 					
					</section>


</body>


</html>


<style>



div#col1 {
	float: left;
	width: 15%;

}
div#col2 {
	float: right;
	width: 85%;
}

	.imag {
		width: 15%; /* width of container */
  /*  height: 150px;  height of container*/
    overflow: hidden; 
    border: 2px solid black;

	}

	.imag img{
		height:150px;
		margin: -10px 0px 0px -40px;

	 /*	max-width:250px;*/
		align: center;

	}

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