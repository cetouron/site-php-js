<?php
header("Content-type: text/html;charset=utf-8");
session_start(); //

$cnx = mysqli_connect('localhost', 'root', 'root', 'base');
mysqli_query($cnx, "CREATE TABLE IF NOT EXISTS membre (num INT UNSIGNED AUTO_INCREMENT NOT NULL, login VARCHAR(64) NOT NULL, mdp VARCHAR(64) NOT NULL, PRIMARY KEY(num))") or die ("Erreur de création de table");

$msg = '';

// Contexte de traitement du bouton de déconnexion
//
if (isset($_POST['bouton_logout'])) unset($_SESSION['identifie']);

 ?>

<html>

<body>
<?php include("menu.php"); ?>





<section id="banner">
				<div class="inner">
					<h1 >Bienvenue <span>sur<br />
					La maison des petits</span></h1>
					<ul class="actions">
					<?php 
					if(isset($_SESSION['identifie'])) {
					    echo'<li><a href="blog.php" class="button alt">Lire le blog</a></li>' ;  
					}
					else if (isset($_COOKIE['membre']['login']))  {
					echo'<li><a href="connexion.php" class="button alt">Se connecter</a></li>'   ;
					}
					else echo"<li><a href='inscritpion.php' class='button alt'>S'inscrire</a></li>"  ; 

					?>
					</ul>
				</div>
			</section>
			
<section id="main">
      <div class="inner"> 			
<h1> Présentation </h1>
<p>
<h2> <a href="blog.php">Le blog</a></h2>
<span>Sur celui-ci, vous pouvez découvrir les activités que je fais avec les enfants, leurs créations et autres outils pédagogiques que je vous partage. <br> Pour interragir, n'hésitez pas à <a href="inscription.php">vous inscrire</a>. </span></p>

<p>
<h2> <a href="jeu.php">Jeux</a></h2>
<span>Dans le cadre de l'apprentissage, les enfants ont besoin de developper leur capacité. Chiffres, couleurs et formes, voilà ce sur quoi ils pourront s'améliorer avec les jeux présents sur le site.<br>Pour le moment, il n'y a qu'un seul jeu, mais vous pourrez bientôt en découvrir d'autres !</span></p>

<p>
<h2> <a href="blog.php">Plus d'info</a></h2>
<span>Envie d'en savoir plus sur le site, mon parcours et me contacter ? C'est ici. </span>
</p>

</div> 					
					</section>

</body>


</html>