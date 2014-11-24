<?php

/**
 * Classe que contém as funções de banco
 *
 * @author Luís Augusto Weber Mercado
 */
class InnerDatabase
{
    static $instance;
    
    private $conexao;
    
    private function __construct()
    {
        $conf = Inner::getPref("db");
    
        $this->conexao = mysql_connect("{$conf["servidor"]}:{$conf["porta"]}", $conf["usuario"], $conf["senha"]);
        
        mysql_select_db($conf["nome"], $this->conexao);
        
    }
    
    /**
     * Retorna a instância da classe
     * 
     * @return Object Instância da classe Inner
     */
    public static function getConexao()
    {
        // Se não foi criada uma instância ainda, retorna uma nova.
        if( is_null(self::$instance) )
        {
            self::$instance = new self();

        }

        return self::$instance;
        
    }
    
    public function query($sql)
    {
        $query = mysql_query($sql, $this->conexao);
        
        $retorno = array();
        
        if( $query !== false )
        {
            while( $row = mysql_fetch_assoc($query) )
            {
                $retorno[] = $row;
                
            }
            
            return $retorno;
            
        }
        else
        {
            echo mysql_error();
            
            Inner::instance()->page->addMensagem("Erro na consulta: " . mysql_error(), InnerPage::TIPO_MENSAGEM_ERRO);
            
        }
                
    }
    
    public function execute($sql)
    {
        $result = mysql_query($sql, $this->conexao);
        
        return $result !== false;
        
    }
    
    public static function prepare($args)
    {
        InnerDatabase::getConexao();
        
        for( $i = 0; $i < count($args); $i++ )
        {
            $args[$i] = mysql_real_escape_string($args[$i]);
            $args[$i] = utf8_decode($args[$i]);
            
        }
        
        return $args;
        
    }
    
    public function close()
    {
        mysql_close($this->conexao);
        
        $this->conexao = null;
        
    }
    
}
