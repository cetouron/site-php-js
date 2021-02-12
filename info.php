<?php
header("Content-type: text/html;charset=utf-8");
session_start(); // Comme setcookie, doit être appelée avant tout contenu (mais appel possible après un autre header)


 ?>

<html>

<?php include("menu.php"); ?>


<body>

<section id="main">
<div class="inner">

<h1> Plus d'info </h1>

<h2> Présentation : </h2>

<span>Enseignante depuis plus de 20 ans avec des classes de Petite Section, j'ai ensiengé à plus de 700 élèves. Certains parfois aujourd'hui les enfants des enfants à qui j'ai appris les bases de l'école.
</span>

<br> <br> <br>

<h3>Me contacter</h3>
            
<?php

$destinataire = 'cedric.touron@univ-lyon2.fr';


function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}


If (!empty($_POST["cont"]) && !empty($_POST["adresse"]) && !empty($_POST["objet"]) && !empty($_POST["nom"]))
	{

        if(IsEmail($_POST["adresse"])) {


        $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From:'.$_POST["nom"].' <'.$_POST["adresse"].'>' . "\r\n" .
				'Reply-To:'.$_POST["adresse"]. "\r\n";
       $retour = mail('cedric.touron@univ-lyon2.fr', $_POST["objet"], $_POST["cont"], $headers);
			if ($retour) {
                echo '<p>Le mail a été envoyé!</p>';
            }
        


    }
    else
	{
        
		echo '<p>Votre email est invalide !</p>';
    }
    
 } else {if (isset($_POST["cont"]) or isset($_POST["adresse"]) or isset($_POST["objet"]) or isset($_POST["nom"])) {
            Echo'<h2> Oups ! Il manque quelque chose...</h2>';
            Echo'<p>Merci de bien remplir tout le <strong>formulaire de mailing</strong>';			 
         }} 


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