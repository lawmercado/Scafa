/**
 * Script gerenciador da tela de cadastro
 * 
 */

// Executar apenas quando a página carregar
window.addEventListener("load", function()
{
    console.log("OIEOEIOIE");
    
    document.getElementsByTagName("form")[0].addEventListener("submit", function()
    {
        listaDados();
        
        console.log("OIEOEIOIE");
        
        return false;
        
    });
    
    var radiosModoCadastro = document.querySelectorAll("input[name='modoCadastro']"),
        desabilitaElementos = function(radioid)
        {
            var currFieldSet = document.getElementById("fs" + radioid.substring(2));
            
            currFieldSet.classList.remove("unfocus");
            
            var id = document.querySelector("input[name='modoCadastro']:not(:checked)").id.substring(2);
            
            var otherFieldset = document.getElementById("fs" + id);
            
            otherFieldset.classList.add("unfocus");
            
        };
    
    
    radiosModoCadastro[0].addEventListener("click", function()
    {
        desabilitaElementos(this.id);
        
    });
    
    radiosModoCadastro[1].addEventListener("click", function()
    {
        desabilitaElementos(this.id);
        
    });
    
    var evento = new Event("click");
    
    radiosModoCadastro[0].dispatchEvent(evento);
   
    // Input matrícula
    var inputMatricula = document.getElementById("inNumMatricula");
    
    // Ao chegar 12 dígitos
    inputMatricula.addEventListener("input", function()
    {
        if( this.checkValidity() )
        {
            if( this.value.length === this.maxLength )
            {
                var url = location.origin + "/?call=cadastro&from=main&action=confirma";

                InnerAjax.doPOST(url, null, { matricula: this.value, tipo: document.querySelector("input[name='tipoCadastro']:checked").value });

            }
            
        }
        else
        {
            InnerUtils.addErroInput(this.id, "Informe apenas números");
            
        }
        
    });
    
    // Input matrícula
    var inputNome = document.getElementById("inNome");
    
    // Ao chegar 12 dígitos
    var previousInputValLength = 0;
    
    inputNome.addEventListener("input", function()
    {
        console.log("OIOIEOE");
        
        if( this.checkValidity() )
        {
            console.log("ALLOU");
            
            if( (previousInputValLength + 1) < this.value.length )
            {
                var url = location.origin + "/?call=cadastro&from=main&action=confirma";

                InnerAjax.doPOST(url, null, { nome: this.value, tipo: document.querySelector("input[name='tipoCadastro']:checked").value });
                
                console.log("AOIAOIAIA");
                
            }
            else
            {
                var url = location.origin + "/?call=cadastro&from=main&action=procuraNome";

                InnerAjax.doPOST(url, null, { nome: this.value, tipo: document.querySelector("input[name='tipoCadastro']:checked").value });
                
                console.log("AHAHAHA");
                
            }
            
            previousInputValLength = this.value.length;
            
        }
        
    });
    
    inputNome.addEventListener("blur", function()
    {
        console.log("AKISUD");
        
    });
    
    var listaNomes = document.getElementById("listaNome");
    
    listaNomes.addEventListener("click", function()
    {
        console.log("OIEE");
        
        var url = location.origin + "/?call=cadastro&from=main&action=cadastra";

        InnerAjax.doPOST(url, null, { nome: this.value, tipo: document.querySelector("input[name='tipoCadastro']:checked").value });
        
    });
    
});