<?php
header("Content-type: text/html;charset=utf-8");
session_start(); // Comme setcookie, doit être appelée avant tout contenu (mais appel possible après un autre header)

$cnx = mysqli_connect('localhost', 'root', 'root', 'base');

 ?>

<html>

<?php include("menu.php"); ?>


<body>



<h1> Blog </h1>

<h2> Ajouter un article : </h2>

<div id="content-wrap">
		<div id="content">	 
		<!-- que si admin -->
    
    <?php
	if(isset($_SESSION['identifie'])) {

        $connexionBD=mysqli_connect("localhost","root","root");
        mysqli_select_db($connexionBD,"base");
        $req1="SELECT * FROM membre WHERE login='" . $_SESSION['pseudo'] ."'";
        $res1=mysqli_query($connexionBD,$req1);
        $donnees=mysqli_fetch_array($res1);


    If ($donnees['role']=="admin") 
                {
                    ?>
                    <h2>Nouvel article</h2>
				
				
				<?php
		
						Echo'<form action="ajoutArticle.php" method="POST" enctype="multipart/form-data">';		
                        
                        Echo'Titre de l\'article : ';
						Echo'<input name="titre" type="text"></p>';
						
						Echo'<label for="file">Photo : </label>';
						Echo'<input name="file" class="form-control" type="file">';
						Echo'</p>';
						Echo'Contenu de l\'article : ';
						Echo'<textarea name="cont" rows="10" cols="20"></textarea>';

						

						Echo'</p>';
						Echo'<input type="submit" size="10" value="Poster" /><input type="reset" size="10" value="Effacer" />';
						
						Echo'</p>';
						Echo'</form>';
						
                        If (!empty($_POST["cont"]) and !empty($_POST["titre"]))
						{
							if (((($_FILES["file"]["type"] == "image/gif")
  								|| ($_FILES["file"]["type"] == "image/jpeg")
								  || ($_FILES["file"]["type"] == "image/jpg")
								  || ($_FILES["file"]["type"] == "image/png"))
								  && ($_FILES["file"]["size"] < 20000000))
							|| !(is_uploaded_file($_FILES["file"]['tmp_name'])))
    							{
									if (!(file_exists("images/" . $_FILES["file"]["name"])) || !(is_uploaded_file($_FILES["file"]['tmp_name'])))
									{
	

									
							
							$connexionBD=mysqli_connect("localhost","root","root");
							mysqli_select_db($connexionBD,"base");

							if (is_uploaded_file($_FILES["file"]['tmp_name'])) {

								move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$_FILES["file"]["name"]);
								$req3 = 'INSERT INTO blog (titre, auteur, contenu, images) VALUES ("'.$_POST['titre'].'","'.$_SESSION['pseudo'].'","'.$_POST['cont'].'","images/'.$_FILES["file"]["name"].'");';

							}

							else $req3 = 'INSERT INTO blog (titre, auteur, contenu, images) VALUES ("'.$_POST['titre'].'","'.$_SESSION['pseudo'].'","'.$_POST['cont'].'","images/image.jpeg");';
							
							mysqli_query($connexionBD,$req3);
							
							mysqli_close($connexionBD);
							
							Echo'<h2> Article posté !</h2>';
									}
									else Echo'<p>Le nom de l\'image est déjà dans la base !'.$_FILES["file"]["name"];
								}
								else Echo'<p>Problème de format de votre image !'.$_FILES["file"]["type"];			 

						}
							else
								{
                                    if (isset($_POST["comm"]) or isset($_POST["titre"])) {
                                       Echo'<h2> Oups ! Il manque quelque chose...</h2>';
									   Echo'<p>Merci de bien remplir tout le <strong>formulaire d\'article</strong>';			 
                                    }
									}
                }
            else
                {
                    Echo'<p>Pour poster un nouvel article, merci de <a href="connexion.php"><strong>vous identifier avec un compte administrateur.</strong></a></p>';
               
				} 
			}?>
		</div></div>

</body>


</html>