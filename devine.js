var 
    aColor = ['blue', 'red', 'yellow'], // Couleurs des pièces (non demandé)
    quest = ['en tout', 'carrée', 'triangle', 'ronde', 'bleu', 'rouge', 'jaune'],
    tabRep = [],
    canevass, ctx, tot=0, q,
    nbCol = [],
    nbForm = [0,0,0];

function _(sel) { // Question 1
    return document.querySelector(sel);
}


onload = fInit; // Question 1

function fInitGrille() { // Question 3

    ctx.beginPath();
    ctx.moveTo(150, 0);
    ctx.lineTo(150, 450);
    ctx.moveTo(300, 0);
    ctx.lineTo(300, 450);
    ctx.moveTo(0, 150);
    ctx.lineTo(450, 150);
    ctx.moveTo(0, 300);
    ctx.lineTo(450, 300);
    ctx.strokeStyle = 'black';
    ctx.lineWidth = 1;
    ctx.closePath();
    ctx.stroke();
    
    for (var i = 0; i < 3; i++) { 
        nbForm[i]=0;
    }

    for (var i = 0; i < aColor.length; i++) { 
        nbCol[i]=0;
    }


}


function fInit() { // Question 14
    eMain = _('#dv_main'); // div principal, dans lequel tous les div de classe square seront ajoutés

   
    canvass = document.getElementById('c1');
    ctx = canvass.getContext('2d');

    fInitGrille(); // Initialisation de la grille
    fDispose();
    form();

}


function fDispose() {

    for (var i = 0; i<3; i++) {

        for (var j = 0; j<3; j++) {
       var bol = Math.floor(Math.random() * 2);

       if (bol == 1) {
        tot++;
        forme = Math.floor(Math.random() * 3);
        k = (Math.floor(Math.random() * aColor.length));
        col = aColor[k];
        nbCol[k]++;
        nbForm[forme]++;

        switch (forme) {

            case 1:
                fTriangle(col, i, j);
            break;

            case 2:
                fCercle(col, i, j);
            break;

            case 0:
                fCarre(col, i, j);
            break;

        }

        }

       }


    }

    tabRep[0]=tot;

    console.log("Liste des formes : ");


        console.log("Carré : "+ nbForm[0]);
        tabRep[1]=nbForm[0];

        console.log("Triangle : "+ nbForm[1]);
        tabRep[2]=nbForm[1];

        console.log("Cercle : "+ nbForm[2]);
        tabRep[3]=nbForm[2];

        console.log("Liste des couleurs : ");

    for (var i = 0; i < aColor.length; i++) { 

        console.log(aColor[i]+" : "+ nbCol[i]);
        tabRep[4+i]=nbCol[i];

    }

    





}

function fCercle(couleur, h, l) { 

    ctx.beginPath();   
    ctx.fillStyle = couleur;
    ctx.arc( 75+ 150*h, 75+ 150*l,50, 0, 2*Math.PI);  //Les 2 premiers indique le centre, le 3ème le diamètre, le 4 fait des découpages 
    ctx.fill();
    ctx.closePath();

}
function fCarre(couleur, h, l) { 

ctx.beginPath();
ctx.moveTo(25 + 150*h, 25 + 150*l);
ctx.lineTo(25 + 150*h, 125 + 150*l);
ctx.lineTo(125 + 150*h, 125 + 150*l);
ctx.lineTo(125 + 150*h, 25 + 150*l);
ctx.lineTo(25 + 150*h, 25 + 150*l);
ctx.fillStyle = couleur; 
ctx.fill();
ctx.closePath();


}

function fTriangle(couleur, h, l) { 
  
ctx.beginPath();
ctx.moveTo(25 + 150*h, 25 + 150*l);
ctx.lineTo(25 + 150*h, 125 + 150*l);
ctx.lineTo(125 + 150*h, 125 + 150*l);
ctx.lineTo(25 + 150*h, 25 + 150*l);
ctx.fillStyle = couleur; 
ctx.fill();
ctx.closePath();

    
    }



function form() {

  q = (Math.floor(Math.random() * quest.length));

  document.getElementById("question").value= quest[q];          


   /*   //Création dynamique du formulaire
    var form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', '#');
    //Ajout des paramètres sous forme de champs cachés

    var question = document.createElement('input');
    question.setAttribute('type', 'hidden');
    question.setAttribute('name', 'question');
    question.setAttribute('value', quest[q]);
    form.appendChild(question);
 
    var reponse = document.createElement('input');
    reponse.setAttribute('type', 'hidden');
    reponse.setAttribute('name', 'reponse');
    reponse.setAttribute('value', tabRep[q]);
    form.appendChild(reponse);

    //Ajout du formulaire à la page et soumission du formulaire
    document.body.appendChild(form);
    form.submit();  */
 

  /*    // tu crée l'objet :
    var xhr = getXMLHttpRequest();
    // t'as codé ce constructeur précédemment
 
    if(xhr && xhr.readyState != 0){
        xhr.abort();
    }
 
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
      // tu peux récupérer en JS le résultat du traitement avec xhr.responseText;
    }
    else if(xhr.readyState == 2 || xhr.readyState == 3){ // traitement non fini
      // tu peux mettre un message ou un gif de chargement par exemple
    }
    }
    console.log("question="+quest[q]);

    xhr.open("POST", 'jeu.php', true); // true pour asynchrone
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // seulement si t'as choisi la méthode POST !
    xhr.send("question="+quest[q]); // "&reponse="+tabRep[q] éventuellement t'envois plusieurs variables séparées 
        */

 /* let requete = $("#jouer").submit(function(e){
          console.log("ok");
  
          e.preventDefault();
          $.ajax({
             url : 'jeu.php',
             type : 'POST', // Le type de la requête HTTP, ici devenu POST
             data : 'question=' + quest[q] + '&reponse=' + tabRep[q], // On fait passer nos variables, exactement comme en GET, au script more_com.php
             dataType : 'html'
          });
         
      });
      requete.done( function(data) {
        // L'information retournée par le code PHP se trouve
        // dans la variabe data. 
      });*/

      $.ajax({
        type: "POST",
        url: 'jeu.php',
        data: {question:'toto'},
        success: function(data)
        {
        alert(data);
        }
        });
    }

  /*  $("#jouer").submit(function(e){
        console.log("ok");

        e.preventDefault();
        $.ajax({
           url : 'jeu.php',
           type : 'POST', // Le type de la requête HTTP, ici devenu POST
           data : 'question=' + quest[q] + '&reponse=' + tabRep[q], // On fait passer nos variables, exactement comme en GET, au script more_com.php
           dataType : 'html'
        });
       
    }); */
    


    function getXMLHttpRequest() {
        var xhr = null;
  
        if(window.XMLHttpRequest || window.ActiveXObject) {
                if(window.ActiveXObject) {
                        try {
                                xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch(e) {
                                xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                } else {
                        xhr = new XMLHttpRequest();
                }
        } else {
                alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
                return null;
        }
  
        return xhr;
}