<head>



	 <link rel="stylesheet" href="images/main.css" type="text/css" /> 
</head>

<body>

<header id="header">
				<div class="inner">
					<a href="accueil.php" class="logo">Nom du blog</a>
					<nav id="nav">
                        
                    <a href="accueil.php">Accueil</a>
                    <a href="blog.php">Blog</a>
                    <a href="jeu.php">Jeux</a>
                    <a href="accueil.php">Plus d'info</a>
				<?php
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
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner 
			<section id="banner">
				<div class="inner">
					<h1>Introspect: <span>A free + fully responsive<br />
					site template by TEMPLATED</span></h1>
					<ul class="actions">
						<li><a href="#" class="button alt">Get Started</a></li>
					</ul>
				</div>
			</section>

<div id="nav">
			
			<ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="accueil.php">Jeux</a></li>
                <li><a href="accueil.php">Plus d'info</a></li>
				<?php /*
					If (isset($_SESSION['identifie'])) 
					{
						Echo'<li><a href="deconnexion.php">Se déconnecter</a></li>';
					}
					else
					{
                         Echo'<li id="current"><a href="connexion.php">Connexion</a></li>';
                         Echo'<li id="current"><a href="inscription.php">Inscription</a></li>';
					}
				?>
            </ul>
            
            <?php
            If (isset($_SESSION['identifie'])) 
                {
                    echo'Vous êtes connecté en tant que '.$_SESSION['pseudo'];
                }
*/
                ?>
                
</div> -->
</body>


                
		
