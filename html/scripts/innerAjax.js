/**
 * Script que contém as funções para fazer o ajax
 * 
 */

var InnerAjax = {
    
    /**
     * Faz requisições Ajax em modo POST
     * 
     * @param {String} url Para onde fazer a requisição
     * @param {String} response Id do elemento que receberá a reposta
     * @param {Object} args Argumentos a serem enviados
     * @param {Boolean} async Ajax assíncrono ou não
     */
    doPOST: function(url, response, args, async)
    {
        InnerPage.mostraCarregamento();
        
        async = async || true;
        response = response || "limbo";
        
        var xhr = new XMLHttpRequest();
        
        if( async )
        {
            // Quando o status da conexão se alterar
            xhr.addEventListener("readystatechange", function()
            {
                // Se a conexão for bem sucedida
                if( xhr.readyState === 4 && xhr.status === 200 )
                {
                    InnerPage.escondeCarregamento();
                    
                    var texto = xhr.responseText;
                    
                    document.getElementById(response).innerHTML = texto;
                    
                    var scripts = document.querySelectorAll("div#" + response + " > script");
                    
                    for( var i = 0; i < scripts.length; i++ )
                    {
                        eval(scripts[i].innerHTML);
                        
                    }
                                                            
                }

            });
        
        }
        
        var data = new FormData();
        
        // Navega entre os argumentos
        for( key in args )
        {
            data.append(key, args[key]);
            
        }
        
        xhr.open("POST", url, async);
        xhr.send(data);
        
        if( !async )
        {
            response.innerHTML = xhr.responseText;
            
        }
        
    }
    
};