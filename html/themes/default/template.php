<?php
    /**
     * Template do tema default
     * 
     */

    $Inner = Inner::instance();
    
    // Verifica se há algum usuário logado nesta sessão
    $loggedUserInfo = $loggedUser = $Inner->login->isLogged() ? "Bem-vindo, {$Inner->login->isLogged()}. <a href='" . $Inner->getURL("login", "main") . "&action=logout" . "'>Sair</a>" : "Você não está logado";
        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo Inner::getPref("nome"); ?></title>
        <link rel="icon" type="image/ico" href="<?php echo $Inner->getThemeURL(); ?>images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $Inner->getThemeURL(); ?>css/loading.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $Inner->getThemeURL(); ?>css/main.css" />
        <?php if( $Inner->login->isLogged() ) { ?>
            <script src="<?php echo $Inner->getScriptURL("innerMenu"); ?>"></script>
            
        <?php } ?>
        <script src="<?php echo $Inner->getScriptURL("innerPage"); ?>"></script>
        <script src="<?php echo $Inner->getScriptURL("innerUtils"); ?>"></script>
        <script src="<?php echo $Inner->getScriptURL("innerAjax"); ?>"></script>
                
    </head>

    <body>
        <header>
            <?php if( $Inner->login->isLogged() ) { ?>
                <div class="row-left">
                    <div id="btnMenu" title="Pressione para abrir/fechar o menu">
                        
                    </div>

                </div>
            
            <?php } ?>

            <div class="row-right">
                <span id="login-info"><?php echo $loggedUserInfo; ?></span>

            </div>
            
            <div class="row-center">
                <img class="logo" src="<?php echo $Inner->getThemeURL(); ?>images/logoIF.png" />

            </div>
            
        </header>
        
        <section>
            <div id="mask" class="invisible">
                <div id="mensagem"></div>
                <div id="carregando">
                    <div id="circularG">
                        <div id="circularG_1" class="circularG">
                        </div>
                        <div id="circularG_2" class="circularG">
                        </div>
                        <div id="circularG_3" class="circularG">
                        </div>
                        <div id="circularG_4" class="circularG">
                        </div>
                        <div id="circularG_5" class="circularG">
                        </div>
                        <div id="circularG_6" class="circularG">
                        </div>
                        <div id="circularG_7" class="circularG">
                        </div>
                        <div id="circularG_8" class="circularG">
                        </div>
                    </div>
                    <p class="carregandoTexto">Carregando...</p>
                    
                </div>
            </div>
            <?php echo $Inner->page->content; ?>
            <div id="limbo"></div>
        </section>
        
        <?php if( $Inner->login->isLogged() ) { ?>
            <aside id="menu" class="menu-closed">
                <nav>
                    <ul>
                        <a href="<?php echo $Inner->getURL("cadastro"); ?>"><li>Cadastrar entrada/saída</li></a>
                        <a href="<?php echo $Inner->getURL("relatorio"); ?>"><li>Relatórios</li></a>
                        <?php if( $Inner->login->getUserInfo("perfil") === "adm" ) { ?>
                            <a href="<?php echo $Inner->getURL("config"); ?>"><li>Configurações</li></a>

                        <?php } ?>
                        <a href="<?php echo $Inner->getURL(); ?>"><li>Sair</li></a>    
                            
                    </ul>

                </nav>

            </aside>
        <?php } ?>
        
        <footer>
            

        </footer>
        
    </body>

</html>