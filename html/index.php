<?php

/**
 * index.php - Handler inicial das páginas
 * 
 */

require("../protected/includes.php");
session_start();

$from = isset($_GET["from"]) ? $_GET["from"] : "main";
$call = isset($_GET["call"]) ? $_GET["call"] : "index";
$isAjax = isset($_GET["action"]); 

$Inner = Inner::instance($from);

if( !$Inner->login->isLogged() && $call !== "login" )
{
    $call = "login";

    $Inner->goToURL($Inner->getURL($call));

    exit();

}

$Inner->page->setAJAX($isAjax);

$Inner->setController($from);

// Chama a ação
$Inner->controller->$call();
    
?>