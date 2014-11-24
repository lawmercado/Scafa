<?php
    
class UserValidate
{
    
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

    }

    public function autenticar()
    {
        $Inner = Inner::instance();
        
        $args = array(
            $this->username,
            $this->password
            
        );
        
        $argumentos = InnerDatabase::prepare($args);
        
        $sql = "SELECT id_usuario, nome, nomeusuario, perfil FROM Usuarios WHERE nomeusuario='{$argumentos[0]}' AND senha='{$argumentos[1]}'";
        
        $retorno = $Inner->db->query($sql, true);
                  
        if( count($retorno) > 0 )
        {
            $retorno[0]["nome"] = utf8_encode($retorno[0]["nome"]);
            
            return $retorno[0];
            
        }
        else
        {
            Inner::instance()->page->addMensagem("Usuário não encontrado, tente novamente!", InnerPage::TIPO_MENSAGEM_ERRO);
        
            return false;
            
        }
        
    }


}

?>