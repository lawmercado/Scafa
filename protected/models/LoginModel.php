<?php

/**
 * Modelo de login
 * 
 * Responsável por validar e fazer o login do usuário no sistema
 * 
 */
class LoginModel extends InnerModel
{
    protected $usuario;
    protected $senha;

    public function validaDados()
    {
        return (is_string($this->senha) && is_string($this->usuario));
                
    }
    
    public function login()
    {
        $validate = new UserValidate($this->usuario, md5($this->senha));

        $valid = $validate->autenticar();
        
        if( $valid )
        {
            if( !$this->Inner->login->login($valid) )
            {
                $this->Inner->page->addMensagem("Erro no login. {$this->usuario} e {$this->senha} Verifique os dados informados.", InnerPage::TIPO_MENSAGEM_ERRO);

                return false;

            }

            return true;

        }

    }
    
    public static function logout()
    {
        Inner::instance()->login->logout();
        
    }
    
}
    
?>