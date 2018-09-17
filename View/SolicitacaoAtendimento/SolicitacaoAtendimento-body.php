<div class="modal fade" id="modalBuscarDono">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">

                <div class="modal-header bg-primary">                
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <b class="modal-title" style="text-transform: uppercase">Buscar Dono</b>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label for="donoProcurado">Dono</label>
                            <input type="text" name="donoProcurado" id="donoProcurado" class="form-control" />
                        </div>
                        <button type="button" class="btn btn-default" id="btnProcurarDono">Procurar</button> <br/><br/>
                        <div class="form-group">
                            <select id="donoSelecionado" class="form-control" name="donoSelecionado" size="5">

                            </select>
                        </div>
                    </form>

                </div>            
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-success" id="btnSelecionarDono">Selecionar</button>
                </div>

            </div>
        </form>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold">
        Busca Solicitação de Atendimento
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdicionar" id="btnNovo"><span class="glyphicon glyphicon-plus"></span> Novo</button>
            </div>
        </div>
        <br/>
        <form method="post" action="">
            <input type="hidden" name="idSolicitacao" value="0" id="idSolicitacao"/>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="dataSolicitacao" class="control-label">Data:</label>                                    
                        <input class="form-control col-sm-3 datepicker" type="text" name="dataSolicitacao" id="dataSolicitacao" readonly="readonly"/>
                    </div>
                    <div class="col-sm-5">
                        <label for="donoAlternativo">Outro dono: </label>
                        <input type="text" class="form-control" type="text" id="donoBuscaSolicitacao" onclick="donoSolicitado(null)" readonly="readonly"/>
                    </div>
                    <div class="col-sm-4">
                        <label for="idnit">Id NIT</label>
                        <input type="text" id="idnit" name="idnit" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="escola">Escola </label>
                        <select id="escola" name="escola" class="form-control">
                            <option value="">Selecione...</option>
                        </select>                
                    </div>
                    <div class="col-sm-6">
                        <label for="nomeEntregador">Entregador </label>
                        <input type="text" class="form-control" value="" />
                    </div>
                </div>
            </div>
        </form>
    </div>   

    <div class="panel-footer" style="text-align: center;">
        <button type="button" class="btn btn-success">Procurar</button>
    </div>
</div>

<br/>

<div class="panel panel-default">
    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold">
        Resultados de busca
    </div>
    <div class="panel-body">
        <!--
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdicionar" id="btnNovo"><span class="glyphicon glyphicon-plus"></span> Novo</button>
            </div>
        </div>
        -->
        <br/>
        <table id="tblSolicitacoes" class="table table-bordered">
            <thead> 
                <tr>
                    <th>Data</th>
                    <th>Escola</th>
                    <th>Dono</th>                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalAdicionar">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <b class="modal-title" style="text-transform: uppercase">Adicionar Situação</b>

                </div>
                <div class="modal-body">

                    <input type="hidden" name="addidSolicitacao" value="0" id="addidSolicitacao"/>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="adddataSolicitacao" class="control-label">Data</label>                                    
                                <input class="form-control col-sm-3 datepicker readonly" type="text" name="adddataSolicitacao" id="adddataSolicitacao" readonly="readonly"/>
                            </div>
                            <div class="col-sm-5">
                                <label for="adddonoAlternativo">Outro dono </label>
                                <input type="text" id="adddonoAlternativo" name="adddonoAlternativo" class="form-control" type="text" onclick="donoSolicitado('modalAdicionar')" readonly="readonly"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="addidnit">Id NIT</label>
                                <input type="text" id="addidnit" name="addidnit" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="addescola">Escola </label>
                                <select id="addescola" name="addescola" class="form-control">
                                    <option value="">Selecione...</option>
                                </select>                
                            </div>
                            <div class="col-sm-6">
                                <label for="addnomeEntregador">Entregador </label>
                                <input type="text" id="addnomeEntregador" name="addnomeEntregador" class="form-control" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adddescricaoProblema">Problema</label>
                        <textarea id="adddescricaoProblema" name="adddescricaoProblema" class="form-control" style="resize: vertical"> </textarea>
                    </div>
                </div>            
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-success">Salvar</button>
                </div>

            </div>
        </form>
    </div>
<div>

<div class="modal fade" id="modalEdicao">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <b class="modal-title" style="text-transform: uppercase">Editar Solicitação</b>

                </div>
                <div class="modal-body">

                    <input type="hidden" name="edidSolicitacao" value="0" id="edidSolicitacao"/>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="eddataSolicitacao" class="control-label">Data</label>                                    
                                <input class="form-control col-sm-3 datepicker readonly" type="text" name="eddataSolicitacao" id="eddataSolicitacao" readonly="readonly"/>
                            </div>
                            <div class="col-sm-5">
                                <label for="eddonoAlternativo">Outro dono </label>
                                <input type="text" id="eddonoAlternativo" name="eddonoAlternativo" class="form-control" type="text" onclick="donoSolicitado('modalEdicao')" readonly="readonly"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="edidnit">Id NIT</label>
                                <input type="text" id="edidnit" name="edidnit" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="edescola">Escola </label>
                                <select id="edescola" name="edescola" class="form-control">
                                    <option value="">Selecione...</option>
                                </select>                
                            </div>
                            <div class="col-sm-6">
                                <label for="ednomeEntregador">Entregador </label>
                                <input type="text" id="ednomeEntregador" name="ednomeEntregador" class="form-control" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="eddescricaoProblema">Problema</label>
                        <textarea id="eddescricaoProblema" name="eddescricaoProblema" class="form-control" style="resize: vertical"> </textarea>
                    </div>
                </div>            
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-success">Salvar</button>
                </div>

            </div>
        </form>
    </div>
</div>

