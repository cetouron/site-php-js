<!-- PAGE D'ACCUEIL --> 
<?php
header("Content-type: text/html;charset=utf-8"); //Renseignement sur html et la langue et ses caractères
session_start(); //
 ?>

<html>

<body>
<?php include("menu.php"); ?> <!--Barre de menu-->

<!--Bannière de l'accueil-->
<section id="banner">
				<div class="inner">
					<h1 >Bienvenue <span>sur<br />
					La maison des petits</span></h1>
					<ul class="actions">
					<?php 
					// Boutons différenciés selon si l'individu est connecté ou non
					if(isset($_SESSION['identifie'])) { //Si connecté
					    echo'<li><a href="blog.php" class="button alt">Lire le blog</a></li>' ;  
					}
					else if (isset($_COOKIE['membre']))  { //Si pas connecté mais un compte existe en cookie
					echo'<li><a href="connexion.php" class="button alt">Se connecter</a></li>'   ;
					} // Sinon
					else echo"<li><a href='inscritpion.php' class='button alt'>S'inscrire</a></li>"  ; 

					?>
					</ul>
				</div>
			</section>
		
			<!--Partie présentation avec lien vers les autres pages-->
<section id="main">
      <div class="inner"> 			
<h1> Présentation </h1>
<p>
<h2> <a href="blog.php">Le blog</a></h2>
<span>A travers ce blog, vous pouvez découvrir les activités que je fais avec mes élèves de Petite Section, leurs créations et autres outils pédagogiques. <br> Pour interragir, n'hésitez pas à <a href="inscription.php">vous inscrire</a>. </span></p>

<p>
<h2> <a href="jeu.php">Jeux</a></h2>
<span>Dans le cadre de l'apprentissage, les enfants ont besoin de développer leur capacité. Chiffres, couleurs et formes, voilà ce sur quoi ils pourront s'améliorer avec les jeux présents sur le site.<br>Pour le moment, il n'y a qu'un seul jeu, mais vous pourrez bientôt en découvrir d'autres !</span></p>

<p>
<h2> <a href="blog.php">Plus d'info</a></h2>
<span>Envie d'en savoir plus sur le site, mon parcours et me contacter ? C'est ici. </span>
</p>

</div> 					
					</section>

</body>


</html>

