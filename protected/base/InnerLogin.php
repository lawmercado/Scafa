<?php

/**
 * Classe relacionada diretamente com o login, utilizada na classe Inner
 * 
 */
class InnerLogin {

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
     * Loga o usuário no sistema
     * 
     * @param Array $info Informação do usuário validado
     */
    public function login($info)
    {
        if( $info )
        {
            $_SESSION["InnerLogin"] = $info;
                        
            return true;

        }

        return false;

    }

    /**
     * Desloga o usuário do sistema
     * 
     */
    public function logout()
    {
        unset($_SESSION["InnerLogin"]);

        $url = Inner::instance()->getURL("login");

        Inner::instance()->goToURL($url);

    }

    /**
     * Retorna status de login
     * 
     */
    public function isLogged()
    {
        if( isset($_SESSION["InnerLogin"]) )
        {
            return $_SESSION["InnerLogin"]["nome"];

        }

        return false;

    }
    
    /**
     * Retorna as informações salvas
     * 
     */
    public function getUserInfo($propriedade = null)
    {
        if( $this->isLogged() )
        {
            if( $propriedade )
            {
                return $_SESSION["InnerLogin"][$propriedade];
                
            }
            
            return $_SESSION["InnerLogin"];
            
        }
        
    }

}

?>