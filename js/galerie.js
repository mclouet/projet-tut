"use strict";

document.addEventListener("DOMContentLoaded", initialiser);
document.addEventListener("DOMContentLoaded", lancer);

function initialiser(evt) {
    
    var lesBoutons = document.querySelectorAll("#selecGalerie>p"); //mise en place de l'écouteur sur les boutons de la galerie
    for (var unBouton of lesBoutons){
        unBouton.style.cursor = "pointer";
        unBouton.addEventListener("click",trierGalerie);
    }
    
    
    
}

function lancer(evt){ //au chargement de la page, les affiches seront les seules à s'afficher par défaut
   var elementsGalerie = document.querySelectorAll("#imgGalerie *"); //selection de tous les éléments enfants de la div #galerie
    
    for(var unEnfant of elementsGalerie){
         if(unEnfant.dataset.format == "audio" || unEnfant.dataset.format == "video"){
            unEnfant.style.display = "none";
         }
    }
}

function trierGalerie(evt){ 
    
    var elementsGalerie = document.querySelectorAll("#imgGalerie *"); //selection de tous les éléments enfants de la div #galerie

    if(this.innerHTML == "Affiches"){
               
        for (var unElement of elementsGalerie){
            
            if(unElement.dataset.format == "audio" || unElement.dataset.format == "video"){
                unElement.style.display = "none";          
            }
            if(unElement.dataset.format =="image" && unElement.style.display == "none"){
            unElement.style.display = "inline-flex";
            }
            
        }
    }else if(this.innerHTML == "Vidéos"){

        for (var unElement of elementsGalerie){

            if(unElement.dataset.format == "audio" || unElement.dataset.format == "image"){
            unElement.style.display = "none";          
            }
            if(unElement.dataset.format =="video" && unElement.style.display == "none"){
            unElement.style.display = "inline-flex";
            }
            
        }
    }else{
        for (var unElement of elementsGalerie){

            if(unElement.dataset.format == "image" || unElement.dataset.format == "video"){
            unElement.style.display = "none";          
            }
            if(unElement.dataset.format =="audio" && unElement.style.display == "none"){
            unElement.style.display = "inline-flex";
            }
            
        }
    }
}

        
