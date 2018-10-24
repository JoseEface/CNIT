<div class="panel panel-default">
    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold">
        Minha Conta
    </div>
                    
    <div class="panel-body">
        <form id="formAlterar" action="">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <label for="nomeConta">Nome</label>
                    <input type="text" name="nomeConta" id="nomeConta" class="form-control" />
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div> 
                <div class="col-sm-6 offset-md-3">
                    <span class="help-block" class="color: red" id="vnomeConta"></span>
                </div>
                <div class="col-sm-3">
                </div>
            </div>            
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <label for="loginConta">Login</label>
                    <input type="text" name="loginConta" id="loginConta" class="form-control" style="max-width: 200px;" />
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div> 
                <div class="col-sm-6 offset-md-3">
                    <span class="help-block" class="color: red" id="vloginConta"></span>
                </div>
                <div class="col-sm-3">
                </div>
            </div>            
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <label for="senhaConta">Senha (atual)</label>
                    <input type="password" name="senhaConta" id="senhaConta" class="form-control" style="max-width: 200px;" />
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div> 
                <div class="col-sm-6 offset-md-3">
                    <span class="help-block" class="color: red" id="vsenhaConta"></span>
                </div>
                <div class="col-sm-3">
                </div>
            </div>            
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <label for="senhaAlterarConta">Senha (alterar)</label>
                    <input type="password" name="senhaAlterarConta" id="senhaAlterarConta" class="form-control" style="max-width: 200px;" />
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div> 
                <div class="col-sm-6 offset-md-3">
                    <span class="help-block" class="color: red" id="vsenhaAlterarConta"></span>
                </div>
                <div class="col-sm-3">
                </div>
            </div>           

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <label for="senhaConfirmaConta">Senha (confirma)</label>
                    <input type="password" name="senhaConfirmaConta" id="senhaConfirmaConta" class="form-control" style="max-width: 200px;" />
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div> 
                <div class="col-sm-6 offset-md-3">
                    <span class="help-block" class="color: red" id="vsenhaConfirmaConta"></span>
                </div>
                <div class="col-sm-3">
                </div>
            </div>           
        </div>
        
    </div>    

    <div class="panel-footer" style="text-align: center;">
        <button type="button" class="btn btn-success" id="btnAlterar">Alterar</button>
    </div>
    </form>
</div>
