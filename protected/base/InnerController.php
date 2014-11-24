<?php

    /**
     * Classe base dos controladores
     *
     * @author Luís Augusto Weber Mercado
     */
    class InnerController {
        
        public function __call($name, $arguments)
        {
            $str = "acao" . strtoupper($name[0]) . substr($name, 1);
            
            $this->$str($arguments);
            
        }

    }

?>