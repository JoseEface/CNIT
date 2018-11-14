<div class="panel panel-default">
    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold">
        Busca Solicitação de Atendimento
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-sm" id="btnNovo"><span class="glyphicon glyphicon-plus"></span> Novo</button>
                <button type="button" class="btn btn-warning btn-sm" id="btnListarLivres"> Listar Livres</button>
            </div>
        </div>
        <br/>
        <form method="post" id="formBuscar" action="">            
            <input type="hidden" name="idSolicitacao" value="0" id="idSolicitacao"/>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="dataSolicitacao" class="control-label">Data:</label>                                    
                        <input class="nominimoum form-control col-sm-3 datepicker" type="text" name="dataSolicitacao" id="dataSolicitacao" readonly="readonly"/>
                    </div>
                    <div class="col-sm-5">
                        <!--
                        <label for="donoAlternativo">Outro dono: </label>
                        <input type="text" class="form-control" type="text" id="donoBuscaSolicitacao" onclick="donoSolicitado(null)" readonly="readonly"/>
                        -->
                        <label for="escola">Escola </label>
                        <select id="escola" name="escola" class="nominimoum form-control">
                            <option value="">Selecione...</option>
                        </select>                
                    </div>
                    <div class="col-sm-4">
                        <label for="idnit">Id NIT</label>
                        <input type="text" id="idnit" name="idnit" class="nominimoum form-control" />
                    </div>
                </div>
                <div class="row">                
                    <div class="col-sm-3">
                        <span class="help-block" id="vdataSolicitacao"></span>
                    </div>
                    <div class="col-sm-5">
                        <span class="help-block" id="vescola"></span>
                    </div>
                    <div class="col-sm-4">
                        <span class="help-block" id="vidnit"></span>
                    </div>
                </div>
            </div>
            <!--
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
            -->
        </form>
    </div>   

    <div class="panel-footer" style="text-align: center;">
        <button type="button" id="btnProcurar" class="btn btn-success">Procurar</button>
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
                    <th>Operação</th>            
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalAdicionar">
    <div class="modal-dialog">
        <form method="post" id="formAdicionar" action="">
            <button type="reset" id="btnResetarFormAdicionar" style="display: none">Resetar</button>
            <div class="modal-content">
                <div class="modal-header bg-primary">
                
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <b class="modal-title" style="text-transform: uppercase">Adicionar Solicitação</b>

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
                                <input type="text" id="adddonoAlternativo" name="adddonoAlternativo" class="aomenosum form-control" type="text" onclick="SolicitacaoAtendimentoView.DonoSolicitado('modalAdicionar')" readonly="readonly"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="addidnit">Id NIT</label>
                                <input type="text" id="addidnit" name="addidnit" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">                                
                                <span class="help-block" id="vadddataSolicitacao"></span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block" id="vadddonoAlternativo"></span>
                            </div>
                            <div class="col-sm-4">
                                <span class="help-block" id="vaddidnit"></span>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="addescola">Escola </label>
                                <select id="addescola" name="addescola" class="aomenosum form-control">
                                    <option value="">Selecione...</option>
                                </select>                
                            </div>
                            <div class="col-sm-6">
                                <label for="addnomeEntregador">Entregador </label>
                                <input type="text" id="addnomeEntregador" name="addnomeEntregador" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="help-block" id="vaddescola"></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="help-block" id="vaddnomeEntregador"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="adddescricaoProblema">Problema</label>
                                <textarea id="adddescricaoProblema" name="adddescricaoProblema" class="form-control" style="resize: vertical"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <span class="help-block" id="vadddescricaoProblema"></span>
                            </div>
                        </div>
                    </div>
                </div>            
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" id="btnSalvarSolicitacao" class="btn btn-success">Salvar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEdicao">
    <div class="modal-dialog">
        <form method="post" id="formEditar" action="">
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
                                <input type="text" id="eddonoAlternativo" name="eddonoAlternativo" class="edgrupo form-control" type="text" onclick="SolicitacaoAtendimentoView.DonoSolicitado('modalEdicao')" readonly="readonly"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="edidnit">Id NIT</label>
                                <input type="text" id="edidnit" name="edidnit" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <span class="help-block" id="veddataSolicitacao">Campo obrigatório</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block" id="veddonoAlternativo">Campo obrigatório</span>
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block" id="vedidnit">Campo obrigatório</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="edescola">Escola </label>
                                <select id="edescola" name="edescola" class="edgrupo form-control">
                                    <option value="">Selecione...</option>
                                </select>                
                            </div>
                            <div class="col-sm-6">
                                <label for="ednomeEntregador">Entregador </label>
                                <input type="text" id="ednomeEntregador" name="ednomeEntregador" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="row">
                            <div  class="col-sm-6">
                                <span class="help-block" id="vedescola">Validação</span>
                            </div>
                            <div class="col-sm-6">
                                <span class="help-block" id="vednomeEntregador">Validação</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="eddescricaoProblema">Problema</label>
                                <textarea id="eddescricaoProblema" name="eddescricaoProblema" class="form-control" style="resize: vertical"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <span class="help-block" id="veddescricaoProblema"></span>
                            </div>
                        </div>
                    </div>
                </div>            
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-success" id="btnEditarSalvar">Salvar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalBuscarDono">
    <div class="modal-dialog">
        <form method="post" id="formBuscarDono" action="">
            <input type="reset" id="btnResetarDono" style="display: none" />
            <div class="modal-content">

                <div class="modal-header bg-primary">                
                    <button type="button" id="fecharBuscarDono" class="close" data-dismiss="modal">&times</button>
                    <b class="modal-title" style="text-transform: uppercase">Buscar Dono</b>
                </div>
                <div class="modal-body">

                    <!--<form> -->
                        <div class="form-group">        
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="donoProcurado">Dono</label>
                                    <input type="text" name="donoProcurado" id="donoProcurado" class="form-control" />
                                </div>
                                <div class="col-sm-12">
                                    <span class="help-block" id="vdonoProcurado"></span>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-default" id="btnProcurarDono" >Procurar</button> <br/><br/>
                        <div class="form-group">
                            <select id="donoSelecionado" class="form-control" name="donoSelecionado" size="5">

                            </select>
                        </div>
                    <!--</form>-->

                </div>            
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-success" id="btnSelecionarDono">Selecionar</button>
                </div>

            </div>
        </form>
    </div>
</div>



