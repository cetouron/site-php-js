<?php
//header("Content-type: text/html;charset=utf-8");
session_start(); // Comme setcookie, doit être appelée avant tout contenu (mais appel possible après un autre header)

$cnx = mysqli_connect('localhost', 'root', 'root', 'base');
$momentJeu = 'debut';
 ?>



<head>
  <title>Jeu</title>

</head>

<?php include("menu.php"); ?>

<body>
<section id="main">
<div class="inner">
<h2 align="center" > Test ta connaissance des formes et des couleurs</h2>
<h3 align="center" id="num"></h3>

  <div id="dv_main"></div>

  <div id="container"> <canvas id='c1' width ="450" height = "450"></canvas> </div> 

  <?php 
  If (isset($_POST["article"]) and !empty($_POST["comm"])) 
  {

  }
  ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript" charset="utf-8" src="jeu.js"></script>


<div align="center" id="contenu"></div> 


 <!--    <div id="question"></div>
      <input id="reponse"  value=""/>
      <input type='button' onclick="valider();"  value="Jouer !"/> type='button' onclick="valider();" 
<p>

      <div id="validation"></div>
      <input type='button' onclick="newquest();" value="Nouvelle question"/>

-->

<?php if (isset($_SESSION['pseudo'])) {
  Echo "<input id='perso' type='hidden' value='".$_SESSION['pseudo']."'/>";
}

?>

</div> 					
					</section>


</body>


</html>



<style>
#container 
{ 
 padding: 10;

    margin: auto;
    display: block;
    width: 470;

} 

  </style> 
