<div class="panel panel-default">
    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold">
        Buscar em Atendimentos
    </div>

    <div class="panel-body">

        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdicionar" id="btnNovo"><span class="glyphicon glyphicon-plus"></span> Novo</button>
            </div>
        </div>
        <br/>

        <form method="post" action="">
            <div class="form-group">
                <div class="row">

                    <div class="col-sm-4">
                        <label for="buscaTecnico">Técnico</label>
                        <select id="buscaTecnico" name="buscaTecnico" class="form-control">
                            <option value="">Selecione...</select>                            
                        </select>
                    </div>
                    <div class="col-sm-4"> 
                        <label for="buscaIdNit">Id NIT</label>
                        <input type="text" id="buscaIdNit" name="buscaIdNit" class="form-control" placeholder="Id NIT" />
                    </div>
                    <div class="col-sm-4"> 
                        <label for="buscaSituacao">Situação</label>
                        <select id="buscaSituacao" name="buscaSituacao" class="form-control">
                            <option value="">Selecione...</select>
                        </select>
                    </div>

                </div>
            </div>
        </form>

    </div>   

    <div class="panel-footer" style="text-align: center;">
        <button type="button" class="btn btn-success" id="btnProcurar">Procurar</button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold"> 
        RESULTADOS DE BUSCA
    </div>
    <div class="panel-body"> 
        <table id="tblAtendimentos" class="table table-bordered">
            <thead>
                <tr>
                    <th>Escola</th>
                    <th>Local</th>
                    <th>Técnico</th>
                    <th>Situação</th>                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
