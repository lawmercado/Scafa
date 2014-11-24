<form method="POST" name="frmLogin" action="<?php echo Inner::instance()->getURL("login"); ?>">
    
    <div class="left middle">
        <fieldset>
            <legend>Login</legend>
            <input class="form-input" type="text" name="usuario" placeholder="Usuário" required pattern="[A-Za-z\_]*" />
            <br/>
            <input  class="form-input" type="password" name="senha" placeholder="Senha" required />
            <br/>
            <button class="form-submit" type="submit">Entrar</button>
            
        </fieldset>
        
        <img id="initialLogo" src="<?php echo Inner::instance()->getThemeURL(); ?>images/logoScafa.png" />
        
    </div>
    
</form>