<script src="<?php echo Inner::instance()->getScriptURL("telaCadastro"); ?>"></script>

<h1 class="title center">Cadastro</h1>

<form method="POST" action="<?php echo Inner::instance()->getModelURL("cadastro"); ?>">
    <fieldset class="center middle common-form">
        <legend class="common-form">Tipo do cadastro</legend>
        
        <input id="rdEntrada" class="radio" type="radio" name="tipoCadastro" value="entrada" checked="" /><label for="rdEntrada"  class="radio" >Entrada</label>
        <input id="rdSaida" class="radio" type="radio" name="tipoCadastro" value="saída" /><label for="rdSaida"  class="radio" >Saída</label>
        <br/>
        
    </fieldset>
    
    <fieldset class="center middle common-form" id="fsMatricula">
        <legend class="common-form">
            <input id="rdMatricula" class="radio" type="radio" name="modoCadastro" value="matricula" checked=""/>
            <label for="rdMatricula" class="radio" >Por matrícula</label>
            <br/>
                        
        </legend>
        
        
        <div>
            <input id="inNumMatricula" class="input" placeholder="Número da matrícula" pattern="[0-9]*" maxlength="12" />
            <p id="erro_inNumMatricula" class="erroInput"></p>
                    
        </div>
        
    </fieldset>
    
    <fieldset class="center middle common-form" id="fsNome">
        <legend class="common-form">
            <input id="rdNome" class="radio" type="radio" name="modoCadastro" value="nome" />
            <label for="rdNome" class="radio" >Por nome</label>
            <br/>
        </legend>
    
        <div>
            <input id="inNome" list="listaNome" class="input" placeholder="Nome do aluno" pattern="[^0-9]*"/>
            <datalist id="listaNome">
            </datalist> 
            <p id="erro_inNome" class="erroInput"></p>
        </div>
        
    </fieldset>
    
</form>