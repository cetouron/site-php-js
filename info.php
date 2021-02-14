<?php
header("Content-type: text/html;charset=utf-8");
session_start(); 

 ?>

<html>

<?php include("menu.php"); ?>


<body>

<section id="main">
<div class="inner">

<h1> Plus d'info </h1>
<!--Présentation supplémentaire-->
<h2> Présentation : </h2>

<span>Enseignante depuis plus de 26 ans dont plus de 20 ans en Petite Section, j'ai enseigné à plus de 700 élèves dans la même école. Aujourd'hui, je commence à avoir les enfants d'élèves que j'ai eu au début de ma carrière, un bon coup de vieux!</span>

<br> <br> <br>

<!--Formulaire de contact -->
<h3>Me contacter</h3>
            
<?php

$destinataire = 'cedric.touron@univ-lyon2.fr';

//Vérification de la fiabilité de l'adresse email inscrite
function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}

//Si aucun champs du formulaire n'est vide
If (!empty($_POST["cont"]) && !empty($_POST["adresse"]) && !empty($_POST["objet"]) && !empty($_POST["nom"]))
	{
//Si email valide
        if(IsEmail($_POST["adresse"])) {

//information recu par mail mais aussi pour répondre avec l'adresse
        $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From:'.$_POST["nom"].' <'.$_POST["adresse"].'>' . "\r\n" .
                'Reply-To:'.$_POST["adresse"]. "\r\n";
                //Envoie du mail
       $retour = mail('cedric.touron@univ-lyon2.fr', $_POST["objet"], $_POST["cont"], $headers);
			if ($retour) {
                echo '<p>Le mail a été envoyé!</p>';
            }
        


    }
    else
	{
        //Mail invalide
		echo '<p>Votre email est invalide !</p>';
    }
    //Il manque au moins un élément
 } else {if (isset($_POST["cont"]) or isset($_POST["adresse"]) or isset($_POST["objet"]) or isset($_POST["nom"])) {
            Echo'<h2> Oups ! Il manque quelque chose...</h2>';
            Echo'<p>Merci de bien remplir tout le <strong>formulaire de mailing</strong>';			 
         }} 

//Formulaire de contact
    Echo'<form action="info.php" method="POST" enctype="multipart/form-data">';		
    Echo'Votre nom : ';
    Echo'<input name="nom" type="text"></p>';              
    Echo'Votre adresse : ';
    Echo'<input name="adresse" type="text"></p>';
    Echo'Objet : ';
    Echo'<input name="objet" type="text"></p>';

    Echo'Message : ';
    Echo'<textarea name="cont" rows="10" cols="20"></textarea>';

    Echo'</p>';
    Echo'<input type="submit" size="10" value="Envoyer" /><input type="reset" size="10" value="Effacer" />';
    
    Echo'</p>';
    Echo'</form>';




?>

</div>
</section>
</body>
</html>
