<?php
header("Content-type: text/html;charset=utf-8");
session_start(); // Comme setcookie, doit être appelée avant tout contenu (mais appel possible après un autre header)

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

<section id="main">
      <div class="inner"> 

<h1> Bon ça marche ? </h1>


<?php
if (isset($_SESSION['identifie'])) {
?>
  <h2>Menu :</h2>
  <a href="ex1_p1.php">Page 1</a><br/>
  Page 2<br/>
  ...<br/>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <br /><input name="bouton_logout" type="submit" value="Se déconnecter"/>
  </form>

<?php } ?>


</div> 					
					</section>

</body>


</html>