<?php

/**
 * Modelo de cadastro
 * 
 * Responsável por validar e fazer o login do usuário no sistema
 * 
 */
class CadastroModel extends InnerModel
{
    protected $matricula;
    protected $nome;
    protected $tipo;

    public function validaDados()
    {
        return (is_string($this->senha) && is_string($this->usuario));
                
    }
    
    public static function procuraNome()
    {
        $Inner = Inner::instance();
        
        $nome = $_POST["nome"];
        $tipo = $_POST["tipo"];
        
        $nome = strtolower($nome);
        
        $sql = "SELECT nomealuno FROM Alunos WHERE LOWER(nomealuno) LIKE '{$nome}%' ORDER BY nomealuno LIMIT 25";
        
        $query = $Inner->db->query($sql);

        for( $i = 0; $i < count($query); $i++ )
        {
            $query[$i]["nomealuno"] = utf8_encode($query[$i]["nomealuno"]);
            
        }
                
        if( count($query) > 0 )
        {
            $dados = json_encode($query);
            
            $js = "
                var lista = document.getElementById('listaNome');

                var resultado = {$dados};
                
                InnerUtils.removeElementosFilhos(lista);

                for( var i = 0; i < resultado.length; i++ )
                {
                    var opcao = document.createElement('option');
                    
                    opcao.value = resultado[i].nomealuno;
                                        
                    lista.appendChild(opcao);

                }
                                
            ";

            $Inner->page->addJSAjax($js);
            
        }
                
    }
    
    public static function confirma()
    {
        $matricula = isset($_POST["matricula"]) ? $_POST["matricula"] : $_POST["nome"];
        $tipo = $_POST["tipo"];
        
        $Inner = Inner::instance();
        
        $args = array($matricula);
        $argumentos = InnerDatabase::prepare($args);
        
        $sql = "SELECT nomealuno, foto FROM Alunos WHERE numeromatricula='{$argumentos[0]}' OR nomealuno='{$argumentos[0]}'";
        
        $db = InnerDatabase::getConexao();
        $retorno = $db->query($sql);
        
        if( count($retorno) > 0 )
        {
            $nome = utf8_encode($retorno[0]["nomealuno"]);
            
            $Inner->page->addMensagem("Cadastrar {$tipo} para o aluno {$nome}?", InnerPage::TIPO_MENSAGEM_INFO);
            
            $js = "
                var container = document.getElementById('mensagem');
                var p = document.getElementById('mensagem').firstChild;

                var div = document.createElement('div');
                div.style.width = '90px';
                div.style.height = '120px';
                div.style.overflow = 'hidden';
                div.style.margin = '0 auto';

                var height = div.scrollWidth - 120;

                var img = document.createElement('img');
                img.src = location.origin + '/fotos/{$retorno[0]["foto"]}';
                img.style.height = '120px';
                img.align = 'center';
                img.style.marginLeft = (height/3) + 'px';

                var botao = document.createElement('button');

                botao.type = 'button';
                botao.innerHTML = 'Confirmar';
                botao.addEventListener('click', function(evento)
                {
                    evento.stopPropagation();

                    var url = location.origin + '/?call=cadastro&from=main&action=cadastra';
                    InnerAjax.doPOST(url, null, { matricula: '{$matricula}', tipo: '{$tipo}' });

                });

                div.appendChild(img);
                
                container.insertBefore(div, p);
                container.insertBefore(botao, p.nextSibling);
                
                document.getElementById('inNome').value = '';
                document.getElementById('inNumMatricula').value = '';

            ";
                
            $Inner->page->addJSAjax($js);
            
        }
        else
        {
            $Inner->page->addMensagem("Não há nenhum aluno com o número de matrícula informada", InnerPage::TIPO_MENSAGEM_ERRO);
            
        }
                
    }
    
    public static function cadastra()
    {
        $Inner = Inner::instance();
        
        $dado =  isset($_POST["matricula"]) ? $_POST["matricula"] : $_POST["nome"];
        $tipo = $_POST["tipo"];
        
        $args = array($dado);
                
        $argumentos = InnerDatabase::prepare($args);
        
        $sql = "SELECT id_aluno FROM Alunos WHERE numeromatricula='{$argumentos[0]}' OR nomealuno ='{$argumentos[0]}'";
                
        $query = $Inner->db->query($sql);
        
        $modo = $tipo === "entrada" ? "Entradas" : "Saidas";
        
        $userInfo = $Inner->login->getUserInfo("id_usuario");
                
        $sqlInsert = "INSERT INTO {$modo} (id_aluno, id_usuario) VALUES ({$query[0]["id_aluno"]}, {$userInfo})";
        
        if( $Inner->db->execute($sqlInsert) )
        {
            $modo = substr($modo, 0, (strlen($modo) - 1));
            
            $Inner->page->addMensagem("{$modo} cadastrada com sucesso", InnerPage::TIPO_MENSAGEM_SUCESSO);
        
            $js = "
                document.getElementById('inNome').value = '';

            ";
            
            $Inner->page->addJSAjax($js);
            
        }
        else
        {
            $Inner->page->addMensagem("Não foi possível realizar o cadastro", InnerPage::TIPO_MENSAGEM_ERRO);
            
        }
                
    }
    
}
    
?>