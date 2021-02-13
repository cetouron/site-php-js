<?php
header("Content-type: text/html;charset=utf-8");
session_start(); 
?>

<html>

<body>
<?php include("menu.php"); ?>


<section id="main">
<div class="inner">
	
					
				
				<?php
				
				//Détruire les variables de session
					$_SESSION=array();
					Session_destroy();
					
					Echo '<h2>Deconnexion réussie</h2>';
					Echo'<p><strong><a href="accueil.php">Revenir à l&apos;accueil</a></strong></p>';
					//Rafraichir la page vers l'accueil
					echo '<meta http-equiv="refresh" content="2;url=accueil.php"/>';
				?>	
											
			</div>					
	
				
					</section>
</body>

</html>
