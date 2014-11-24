<?php

/**
 * Modelo de relatórios
 * 
 * Responsável por validar e fazer o login do usuário no sistema
 * 
 */
class RelatorioModel extends InnerModel
{
    public function validaDados()
    {
        return true;
                
    }
    
    public static function lista()
    {
        $Inner = Inner::instance();
        
        $tipo = $_POST["tipo"];
        $filtro = $_POST["filtro"];
        
        $where = "";
        
        if( $filtro !== "" )
        {
            $where = "WHERE
                        a.id_aluno = '{$filtro}'
                        OR LOWER(a.nomealuno) LIKE '%{$filtro}%'
                        OR a.numeromatricula = '{$filtro}'
                        OR DATE_FORMAT(o.tempo, '%d/%m/%Y - %H:%i') LIKE '{$filtro}%'";
            
        }
        
        $sql = "SELECT
                    a.id_aluno as id,
                    a.nomealuno as nome,
                    a.numeromatricula as matricula,
                    DATE_FORMAT(o.tempo, '%d/%m/%Y - %H:%i') as tempo
                FROM {$tipo} o
                INNER JOIN Alunos a
                    ON(a.id_aluno = o.id_aluno)
                {$where}
                ORDER BY a.id_aluno";
        
        $query = $Inner->db->query($sql);
       
        $result = "<table class='tabela'>"
                . "<thead>"
                . "<th>Id</th>"
                . "<th>Nome</th>"
                . "<th>Matrícula</th>"
                . "<th>Tempo</th>"
                . "</thead>"
                . "<tbody>";
        
        for( $i = 0; $i < count($query); $i++ )
        {
            $query[$i]["nome"] = utf8_encode($query[$i]["nome"]);
            
            $compl = $i % 2 === 0 ? "class='high'" : "";
            
            $result .= "<tr {$compl}>"
                    . "<td>{$query[$i]["id"]}</td>"
                    . "<td>{$query[$i]["nome"]}</td>"
                    . "<td>{$query[$i]["matricula"]}</td>"
                    . "<td>{$query[$i]["tempo"]}</td>"
                    . "</tr>";
            
        }
             
        $result .= "</tbody></table>";
        
        echo $result;
        
    }
    
}
    
?>