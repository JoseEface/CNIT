<!-- PAINEL DE BUSCA DE ATENDIMENTO -->
<div class="panel panel-default">
    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold">
        Buscar em Atendimentos
    </div>

    <div class="panel-body">

        <div class="row">
            <div class="col-sm-12"> 
                <!--
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdicionar" id="btnNovo"><span class="glyphicon glyphicon-plus"></span> Novo</button>
                -->
                <button type="button" class="btn btn-primary btn-sm" id="btnNovo"><span class="glyphicon glyphicon-plus"></span> Novo</button>
            </div>
        </div>
        <br/>

        <form method="post" action="" id="formBuscar">
            <div class="form-group">
                <div class="row">

                    <div class="col-sm-4">
                        <label for="buscaTecnico">Técnico</label>
                        <select id="buscaTecnico" name="buscaTecnico" class="form-control busca-group">
                            <option value="">Selecione...</select>                            
                        </select>
                    </div>
                    <div class="col-sm-4"> 
                        <label for="buscaIdNit">Id NIT</label>
                        <input type="text" id="buscaIdNit" name="buscaIdNit" class="form-control busca-group" placeholder="Id NIT" />
                    </div>
                    <div class="col-sm-4"> 
                        <label for="buscaSituacao">Situação</label>
                        <select id="buscaSituacao" name="buscaSituacao" class="form-control busca-group">
                            <option value="">Selecione...</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <span class="help-block" style="color: red;" id="vbuscaTecnico"> </span>
                    </div>
                    <div class="col-sm-4">
                        <span class="help-block" style="color: red;" id="vbuscaIdNit"> </span>
                    </div>
                    <div class="col-sm-4">
                        <span class="help-block" style="color: red;" id="vbuscaSituacao"> </span>
                    </div>
                </div>
            </div>
        </form>

    </div>   

    <div class="panel-footer" style="text-align: center;">
        <button type="button" class="btn btn-success" id="btnProcurar">Procurar</button>
    </div>
</div>
<!-- PAINEL DE BUSCA DE ATENDIMENTO -->

<!-- PAINEL RESULTADO DA BUSCA DE ATENDIMENTOS -->
<div class="panel panel-default">
    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold"> 
        RESULTADOS DE BUSCA
    </div>
    <div class="panel-body"> 
        <table id="tblAtendimentos" class="table table-bordered">
            <thead>
                <tr>
                    <th>Escola</th>
                    <th>Id NIT</th>
                    <th>Técnico</th>
                    <th>Situação</th>    
                    <th>Operação</th>                
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- FIM DO PAINEL DE RESULTADO DA BUSCA DE ATENDIMENTO -->


<!-- MODAL DE ADIÇÃO DE ATENDIMENTO -->
<div class="modal fade" id="modalAdicionar">
    <div class="modal-dialog">
        <form method="post" action="" id="formAdicionar">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <b class="modal-title" style="text-transform: uppercase">Adicionar Atendimento</b>

                </div>
                <div class="modal-body">

                    <input type="hidden" name="novoIdAtendimento" value="0" id="novoIdAtendimento"/>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="novoTecnico" class="control-label">Técnico</label>                                    
                                <select id="novoTecnico" name="novoTecnico" class="form-control">
                                    <option value="">Selecione...</option>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <label for="novaSolicitacaoAtendimento">Solicitação </label>
                                <select id="novaSolicitacaoAtendimento" name="novaSolicitacaoAtendimento" class="form-control">
                                    <option value="">Selecione...</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <span class="help-block" id="vnovoTecnico"></span>
                            </div>
                            <div class="col-sm-8">
                                <span class="help-block" id="vnovaSolicitacaoAtendimento"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="novoLocalDE">Local DE </label>
                                <select id="novoLocalDE" name="novoLocalDE" class="form-control">
                                    <option value="">Selecione...</option>
                                </select>                
                            </div>
                            <div class="col-sm-3">
                                <label for="novaSituacao">Situação </label>
                                <select id="novaSituacao" name="novaSituacao" class="form-control">
                                    <option value="">Selecione....</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="novaDataInicio">Data Início </label>
                                <input type="text" id="novaDataInicio" name="novaDataInicio" class="form-control" value="" readonly/>
                            </div>
                            <div class="col-sm-3">
                                <label for="novaDataInicio">Data Finalização </label>
                                <input type="text" id="novaDataFinalizacao" name="novaDataFinalizacao" class="form-control" value="" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <span class="help-block" id="vnovoLocalDE"></span>
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block" id="vnovaSituacao"></span>   
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block" id="vnovaDataInicio"></span>
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block" id="vnovaDataFinalizacao"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="novaDescricaoSolucao">Descrição solução</label>
                                <textarea id="novaDescricaoSolucao" name="novaDescricaoSolucao" class="form-control" style="resize: vertical"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="help-block" id="vnovaDescricaoSolucao"></span>
                            </div>
                        </div>
                    </div>
                </div>            
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-success" id="btnAdicionarAtendimento">Salvar</button>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- MODAL DE ADIÇÃO DE ATENDIMENTO -->

<!-- MODAL DE EDIÇÃO DE ATENDIMENTO -->
<div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
        <form method="post" id="formEditarAtendimento"action="">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <b class="modal-title" style="text-transform: uppercase">Editar Atendimento</b>

                </div>
                <div class="modal-body">

                    <input type="hidden" name="editarIdAtendimento" value="0" id="editarIdAtendimento"/>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editarTecnico" class="control-label">Técnico</label>                                    
                                <select id="editarTecnico" name="editarTecnico" class="form-control" disabled="disabled">
                                    <option value="">Selecione...</option>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <label for="editarSolicitacaoAtendimento">Solicitação </label>
                                <input type="text" class="form-control" id="editarSolicitacaoAtendimento" name="editarSolicitacaoAtendimento" disabled="disabled" />
                                <!--
                                <select id="editarSolicitacaoAtendimento" name="editarSolicitacaoAtendimento" class="form-control">
                                    <option value="">Selecione...</option>
                                </select> 
                                -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="editarLocalDE">Local DE </label>
                                <select id="editarLocalDE" name="editarLocalDE" class="form-control">
                                    <option value="">Selecione...</option>
                                </select>                
                            </div>
                            <div class="col-sm-3">
                                <label for="editarSituacao">Situação </label>
                                <select id="editarSituacao" name="editarSituacao" class="form-control">
                                    <option value="">Selecione....</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="editarDataInicio">Data Início </label>
                                <input type="text" id="editarDataInicio" name="editarDataInicio" class="form-control" value="" readonly/>
                            </div>
                            <div class="col-sm-3">
                                <label for="editarDataFinalizacao">Data Finalização </label>
                                <input type="text" id="editarDataFinalizacao" name="editarDataFinalizacao" class="form-control" value="" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <span class="help-block" id="veditarLocalDE"></span>
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block" id="veditarSituacao"></span>
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block" id="veditarDataInicio"></span>
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block" id="veditarDataFinalizacao"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="editarDescricaoSolucao">Descrição solução</label>
                                <textarea id="editarDescricaoSolucao" name="editarDescricaoSolucao" class="form-control" style="resize: vertical"></textarea>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="help-block" id="veditarDescricaoSolucao"></span>
                            </div>
                        </div>
                    </div> 
                </div>            
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-success" id="btnEditarAtendimento">Salvar</button>
                    <input type="reset" style="display: none" id="btnEditarReset" value="Limpar"/> 
                </div>

            </div>
        </form>
    </div>
</div>
<!-- FIM DA MODAL DA EDIÇÃO DE ATENDIMENTO -->