<?php
header("Content-type: text/html;charset=utf-8");
session_start(); 
$cnx = mysqli_connect('localhost', 'root', 'root', 'base');
mysqli_query($cnx, "CREATE TABLE IF NOT EXISTS membre (num INT UNSIGNED AUTO_INCREMENT NOT NULL, login VARCHAR(64) NOT NULL, mdp VARCHAR(64) NOT NULL, role VARCHAR(5) NOT NULL, PRIMARY KEY(num))") or die ("Erreur de création de table");

$msg = '';

// Si formulaire POST
 if (isset($_POST['bouton_inscr'])) {
  // Si il n'y a pas tout les élements, c'est incomplet
  if (empty($_POST['login1']) || empty($_POST['mdp1'])) $msg = 'Formulaire incomplet !';
  //Si le mot de passe, et le mot de passe vérifié ne sont pas les mêmes
  else if ($_POST['mdp1'] != $_POST['mdp2']) $msg = 'Mots de passe différents !';
  //Si ça va on tente de l'ajouter à la base 
  else {
    $res = mysqli_query($cnx, "SELECT * FROM membre WHERE login='" . $_POST['login1'] ."'");
    //Le login est il déjà dans la base ?
    if ($res && mysqli_fetch_row($res)) $msg = 'Login déjà présent dans la base !';
    else {
      //Si non, on ajout l'enregistrement
      mysqli_query($cnx, "INSERT INTO membre (role, login, mdp) VALUES ('" . $_POST['role1'] . "','" . $_POST['login1'] . "', MD5('" . $_POST['mdp1'] . "'))") or die ("Erreur d'insertion");
      $msg = 'Vous voilà inscrit(e) ! Page d\'accueil dans quelques secondes. Si celle-ci ne s\'affiche pas, <p><strong><a href="accueil.php">cliquez ici</a></strong></p>';
     //Variable de session pour retrouver le login et si on est connecté
      $_SESSION['pseudo']=$_POST['login1'];
      $_SESSION['identifie'] = true;


      // Ajout des cookies si l'option a été validé
      if (isset($_POST['memo'])) {
        setcookie("membre[login]", $_POST['login1'], time() + 3600*24*365); 

        setcookie("membre[mdp]", md5($_POST['mdp1']), time() + 3600*24*365);

      }
      //Inscription terminé, au bout de 5 secondes, redirection
      echo '<meta http-equiv="refresh" content="5;url=accueil.php"/>;';

    }
  }
}


include("menu.php"); 

echo '<html><body> <section id="main">
      <div class="inner"> <h2>Inscription</h2><h3>'.$msg.'</h3>';

    $valLog = '';
    $valMdp = '';
  
  //Si on est pas déjà identifié, alors formulaire d'inscription
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
//Sinon, déjà connecté
else Echo'Vous êtes connecté en tant que '.$_SESSION['pseudo'];
?>
</div> 					
					</section>

</body>
</html>
<?php include('footer.php');?>