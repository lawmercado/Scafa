<?php

/**
 * Classe Inner
 * 
 * Contém todos os métodos úteis para a aplicação
 * 
 * @since Classe criada em 14/09/2014
 * 
 * @author Luís Augusto Weber Mercado
 */
class Inner {

    /**
     * Instância da classe
     * 
     * @var Object
     */
    private static $instance;

    /**
     * Controlador da classe
     * 
     * @var Object 
     */
    private $controller;

    /**
     * Instância do banco
     * 
     * @var Object 
     */
    private $db;
    
    /**
     * Classe InnerPage
     * 
     * @var Object 
     */
    private $page;

    /**
     * Classe InnerLogin
     * 
     * @var Object
     */
    private $login;

    /**
     * Se o servidor de socket está rodando ou não
     * 
     * @var Boolean
     */
    public $isServerRunning = false;
    
    /**
     * Construtor da classe.
     * A instância da classe é retornada pelo método instance()
     * 
     */
    private function __construct()
    {
        $this->page = new InnerPage();
        $this->login = new InnerLogin();
        $this->db = InnerDatabase::getConexao();

    }

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

    /**
     * Retorna a instância da classe
     * 
     * @return Object Instância da classe Inner
     */
    public static function instance()
    {
        // Se não foi criada uma instância ainda, retorna uma nova.
        if( is_null(self::$instance) )
        {
            self::$instance = new self();

        }

        return self::$instance;

    }

    /**
     * Seta o controlador
     * 
     */
    public function setController($nome)
    {
        $nome[0] = strtoupper($nome[0]);

        $nomeClasse = $nome . "Controller";
        
        $this->controller = new $nomeClasse();

    }

    /**
     * Busca o valor da preferência informada
     * 
     * @param String $nome Nome da preferência
     * @return String Valor da preferência
     */
    public static function getPref($nome)
    {
        $config = require(__DIR__ . "/../prefs/main.php");

        return $config[$nome];

    }

    /**
     * Redireciona para outra página
     * 
     * @param String $url Para onde ir
     */
    public function goToURL($url)
    {
        header("Location: {$url}");

    }

    /**
     * Retorna a url para acesso das ações
     * 
     * @param String $call Nome da view
     * @param String $from Controlador a qual chamar
     * @return String Url da ação
     */
    public function getURL( $call = NULL, $from = "main" )
    {
        $url = "http://{$_SERVER["HTTP_HOST"]}";

        if( !is_null($call) )
        {
            $url .= "?call={$call}&from={$from}";

        }

        return $url;

    }

    /**
     * Retorna a url do modelo
     * 
     * @param String $model Nome do modelo
     * @return String Caminho do modelo
     */
    public function getModelURL( $model )
    {
        return $this->getURL($model . "&from=models");

    }

    /**
     * Retorna a url do tema escolhido
     * 
     * @return String Url do tema
     */
    public function getThemeURL()
    {
        $nome = Inner::getPref("tema");
        
        return $this->getURL() . "/themes/{$nome}/";

    }

    /**
     * Retorna a url do tema escolhido
     * 
     * @return String Url do tema
     */
    public function getScriptURL($name)
    {
        return $this->getURL() . "/scripts/{$name}.js";

    }

    /**
     * Pega a URL para determinada ação
     * 
     * @param String $action Nome da ação
     * @return String
     */
    public function getActionURL($action)
    {
        return $this->getURL($action . "&from=actions");

    }

}

?>