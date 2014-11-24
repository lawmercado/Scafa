<?php

/**
 * Controlador principal da aplicação
 *
 * @author Luís Augusto Weber Mercado
 */
class MainController extends InnerController
{

    /**
     * Ação quando o usuário entra na página
     * 
     */
    public function acaoIndex()
    {
        $Inner = Inner::instance();

        $Inner->page->render("index");

    }

    /**
     * Ação quando o usuário entra na tela de cadastro
     * 
     */
    public function acaoCadastro()
    {
        $Inner = Inner::instance();

        if( $Inner->page->isAjax )
        {
            $action = $_GET["action"];
            
            CadastroModel::$action();
                        
        }
        else
        {
            $modelo = new CadastroModel();
            
            $Inner->page->render("cadastro");
            
        }
        
    }

    /**
     * Ação quando o usuário carrega a tela de login
     * 
     */
    public function acaoLogin()
    {
        $Inner = Inner::instance();
        
        if( !$Inner->page->isAjax )
        {
            $modelo = new LoginModel();
            
            if( isset($_POST["usuario"]) )
            {
                $modelo->usuario = $_POST["usuario"];
                $modelo->senha = $_POST["senha"];

                if( $modelo->validaDados() )
                {
                    if( $modelo->login() )
                    {
                        $Inner->goToURL($Inner->getURL());

                    }

                }

            }

            $Inner->page->render("login");
            
        }
        else
        {
            $action = $_GET["action"];
            
            LoginModel::$action();
            
        }
        
    }
    
    /**
     * Ação quando o usuário carrega a tela de relatórios
     * 
     */
    public function acaoRelatorio()
    {
        $Inner = Inner::instance();
        
        if( !$Inner->page->isAjax )
        {
            $Inner->page->render("relatorio");
            
        }
        else
        {
            $action = $_GET["action"];
            
            RelatorioModel::$action();
            
        }
        
    }

}

?>