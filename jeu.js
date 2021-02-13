var 
    aColor = ['blue', 'red', 'yellow'], // Couleurs des pièces (non demandé)
    quest = ['en tout', 'carrée', 'triangle', 'ronde', 'bleu', 'rouge', 'jaune'],
    tabRep = [],
    canevass, ctx, tot=0, q, nbq, score,
    nbCol = [],
    nbForm = [0,0,0],
    momentJeu = 'intro';


onload = fInit; // Question 1

function _(sel) { // Question 1
    return document.querySelector(sel);
}

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
    ctx.moveTo(0, 0);
    ctx.lineTo(0, 450);
    ctx.lineTo(450, 450);
    ctx.lineTo(450, 0);
    ctx.lineTo(0, 0);
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
    c1.width=450;
    c1.height=450;
    nbq=0;
    fInitGrille(); // Initialisation de la grille
    document.getElementById("num").innerHTML= 'Appuyez sur "Jouer !" pour commencer'; 
    document.getElementById("contenu").innerHTML=  '</br> <h5 id="validation">Trouve le nombre de même forme, même couleur qui s\'affiche.</h5>  <input type="button" onclick="newquest();" value="Jouer !"/>';
    score=0;

}


function fDispose() {
    tot=0;
    
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

  document.getElementById("contenu").innerHTML= '<h5 id="question"></h5> <input id="reponse"  value=""/> <input type="button" onclick="valider();" value="Valider"/> <!-- type="button" onclick="valider();"';
  document.getElementById("son").innerHTML='<audio id="questi" style="display: none;"> <source src="sons/'+quest[q]+'.mp3"> </audio>';
  document.getElementById("question").innerHTML= "Combien y a t'il de forme "+quest[q]+" ? <img src='images/son.png' height='15' onclick='oral();'/>  ";          


  
    }






    function valider() {
        

        console.log(tabRep[q]);
        console.log(document.getElementById("reponse").value);



        if (document.getElementById("reponse").value == tabRep[q] && document.getElementById("reponse").value != '') {
            score++;
            if (nbq==10) document.getElementById("contenu").innerHTML= '<h5 id="validation"></h5> <input type="button" onclick="newquest();" value="Fin du jeu"/>';
            else document.getElementById("contenu").innerHTML= '<h5 id="validation"></h5> <input type="button" onclick="newquest();" value="Nouvelle question"/>';

            if (tabRep[q]>=2 && quest[q]=="en tout") document.getElementById("validation").innerHTML= "Bravo, il y a bien "+tabRep[q]+" formes "+quest[q]+"."; 
            else if (quest[q]=="en tout") document.getElementById("validation").innerHTML= "Bravo, il y a bien "+tabRep[q]+" forme "+quest[q]+"."; 
            else if (tabRep[q]>=2) document.getElementById("validation").innerHTML= "Bravo, il y a bien "+tabRep[q]+" formes "+quest[q]+"s."; 
            else document.getElementById("validation").innerHTML= "Bravo, il y a bien "+tabRep[q]+" forme "+quest[q]+"."; 
            
            document.getElementById("validation").color= 'green';          
                     
        }  else if (document.getElementById("reponse").value == '') {
            document.getElementById("contenu").innerHTML= '<h5 id="validation"></h5> <h5 id="question"></h5> <input id="reponse"  value=""/> <input type="button" onclick="valider();" value="Valider"/>';
            document.getElementById("question").innerHTML= "Combien y a t'il de forme "+quest[q]+" ?";          
            document.getElementById("validation").innerHTML="Tu as oublié de répondre !"
        } 
        else
        {
            document.getElementById("contenu").innerHTML= '<h5 id="validation"></h5> <input type="button" onclick="newquest();" value="Nouvelle question"/>';
            if (tabRep[q]>=2 && quest[q]=="en tout") document.getElementById("validation").innerHTML= "C'est faux... il y a "+tabRep[q]+" formes "+quest[q]+".";  
            else if (quest[q]=="en tout") document.getElementById("validation").innerHTML= "C'est faux... il y a "+tabRep[q]+" formes "+quest[q]+".";
            else if (tabRep[q]>=2) document.getElementById("validation").innerHTML= "C'est faux... il y a "+tabRep[q]+" formes "+quest[q]+"s."; 
            else document.getElementById("validation").innerHTML= "C'est faux... il y a "+tabRep[q]+" forme "+quest[q]+".";         }
        


}

function newquest() {

    nbq++;
    if (nbq<=10) {

    document.getElementById("num").innerHTML= "Question n°"+nbq; 
    ctx.clearRect(0, 0, c1.width, c1.height);
    fInitGrille(); // Initialisation de la grille
    fDispose();
    form();  
    }

    else {
        document.getElementById("num").innerHTML= "C'est fini !"; 
        document.getElementById("contenu").innerHTML= '<h4>Tu as eu '+score+' point(s) ! </h4>  <input type="button" onclick="fInit();" value="Rejouer"/> ';  


        c1.width=0;
        c1.height=0;
    }
}



function oral() {

    document.getElementById('questi').play();
}



