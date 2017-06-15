(function(){
    "use strict";
    
    $("document").ready(initialiser);
    
    function initialiser(evt){
        $(".popup").hide();
        $(".inputSubmit").click(afficherPopup);
        
    }
    
    function afficherPopup(evt){
        $(".popup").show();
        
    }
    
    
    
    
    
}())