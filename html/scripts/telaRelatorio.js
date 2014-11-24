/**
 * Script gerenciador da tela de cadastro
 * 
 */

function listaDados()
{
    var url = location.origin + "/?call=relatorio&from=main&action=lista";

    InnerAjax.doPOST(url, "resultContainer", { filtro: document.getElementById("inCampoFiltro").value, tipo: document.querySelector("input[name='tipoCadastro']:checked").value });
    
}

window.addEventListener("load", function()
{
    listaDados();
    
    console.log(document.getElementsByTagName("form")[0]);
    
    document.getElementsByTagName("form")[0].addEventListener("submit", function(e)
    {
        listaDados();
        
        e.preventDefault();
        
        return false;
        
    });
     
    document.getElementById("btBuscar").addEventListener("click", listaDados);
    var radiosTipo = document.querySelectorAll("input[name='tipoCadastro']");
    
    radiosTipo[0].addEventListener("click", listaDados);
    radiosTipo[1].addEventListener("click", listaDados);
    
});