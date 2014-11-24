<?php
    /**
     * Arquivo com todos os includes necessários da aplicação
     * 
     */

    include(__DIR__ . "/base/Inner.php");
    include(__DIR__ . "/base/InnerPage.php");
    include(__DIR__ . "/base/InnerLogging.php");
    include(__DIR__ . "/base/InnerController.php");
    include(__DIR__ . "/base/InnerDatabase.php");
    include(__DIR__ . "/base/InnerLogin.php");
    
    include(__DIR__ . "/base/templates/InnerModel.php");
    
    include(__DIR__ . "/models/LoginModel.php");
    include(__DIR__ . "/models/CadastroModel.php");
    include(__DIR__ . "/models/RelatorioModel.php");
    
    include(__DIR__ . "/classes/UserValidate.php");
    include(__DIR__ . "/controllers/MainController.php");

?>