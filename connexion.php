<?php
header("Content-type: text/html;charset=utf-8");
session_start(); 
$cnx = mysqli_connect('localhost', 'root', 'root', 'base');
mysqli_query($cnx, "CREATE TABLE IF NOT EXISTS membre (num INT UNSIGNED AUTO_INCREMENT NOT NULL, login VARCHAR(64) NOT NULL, mdp VARCHAR(64) NOT NULL, PRIMARY KEY(num))") or die ("Erreur de création de table");

$msg = '';

//Si formulaire POST
if (isset($_POST['bouton_ident'])) {
//Si les cookies sont déjà enregistrés en md5
  if (isset($_COOKIE['membre']['mdp']) && $_COOKIE['membre']['mdp'] == $_POST['mdp'])
    $mdp = "'" . $_POST['mdp'] . "'";
  else //Sinon on le crypte
    $mdp = "MD5('" . $_POST['mdp'] . "')";

  $res = mysqli_query($cnx, "SELECT * FROM membre WHERE login='" . $_POST['login'] . "' AND mdp=$mdp");
  //Si un enregistrement correspond au login et mot de passe inscrit
  if ($res && mysqli_fetch_row($res)) {
    $msg = "Bienvenue à vous, " . $_POST['login'];
    //Session pseuso pour le reprendre facilement 
    $_SESSION['pseudo']=$_POST['login'];
    //Savoir si on est connecté
    $_SESSION['identifie'] = true;
    echo '<meta http-equiv="refresh" content="2;url=accueil.php"/>';

  } // Sinon, on est pas connecté
  else $msg = 'Désolé, identifiants de connexion incorrects';

}

include("menu.php");

//Récupération des cookies pour les pré inscrire dans le formulaire 
if (isset($_COOKIE['membre']['login'])) {
    $valLog = $_COOKIE['membre']['login'];
    $valMdp = $_COOKIE['membre']['mdp'];
  } else {
    $valLog = '';
    $valMdp = '';
  }
  
?>

<section id="main">
<div class="inner">

<h1>Connexion</h1>


<?php if (!(isset($_SESSION['identifie']))) {
// Si pas déjà connecté
?>
 <!--Formulaire d'identification-->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <p>Login : <input name="login" type="text" value="<?php echo $valLog ?>"></p>
    <p>Mot de passe : <input name="mdp" type="password" value="<?php echo $valMdp ?>"></p>
    <p><input name="bouton_ident" type="submit" value="IDENTIFICATION"/></p>
  </form>
<?php
echo $msg;
}
 // Si déjà connecté
else Echo'Vous êtes connecté en tant que '.$_SESSION['pseudo'];
?>


</div> 					
					</section>

</body>
</html>
