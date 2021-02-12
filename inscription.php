<?php
header("Content-type: text/html;charset=utf-8");
session_start(); // Comme setcookie, doit être appelée avant tout contenu (mais appel possible après un autre header)

$cnx = mysqli_connect('localhost', 'root', 'root', 'base');
mysqli_query($cnx, "CREATE TABLE IF NOT EXISTS membre (num INT UNSIGNED AUTO_INCREMENT NOT NULL, login VARCHAR(64) NOT NULL, mdp VARCHAR(64) NOT NULL, role VARCHAR(5) NOT NULL, PRIMARY KEY(num))") or die ("Erreur de création de table");

$msg = '';

// Contexte de traitement du bouton de déconnexion
//
 if (isset($_POST['bouton_inscr'])) {
  // Insertion dans la base
  //
  if (empty($_POST['login1']) || empty($_POST['mdp1'])) $msg = 'Formulaire incomplet !';
  else if ($_POST['mdp1'] != $_POST['mdp2']) $msg = 'Mots de passe différents !';
  else {
    $res = mysqli_query($cnx, "SELECT * FROM membre WHERE login='" . $_POST['login1'] ."'");
    if ($res && mysqli_fetch_row($res)) $msg = 'Login déjà présent dans la base !';
    else {
      mysqli_query($cnx, "INSERT INTO membre (role, login, mdp) VALUES ('" . $_POST['role1'] . "','" . $_POST['login1'] . "', MD5('" . $_POST['mdp1'] . "'))") or die ("Erreur d'insertion");
      $msg = 'Vous voilà inscrit(e) ! Page d\'accueil dans quelques secondes. Si celle-ci ne s\'affiche pas, <p><strong><a href="accueil.php">cliquez ici</a></strong></p>';
      $_SESSION['pseudo']=$_POST['login1'];
      $_SESSION['identifie'] = true;

        echo '<meta http-equiv="refresh" content="5;url=accueil.php"/>;';

      // Gestion du cookie
      //
      if (isset($_POST['memo'])) {
        setcookie("membre[login]", $_POST['login1'], time() + 3600*24*365); // Durée de validité : 1 an

        setcookie("membre[mdp]", md5($_POST['mdp1']), time() + 3600*24*365);


        //

      }
    }
  }
}


include("menu.php"); 

echo '<html><body> <section id="main">
      <div class="inner"> <h2>Inscription</h2><h3>'.$msg.'</h3>';

// Comme pour connexion, ne donner en dispo que si pas connecté

    $valLog = '';
    $valMdp = '';
  
  
if (!(isset($_SESSION['identifie']))) {

?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <p>Login : <input name="login1" type="text"></p>
    <p>Mot de passe : <input name="mdp1" type="password" width="125px"></p>
    <p>Confirmation du mot de passe : <input name="mdp2" type="password" width="125px"></p>
   <input name="memo" id="memo" type="checkbox" value="memo"><label for="memo">Retenir mes coordonnées d'identification</label>
    <input name="role1" type="hidden" value="">
    <p><input name="bouton_inscr" type="submit" value="INSCRIPTION"/></p>
  </form>
<?php
}

else Echo'Vous êtes connecté en tant que '.$_SESSION['pseudo'];
?>
</div> 					
					</section>

</body>
</html>
