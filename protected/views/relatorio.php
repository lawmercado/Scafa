<script src="<?php echo Inner::instance()->getScriptURL("telaRelatorio"); ?>"></script>

<h1 class="title center">Relatórios</h1>

<form method="POST" action="<?php echo Inner::instance()->getModelURL("relatorio"); ?>">
    <fieldset class="center middle common-form-less">
        <legend class="common-form">Filtros</legend>

        <input id="rdEntrada" class="radio" type="radio" name="tipoCadastro" value="Entradas" checked="" /><label for="rdEntrada"  class="radio" >Entradas</label>
        <input id="rdSaida" class="radio" type="radio" name="tipoCadastro" value="Saidas" /><label for="rdSaida"  class="radio" >Saídas</label>

        <p class="input-container">
            <input id="inCampoFiltro" class="input" />
            <button id="btBuscar" class="input-search" type="button" >Buscar</button>
        </p>
        
    </fieldset>
    
</form>

<div id="resultContainer">
    
    
</div>