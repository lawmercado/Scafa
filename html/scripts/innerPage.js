/**
 * Script que contém o setup de alguns elementos da página
 * 
 */

var InnerPage = {
    
    /**
     * Mostra a tela de carregamento
     * 
     */
    mostraCarregamento: function()
    {
        var mask = document.getElementById("mask");
                
        mask.style.display = "block";

        setTimeout(function() {
            mask.classList.remove("invisible");

        }, 10);
        
        var carregamento = document.getElementById("carregando");
        
        carregamento.style.display = "block";
        
    },
    
    /**
     * Esconde a tela de carregamento
     * 
     */
    escondeCarregamento: function()
    {
        var mask = document.getElementById("mask");
        var carregamento = document.getElementById("carregando");
        
        carregamento.style.display = "none";
        
        mask.style.display = "none";
            
        mask.classList.add("invisible");
                
    }
    
};

window.addEventListener("load", function()
{
   var mask = document.getElementById("mask");
   
   mask.addEventListener("click", function(evento)
   {
        if( !mask.classList.contains("invisible") )
        {
            mask.style.display = "none";
            
            mask.classList.add("invisible");
            
            InnerUtils.removeElementosFilhos(this.childNodes[1]);
            
        }
       
   });
    
});