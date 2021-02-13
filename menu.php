<head>

	 <link rel="stylesheet" href="images/main.css" type="text/css" /> 
</head>

<body>
<!--BARRE DE MENU-->
<header id="header">
				<div class="inner">
					<a href="accueil.php" class="logo">La maison des petits</a>
					<nav id="nav">
                        
                    <a href="accueil.php">Accueil</a>
                    <a href="blog.php">Blog</a>
                    <a href="jeu.php">Jeux</a>
					<a href="info.php">Plus d'info</a>
					
				<?php
				//Affichage selon si on est connecté ou non 
					If (isset($_SESSION['identifie'])) 
					{
						Echo'<a href="deconnexion.php">Se déconnecter</a>';
					}
					else
					{
                         Echo'<a href="connexion.php">Connexion</a>';
                         Echo'<a href="inscription.php">Inscription</a>';
					}
				?>
            
					</nav>
				</div>
			</header>
			<!--Pour affichage responsive-->
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

</body>

<?php include('footer.php');?>
                
		
