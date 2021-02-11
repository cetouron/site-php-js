var aTetro = [[[[0,1], [1,1], [2,1], [1,2]], [[1,0], [0,1], [1,1], [1,2]], [[1,0], [0,1], [1,1], [2,1]], [[1,0], [1,1], [1,2], [2,1]]],
               [[[0,1], [1,1], [2,1], [0,2]], [[0,0], [1,0], [1,1], [1,2]], [[0,1], [1,1], [2,1], [2,0]], [[1,0], [1,1], [1,2], [2,2]]], // Question 2
               [[[0,1], [1,1], [2,1], [2,2]], [[1,0], [1,1], [1,2], [0,2]], [[0,0], [0,1], [1,1], [2,1]], [[1,0], [2,0], [1,1], [1,2]]],
               [[[0,2], [1,2], [1,1], [2,1]], [[0,0], [0,1], [1,1], [1,2]]],
               [[[0,1], [1,1], [1,2], [2,2]], [[1,0], [1,1], [0,1], [0,2]]],
               [[[0,1], [1,1], [2,1], [3,1]], [[1,0], [1,1], [1,2], [1,3]]],
               [[[1,1], [2,1], [1,2], [2,2]]]], // Tableau des différents tétrominos
    aColor = ['blue', 'red', 'orange', 'purple', 'black', 'yellow', 'green'], // Couleurs des pièces (non demandé)
    aDimGrid = [10, 10], // Dimensions de la grille
    tDrop = 1000, // Temps de descente automatique (en ms)
    aPiece, aGrid, // Tableaux des div (de la pièce et de la grille)
    currPiece, currOrient, aCurrPos, // Pièce courante, orientation courante, position courante
    interv, // Variable setInterval (pour pouvoir l'interrompre)
    squareSz, eMain, // Taille de carré (non demandé), div principale (dans laquelle on ajoute tous les div des carrés)
    canevass, ctx,
    nbCol = [],
    nbForm = [0,0,0];

function _(sel) { // Question 1
    return document.querySelector(sel);
}

function fNbAlea(n) { // Question 1
    return Math.floor(Math.random() * n);
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

    aGrid = []
    for (var x = 0; x < aDimGrid[0]; x++) { // Pour chaque colonne de la grille
        aGrid[x] = []; // On crée la colonne
        for (var y = 0; y < aDimGrid[1]; y++) { // Pour chaque ligne de cette colonne
            aGrid[x][y] = null; // On crée une case et on met son contenu à null
        }
    }
}

function fTestPiece() { // Question 4
    for (var i = 0; i < 4; i++) { // Pour chaque carré de la pièce courante, on vérifie que le carré ne sort pas des limites de la grille et qu'il ne tombe pas sur une case déjà occupée (par un carré résiduel)
        var aPosSqr = [aCurrPos[0] + aTetro[currPiece][currOrient][i][0], aCurrPos[1] + aTetro[currPiece][currOrient][i][1]];
        if (aPosSqr[0] < 0 || aPosSqr[0] >= aDimGrid[0] || aPosSqr[1] >= aDimGrid[1] || aGrid[aPosSqr[0]][aPosSqr[1]] != null) return false;
    }
    return true;
}

function fUpdatePiece() { // Question 5
    for (var i = 0; i < 4; i++) { // Pour chaque div de la pièce courante, on positionne les propriétés CSS left et top
        aPiece[i].style.left = ((aCurrPos[0] + aTetro[currPiece][currOrient][i][0]) * squareSz) + 'px';
        aPiece[i].style.right = ((aCurrPos[0] - aTetro[currPiece][currOrient][i][0]) * squareSz) + 'px';
        aPiece[i].style.top = ((aCurrPos[1] + aTetro[currPiece][currOrient][i][1]) * squareSz) + 'px';
    }
}

function fUpdateGrid() { // Question 6
    for (var x = 0; x < aDimGrid[0]; x++) {
        for (var y = 0; y < aDimGrid[1]; y++) { // Pour chaque case de la grille
            if (aGrid[x][y] != null) { // Si la case contient une div
                aGrid[x][y].style.left = (x * squareSz) + 'px'; // On positionne les propriétés CSS left et top de cette div en fonction des coordonnées x et y de la case
                aGrid[x][y].style.right = (x * squareSz) + 'px';
                aGrid[x][y].style.top = (y * squareSz) + 'px';
            }
        }
    }
}

function fLeftRight(d) { // Question 7
    aCurrPos[0] += d; // On déplace la pièce courante
    if (fTestPiece()) fUpdatePiece(); // Si l'emplacement est valide, on met à jour les 4 div
    else aCurrPos[0] -= d; // Sinon, on replace la pièce à sa position précédente
}

function fRotate() { // Question 8
    var prevOrient = currOrient; // On mémorise l'orientation actuelle
    currOrient = (currOrient + 1) % aTetro[currPiece].length; // On passe à l'orientation suivante
    if (fTestPiece()) fUpdatePiece(); // Si cette orientation est possible, on met à jour les 4 div
    else currOrient = prevOrient; // Sinon, on revient à l'orientation précédente
}

function fLockPiece() { // Question 9
    for (var i = 0; i < 4; i++) { // Pour chaque div de la pièce courante, on copie cette div dans la case correspondante de la grille
        aGrid[aCurrPos[0] + aTetro[currPiece][currOrient][i][0]][aCurrPos[1] + aTetro[currPiece][currOrient][i][1]] = aPiece[i];
    }
}

function fClearLines() { // Question 10
    var aDone, i, yDel, x, y, nDel;
    aDone = [false, false, false, false]; // Ce tableau sert à éviter d'examiner une même ligne plusieurs fois (dans le cas où la pièce possède plusieurs carrés sur une même ligne)
    nDel = 0; // Nombre de lignes supprimées
    for (i = 0; i < 4; i++) { // Pour chaque carré de la pièce immobilisée
        if (!aDone[aTetro[currPiece][currOrient][i][1]]) { // Si la ligne correspondant à ce carré n'a pas déjà été examinée (via un autre carré de la pièce)
            aDone[aTetro[currPiece][currOrient][i][1]] = true; // On note que la ligne est examinée
            yDel = aCurrPos[1] + aTetro[currPiece][currOrient][i][1] // numéro de ligne
            for (x = 0; x < aDimGrid[0]; x++) { // Pour tous les carrés de cette ligne
                if (aGrid[x][yDel] == null) break; // Si on en trouve un vide, inutile d'aller plus loin, la ligne est incomplète
            }
            if (x == aDimGrid[0]) { // Si la ligne est complète (la boucle précédente n'a pas été quittée prématurément)
                nDel++; // On incrémente le nombre de lignes complètes
                for (var x = 0; x < aDimGrid[0]; x++) eMain.removeChild(aGrid[x][yDel]); // Suppression dans le DOM des div de la ligne
                for (var y = yDel; y > 0; y--) { // Descente dans aGrid des lignes situées au-dessus de la ligne effacée
                    for (var x = 0; x < aDimGrid[0]; x++) { // Pour chaque case de la ligne
                        aGrid[x][y] = aGrid[x][y - 1]; // La case reçoit le contenu de la case située au-dessus
                    }
                }
                for (var x = 0; x < aDimGrid[0]; x++) aGrid[x][0] = null; // On met à null les cases de la première ligne (tout en haut de la grille)
            }
        }
    }
    if (nDel > 0) fUpdateGrid(); // Si des lignes ont été effacées, une mise à jour des div de la grille est nécessaire
}

function fNewPiece() { // Question 11
    currPiece = fNbAlea(aTetro.length); // On tire une pièce au hasard dans le tableau aTetro
    currOrient = 0; // On fixe l'orientation initiale
    aCurrPos = [3, 0]; // Et la position initiale
    if (fTestPiece()) { // Si l'emplacement est libre
        for (var i = 0; i < 4; i++) { // Création des div de la pièce
            aPiece[i] = document.createElement('div');
            aPiece[i].className = 'square';
            aPiece[i].style.backgroundColor = aColor[currPiece];
            eMain.appendChild(aPiece[i]); // Ajout de la div au DOM
        }
        fUpdatePiece(); // Mise à jour de la position CSS (left et right) des div
        interv = setInterval(fDown, tDrop); // Lancement de la descente automatique
    } else document.documentElement.onkeydown = null; // Si l'emplacement n'était pas libre : fin de partie (désactivation du clavier, non demandé explicitement)
}

function fDown() { // Question 12
    aCurrPos[1]++; // On déplace la pièce courante
    if (fTestPiece()) fUpdatePiece(); // Si l'emplacement est valide, on met à jour les 4 div
    else { // Sinon, la pièce est bloquée
        aCurrPos[1]--; // On revient à la position précédente
        clearInterval(interv); // On arrête la descente automatique
        fLockPiece(); // On immobilise la pièce dans la grille
        fClearLines(); // On supprime les lignes complètes le cas échéant
        fNewPiece(); // On lance une nouvelle pièce
    }
}

function fKeyboardListener(evt) { // Question 13
    if (evt.keyCode >= 37 && evt.keyCode <= 40) {
        evt.preventDefault();
        if (evt.keyCode == 37) fLeftRight(-1);
        else if (evt.keyCode == 38) fRotate();
        else if (evt.keyCode == 39) fLeftRight(1);
        else if (evt.keyCode == 40) fDown();
    }
}

function fInit() { // Question 14
    eMain = _('#dv_main'); // div principal, dans lequel tous les div de classe square seront ajoutés

    var aDim = [window.innerWidth, window.innerHeight]; // Dans ces 7 lignes de code, on fixe les dimensions des carrés et du div de la grille en fonction de la taille disponible dans la fenêtre (non demandé explicitement)
    squareSz = Math.floor(Math.min(aDim[0] / aDimGrid[0], aDim[1] / aDimGrid[1]));
    eMain.style.width = (squareSz * aDimGrid[0]) + 'px';
    eMain.style.height = (squareSz * aDimGrid[1]) + 'px';
    
    const styleSheets = Array.from(document.styleSheets).filter(
        (styleSheet) => !styleSheet.href || styleSheet.href.startsWith(window.location.origin)
      );
  for (let style of styleSheets) {
    if (style instanceof CSSStyleSheet && style.cssRules) {
        var stl = document.styleSheets[0].cssRules[1].style; // Modification de la classe square dans la feuille de style
    }
  }

 

    stl.width = (squareSz - 20) + 'px';
    stl.height = (squareSz - 20) + 'px';
    canvass = document.getElementById('c1');
    ctx = canvass.getContext('2d');
    aPiece = []; // Initialisation de la pièce courante
    document.documentElement.onkeydown = fKeyboardListener; // Pose de l'écouteur de clavier
    fInitGrille(); // Initialisation de la grille
    fNewPiece(); // Lancement de la première pièce
    fDispose();
}


function fDispose() {

    for (var i = 0; i<3; i++) {

        for (var j = 0; j<3; j++) {
       var bol = Math.floor(Math.random() * 2);

       if (bol == 1) {

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

    console.log("Liste des formes : ");


        console.log("Carré : "+ nbForm[0]);
        console.log("Triangle : "+ nbForm[1]);
        console.log("Cercle : "+ nbForm[2]);

        console.log("Liste des couleurs : ");

    for (var i = 0; i < aColor.length; i++) { 

        console.log(aColor[i]+" : "+ nbCol[i]);

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
// Voici quelques suggestions d'amélioration (cf exam_v2) :
//  - calcul et affichage du score
//  - gestion des niveaux avec accélération du drop automatique
//  - affichage de la pièce suivante
//  - gestion plus fine du clavier (gestion des touches maintenues)
//  - gestion de partie (game over / restart)
//  - gestion du redimensionnement de la fenêtre
//  - effets sonores, musique
//  - animation lignes complètes
//  - animation game over
//  - mise en pause
//  - choix du sens de rotation des pièces
//  - gestion des hi-scores locaux (login, affichage, sauvegarde)
//  - passage serveur pour hi-scores partagés et jeu multijoueur (bdd/shmop + ajax) : un peu plus difficile
//
