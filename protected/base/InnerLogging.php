<?php
/**
 * Description of InnerLogging
 *
 * @author luisaugusto
 */
class InnerLogging
{
    const DEFAULT_LOGGING_PATH = "runtime.log";
    const TAG_ERRO = "ERRO: ";
    const TAG_INFO = "INFO: ";
    
    public static function log($tag, $mensagem)
    {
        $mensagem = is_array($mensagem) ? var_dump($mensagem) : $mensagem;
        
        var_dump($mensagem);
        
        $arquivo = fopen(InnerLogging::DEFAULT_LOGGING_PATH, "a");
        fwrite($arquivo, "{$tag} {$mensagem}\n");
        fclose($arquivo);
        
    }
    
}
