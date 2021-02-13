<?php
//header("Content-type: text/html;charset=utf-8");
session_start(); 
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
  <div id="son"></div>

  <div id="container"> <canvas id='c1' width ="450" height = "450"></canvas> </div> 



<script type="text/javascript" charset="utf-8" src="jeu.js"></script>


<div align="center" id="contenu"></div> 




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
<?php include('footer.php');?>