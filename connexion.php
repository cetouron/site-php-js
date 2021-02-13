<?php
header("Content-type: text/html;charset=utf-8");
session_start(); // Comme setcookie, doit être appelée avant tout contenu (mais appel possible après un autre header)


$cnx = mysqli_connect('localhost', 'root', 'root', 'base');
mysqli_query($cnx, "CREATE TABLE IF NOT EXISTS membre (num INT UNSIGNED AUTO_INCREMENT NOT NULL, login VARCHAR(64) NOT NULL, mdp VARCHAR(64) NOT NULL, PRIMARY KEY(num))") or die ("Erreur de création de table");

$msg = '';



// Contexte de traitement du formulaire d'identification
//
if (isset($_POST['bouton_ident'])) {
  // Si le mot de passe ne vient pas du cookie, il faut l'encrypter en md5
  // pour pouvoir le comparer à celui de la bdd
  //
  if (isset($_COOKIE['membre']['mdp']) && $_COOKIE['membre']['mdp'] == $_POST['mdp'])
    $mdp = "'" . $_POST['mdp'] . "'";
  else
    $mdp = "MD5('" . $_POST['mdp'] . "')";

  $res = mysqli_query($cnx, "SELECT * FROM membre WHERE login='" . $_POST['login'] . "' AND mdp=$mdp");
  if ($res && mysqli_fetch_row($res)) {
    $msg = "Bienvenue à vous, " . $_POST['login'];
    $_SESSION['pseudo']=$_POST['login'];
    $_SESSION['identifie'] = true;
    echo '<meta http-equiv="refresh" content="2;url=accueil.php"/>';

  }
  else $msg = 'Désolé, identifiants de connexion incorrects';

  
// Contexte de traitement du formulaire d'inscription
//

}

include("menu.php");


if (isset($_COOKIE['membre']['login'])) {
    $valLog = $_COOKIE['membre']['login'];
    $valMdp = $_COOKIE['membre']['mdp'];
  } else {
    $valLog = '';
    $valMdp = '';
  }
  
  // Affichage du formulaire (avec valeurs du cookie le cas échéant)
?>

<section id="main">
<div class="inner">

<h1>Connexion</h1>

<?php if (!(isset($_SESSION['identifie']))) {

?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <p>Login : <input name="login" type="text" value="<?php echo $valLog ?>"></p>
    <p>Mot de passe : <input name="mdp" type="password" value="<?php echo $valMdp ?>"></p>
    <p><input name="bouton_ident" type="submit" value="IDENTIFICATION"/></p>
  </form>
<?php
echo $msg;
}

else Echo'Vous êtes connecté en tant que '.$_SESSION['pseudo'];
?>


</div> 					
					</section>

</body>
</html>
<?php include('footer.php');?>