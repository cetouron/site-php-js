//Déclaration des vairiables

var 
    aColor = ['blue', 'red', 'yellow'], //couleur
    quest = ['en tout', 'carrée', 'triangle', 'ronde', 'bleu', 'rouge', 'jaune'], //Les questions possibles
    tabRep = [], //Table des réponses associées
    canevass, ctx, tot=0, q, nbq, score, // Canvas, contexte, total, num de question, nombre de question, score
    nbCol = [], //Nombre de forme de tel couleur
    nbForm = [0,0,0], // Nombre de forme de tel forme


onload = fInit;

function _(sel) { 
    return document.querySelector(sel);
}

function fInitGrille() {
//Création de la grille
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
    
    //Mise à 0 de la comptabilité de chaque forme et couleur 
    for (var i = 0; i < 3; i++) { 
        nbForm[i]=0;
    }

    for (var i = 0; i < aColor.length; i++) { 
        nbCol[i]=0;
    }


}


function fInit() { 
    eMain = _('#dv_main'); 

    canvass = document.getElementById('c1');
    ctx = canvass.getContext('2d');
    //Format carré 450x450
    c1.width=450;
    c1.height=450;
    nbq=0; //Num de question
    fInitGrille(); // Initialisation de la grille
    //Début du jeu
    document.getElementById("num").innerHTML= 'Appuyez sur "Jouer !" pour commencer'; 
    //Règle + Bouton jouer 
    document.getElementById("contenu").innerHTML=  '</br> <h5 id="validation">Trouve le nombre de même forme, même couleur qui s\'affiche.</h5>  <input type="button" onclick="newquest();" value="Jouer !"/>';
  //Initialisation du score
    score=0;

}

//Installe les formes dans la grille
function fDispose() {

    tot=0; //Total de forme
    //Pour les case en lignes x les cases en colonnes 
    for (var i = 0; i<3; i++) {

        for (var j = 0; j<3; j++) {
            //Va t'on mettre une forme dans la case ? 
       var bol = Math.floor(Math.random() * 2); //0 ou  1

       if (bol == 1) { //Si 1, alors on met une forme
        tot++; //Total +1
        forme = Math.floor(Math.random() * 3); //Choix aléatoire de la forme
        k = (Math.floor(Math.random() * aColor.length)); //Choix aléatoire de la couleur
        col = aColor[k]; //Couleur
        nbCol[k]++; //Tableau des compte de la couleur +1
        nbForm[forme]++; // De même pour la forme 

        // Selon la forme, tracé différent avec la couleur et la place x,y de la case actuelle
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

    tabRep[0]=tot; //Table des réponse, case 0 'en tout' 

    console.log("Liste des formes : ");


        console.log("Carré : "+ nbForm[0]);
        tabRep[1]=nbForm[0]; // Réponse carré

        console.log("Triangle : "+ nbForm[1]);
        tabRep[2]=nbForm[1]; // Reponse Triangle

        console.log("Cercle : "+ nbForm[2]);
        tabRep[3]=nbForm[2]; // réponse cercle

        console.log("Liste des couleurs : ");

    for (var i = 0; i < aColor.length; i++) { 

        console.log(aColor[i]+" : "+ nbCol[i]);
        tabRep[4+i]=nbCol[i]; // Réponse couleur

    }

}

//Tracé du cercle 
function fCercle(couleur, h, l) { 

    ctx.beginPath();   
    ctx.fillStyle = couleur;
    ctx.arc( 75+ 150*h, 75+ 150*l,50, 0, 2*Math.PI);  //Les 2 premiers indique le centre, le 3ème le diamètre, le 4 fait des découpages 
    ctx.fill();
    ctx.closePath();

}

//Tracé du carré 
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

//Tracé du Triangle
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


//Mise en place de la nouvelle question
function form() {

    //Choix de la question 
  q = (Math.floor(Math.random() * quest.length));
//Mise en place conteneur et boutons
  document.getElementById("contenu").innerHTML= '<h5 id="question"></h5> <input id="reponse"  value=""/> <input type="button" onclick="valider();" value="Valider"/> <!-- type="button" onclick="valider();"';
  // Mise en place de l'audio
  document.getElementById("son").innerHTML='<audio id="questi" style="display: none;"> <source src="sons/'+quest[q]+'.mp3"> </audio>';
  //Mise en place de la question et image pour son
  document.getElementById("question").innerHTML= "Combien y a t'il de forme "+quest[q]+" ? <img src='images/son.png' height='15' onclick='oral();'/>  ";          

    }





//Valider la réponse, 
    function valider() {
        
// Si la réponse donnée correspond à la bonne réponse (et que ce n'est pas vide)
        if (document.getElementById("reponse").value == tabRep[q] && document.getElementById("reponse").value != '') {
            score++; //Score + 1
            //Si dernière question, conteneur et boutons fin de jeu
            if (nbq==10) document.getElementById("contenu").innerHTML= '<h5 id="validation"></h5> <input type="button" onclick="newquest();" value="Fin du jeu"/>';
           //bouton nouvelle question
            else document.getElementById("contenu").innerHTML= '<h5 id="validation"></h5> <input type="button" onclick="newquest();" value="Nouvelle question"/>';
                //Si la réponse est supérieur à 1 et la question était 'en tout', pas de s en plus à 'tout's
            if (tabRep[q]>=2 && quest[q]=="en tout") document.getElementById("validation").innerHTML= "Bravo, il y a bien "+tabRep[q]+" formes "+quest[q]+"."; 
            else if (quest[q]=="en tout") document.getElementById("validation").innerHTML= "Bravo, il y a bien "+tabRep[q]+" forme "+quest[q]+"."; 
            else if (tabRep[q]>=2) document.getElementById("validation").innerHTML= "Bravo, il y a bien "+tabRep[q]+" formes "+quest[q]+"s."; 
            else document.getElementById("validation").innerHTML= "Bravo, il y a bien "+tabRep[q]+" forme "+quest[q]+"."; 
            // en bref, gestion du pluriel 
            document.getElementById("validation").color= 'green';          
                     //Si oublie de réponse, repose la question
        }  else if (document.getElementById("reponse").value == '') {
            document.getElementById("contenu").innerHTML= '<h5 id="validation"></h5> <h5 id="question"></h5> <input id="reponse"  value=""/> <input type="button" onclick="valider();" value="Valider"/>';
            document.getElementById("question").innerHTML= "Combien y a t'il de forme "+quest[q]+" ?";          
            document.getElementById("validation").innerHTML="Tu as oublié de répondre !"
        } 
        else // Si j'ai faux
        {
            document.getElementById("contenu").innerHTML= '<h5 id="validation"></h5> <input type="button" onclick="newquest();" value="Nouvelle question"/>';
            if (tabRep[q]>=2 && quest[q]=="en tout") document.getElementById("validation").innerHTML= "C'est faux... il y a "+tabRep[q]+" formes "+quest[q]+".";  
            else if (quest[q]=="en tout") document.getElementById("validation").innerHTML= "C'est faux... il y a "+tabRep[q]+" formes "+quest[q]+".";
            else if (tabRep[q]>=2) document.getElementById("validation").innerHTML= "C'est faux... il y a "+tabRep[q]+" formes "+quest[q]+"s."; 
            else document.getElementById("validation").innerHTML= "C'est faux... il y a "+tabRep[q]+" forme "+quest[q]+".";         }
        


}

//Nouvelle question 
function newquest() {

    nbq++; // Nombre de question +1

    if (nbq<=10) { //tant que c'est pas la dernière question

    //Redessine la grille et les formes 
    document.getElementById("num").innerHTML= "Question n°"+nbq; 
    ctx.clearRect(0, 0, c1.width, c1.height);
    fInitGrille(); 
    fDispose();
    form();  
    }

    else { // Sinon, fin du jeu affichage des points et Rejouer ?
        document.getElementById("num").innerHTML= "C'est fini !"; 
        document.getElementById("contenu").innerHTML= '<h4>Tu as eu '+score+' point(s) ! </h4>  <input type="button" onclick="fInit();" value="Rejouer"/> ';  


        c1.width=0;
        c1.height=0;
    }
}


//Lancer le son de la question 
function oral() {

    document.getElementById('questi').play();
}



