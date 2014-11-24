<?php
    
/**
 * Classe relacionada diretamente a página, utilizada na classe Inner
 * 
 */
class InnerPage {

    /**
     * Constantes
     * 
     */
    const TIPO_MENSAGEM_ERRO = "erro";
    const TIPO_MENSAGEM_INFO = "info";
    const TIPO_MENSAGEM_SUCESSO = "sucesso";
    
    private $isAjax;

    /**
     * Conteúdo corrente da página
     * 
     * @var String 
     */
    private $content;

    /**
     *
     * @var String Código em JS a ser adicionado 
     */
    private $onload;

    /**
     * Nome do atributo que deseja-se retornar
     * 
     * @param String $name
     * @return Attr Value
     */
    public function __get($name)
    {
        return $this->$name;

    }        

    public function setAJAX($isAjax)
    {
        $this->isAjax = $isAjax;
        
    }
    
    /**
     * Carrega a template baseada nas configurações
     * 
     */
    private function renderAll()
    {
        $theme = Inner::instance()->getPref("tema");

        require("themes/{$theme}/template.php");

    }

    /**
     * Renderiza a view (página) na tela
     * 
     * @param String $view Nome da view a ser carregada
     * @return String Página a ser mostrada
     */
    public function render($view)
    {
        ob_start();
        ob_implicit_flush(false);
        require(__DIR__ . "/../views/{$view}.php");

        $this->content = $this->getOnLoad();
        $this->content .= ob_get_clean();

        $this->renderAll();

    }

    /**
     * Seta algum erro na sessão
     * 
     * @param String $erro
     */
    public function addErro($erro)
    {
        $compl = isset($_SESSION["errorMessage"]) ? "{$_SESSION["errorMessage"]}<br/>" : "";

        $_SESSION["errorMessage"] = $compl . $erro . "<br/>";

    }

    /**
     * Retorna os erros cadastrados
     * 
     * @return String Erro
     */
    public function getErro()
    {
        if( isset($_SESSION["errorMessage"]) )
        {
            $return = $_SESSION["errorMessage"];

            unset($_SESSION["errorMessage"]);

            return $return;

        }

    }

    /**
     * 
     * @param String $js Código JS a ser adicionado a página
     */
    public function addJSAJAX($js)
    {
        echo "<script>{$js}</script>";

    }

    /**
     * 
     * @param String $js Código JS a ser adicionado a página
     */
    public function addToLoad($js)
    {
        $this->onload .= $js . "\n";

    }

    public function getOnLoad()
    {
        $js = "
            <script>
                window.addEventListener('load', function()
                {
                    {$this->onload}

                });

            </script>

        ";
                    
        $this->onload = "";

        return $js;

    }

    /**
     * 
     * @param String $mensagem Mensagem a ser adicionada
     * @param String $tipo Tipo da mensagem
     */
    public function addMensagem($mensagem, $tipo)
    {
        $msg = str_replace("'", "\'", $mensagem);
        
        $compl = "";
        
        if( $tipo === InnerPage::TIPO_MENSAGEM_SUCESSO )
        {
            $compl = "mensagem.innerHTML = '';";
            
        }
        
        $js = "
            var mask = document.getElementById('mask');

            mask.style.display = 'block';

            setTimeout(function() {
                mask.classList.remove('invisible');

            }, 10);

            var mensagem = document.getElementById('mensagem');
            {$compl}
            
            var p = document.createElement('p');

            p.innerHTML = '{$msg}';
            mensagem.className = '{$tipo}';

            mensagem.appendChild(p);

        ";

        if( $this->isAjax )
        {
            return $this->addJSAJAX($js);

        }

        $this->addToLoad($js);

    }

}

?>