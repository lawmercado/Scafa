/**
 * Script responsável por realizar as ações dos menus (esconder e mostrar)
 * 
 */
window.addEventListener("load", function()
{
    var innerMenu = {
        elementos: {
            container: document.getElementById("menu"),
            button: document.getElementById("btnMenu")
            
        },
        
        open: function()
        {
            innerMenu.elementos.container.className = "menu-opened";
            innerMenu.elementos.button.className = "menu-active";
            
        },
        
        close: function()
        {
            innerMenu.elementos.container.className = "menu-closed";
            innerMenu.elementos.button.className = "";
            
        },
        
        setup: function()
        {
            this.elementos.button.addEventListener("click", function()
            {
                var container = innerMenu.elementos.container;
                
                var className = container.className;

                if( className === "menu-opened" )
                {
                    innerMenu.close();

                }
                else
                {
                    innerMenu.open();

                }

            });
            
        }
        
    };
    
    innerMenu.setup();
    
});