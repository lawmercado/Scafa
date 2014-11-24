/**
 * Script que contém as funções de utilidade
 * 
 */

var InnerUtils = {
    
    mudaEstadoElementosFilhos: function(parent, disable)
    {
        var childs = parent.childNodes;
        
        for( var i = 0; i < childs.length; i++ )
        {
            childs.disabled = disable;
            
        }
        
    },
    
    removeElementosFilhos: function(parent)
    {
        while( parent.firstChild )
        {
            parent.removeChild(parent.firstChild);
            
        }
        
    },
    
    addErroInput: function(id, mensagem)
    {
        document.getElementById("erro_" + id).innerHTML = mensagem;
        
    }
    
};


