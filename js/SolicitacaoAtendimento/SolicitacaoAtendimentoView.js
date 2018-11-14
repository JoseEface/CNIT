var SolicitacaoAtendimentoView = {
    tabela: null,
    addflag: false,
    edflag: false,
    validadorAdicionar: null,
    validadorBuscar: null,
    validadorEditar: null,
    validadorBucarDono: null,
    idSolicitacaoEditada: null,        
    DonoSolicitado: function(modaldiv) {
        SolicitacaoAtendimentoView.validadorBuscarDono.resetForm();
        $("#btnResetarDono").click();
        $("#donoSelecionado").html("");

        $("#formBuscarDono .help-block").html("");
        if(modaldiv == "modalAdicionar" && $("#modalAdicionar").is(":visible"))
        {
            $("#modalAdicionar").modal("hide");
            $("#adddonoAlternativo").val("");
            SolicitacaoAtendimentoView.addflag=true;
        }
        if(modaldiv == "modalEdicao" && $("#modalEdicao").is(":visible"))
        {
            $("#modalEdicao").modal("hide");
            $("#eddonoAlternativo").val("");            
            SolicitacaoAtendimentoView.edflag=true;
        }

        $("#modalBuscarDono").modal();
    },
    CarregarSolicitacao: function(idsol) {
        SolicitacaoAtendimentoController.CarregarSolicitacao(
            {idsolicitacao: idsol},
            function(retorno) {
                var nomeDono = "";
                if(retorno.sucesso)
                {
                    SolicitacaoAtendimentoView.idSolicitacaoEditada=idsol;
                    SolicitacaoAtendimentoView.validadorEditar.resetForm();
                    console.log(retorno);
                    
                    if(retorno.dados.idDonoAlternativo != null)
                        nomeDono = retorno.dados.idDonoAlternativo+" - "+$($("tr[id=\"tbl"+idsol+"\"] td")[2]).html();                    
                                        
                    $("#formEditar .help-block").html("");
                    $("#eddataSolicitacao").val((new Date(retorno.dados.dataAbertura.date)).toLocaleDateString());
                    $("#eddonoAlternativo").val(nomeDono);
                    $("#edidnit").val(retorno.dados.idNit);
                    $("#edescola").val(retorno.dados.idEscola);
                    $("#ednomeEntregador").val(retorno.dados.nomeEntregador);
                    $("#eddescricaoProblema").val(retorno.dados.descricaoProblema);
                    $("#modalEdicao").modal("show");
                }
                else
                {
                    alert("Falha na solicitação ao servidor");
                    console.log(retorno);
                }
            },
            function(req,erro,msg) {
                alert("Falha na requisição");
                console.log(req); console.log(erro); console.log(msg);
            }
        );
    },
    RemoverSolicitacao: function(idsol) {        

        SolicitacaoAtendimentoController.RemoverSolicitacao({idsolicitacao:idsol},
            function(retorno) {
                var linha=null;
                if(retorno.sucesso) {
                    alert("Solicitação removida com sucesso !");
                    linha = SolicitacaoAtendimentoView.tabela.row("#tbl"+idsol);
                    linha.remove().draw(false);
                }
                else {
                    if(window.console)
                        console.log(retorno);
                    alert("FALHA ao remover solicitação.");
                }                
            },
            function(req,erro,msg) {
                if(window.console) {
                    console.log(req); console.log(erro); console.log(msg);
                }
                alert("FALHA na solicitação ao servidor.");
            }
        );
        
    },
    InicieComponentes: function()
    {
        SolicitacaoAtendimentoView.tabela=$("#tblSolicitacoes").DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }            
        });

        $.validator.addMethod("OuEscolaOuDono",function(value,element){
            var condicao = null;

            switch($(element).attr("id"))
            {
                case "addescola":
                    condicao = ( ($("#adddonoAlternativo").val() == "" && value != "") || ($("#adddonoAlternativo").val() != "" && value == "") );
                    break;
                case "edescola":
                    //console.log($("#eddonoAlternativo").val());
                    condicao = ( ($("#eddonoAlternativo").val() != "" && value == "") || ($("#eddonoAlternativo").val() == "" && value != "") );
                    break;
                case "adddonoAlternativo":
                    condicao = ( ($("#addescola").val() == "" && value != "") || ($("#addescola").val() != "" && value == "") );
                    break;
                case "eddonoAlternativo":
                    condicao = ( ($("#edescola").val() == "" && value != "") || ($("#edescola").val() != "" && value == "")  );
                    break;
                default:
                    condicao=true;
            }
            
            //console.log("Mostrando id: "+$(element).attr("id")+" "+condicao);
            return condicao;
        }, "Deve ser escolhido ou escola ou dono");



        SolicitacaoAtendimentoView.validadorBuscarDono=criarValidador("#formBuscarDono",
            {
                donoProcurado: {
                    required: true
                }
            }
        );

        SolicitacaoAtendimentoView.validadorEditar=criarValidador("#formEditar",
            {
                eddataSolicitacao: {
                    required: true
                },
                eddonoAlternativo: {
                    required: "#edescola:blank",
                    OuEscolaOuDono: true/*function(element) {
                        console.log("edescola: "+($("#edescola").val() == ""))
                        return ($("#edescola").val() == "");
                    }*/
                    //require_from_group: [1,".edgrupo"]
                },
                edidnit: {
                    required: true
                },
                edescola: {
                    required: "#eddonoAlternativo:blank",
                    OuEscolaOuDono: true /*function(element) {
                        console.log("eddonoAlternativo: "+$("#eddonoAlternativo").val() == "");
                        return ($("#eddonoAlternativo").val() == "");/
                    }*/
                    //require_from_group: [1,".edgrupo"]
                },
                ednomeEntregador: {
                    required: true
                },
                eddescricaoProblema: { 
                    required: true
                }
            }
        );

/*
        $(".datepicker").datepicker();
        $(".datepicker").datepicker("setDate",new Date());
*/
        $("#addescola").change(function(e){
            //console.log("mudo select "+$("#addescola").val());
            $("#vadddonoAlternativo").html("");
            SolicitacaoAtendimentoView.validadorAdicionar.element("#adddonoAlternativo");
            SolicitacaoAtendimentoView.validadorAdicionar.element("#addescola");
        });

        $("#edescola").change(function(e){
            //console.log("mudo select "+$("#addescola").val());
            $("#veddonoAlternativo").html("");
            SolicitacaoAtendimentoView.validadorAdicionar.element("#eddonoAlternativo");
            SolicitacaoAtendimentoView.validadorAdicionar.element("#edescola");
        });

        $("#adddataSolicitacao").datepicker();
        $("#adddataSolicitacao").datepicker("setDate",new Date());
        $("#adddataSolicitacao").datepicker({
            changeYear: true,
            onSelect: function(txtdata) {
                SolicitacaoAtendimentoView.validadorAdicionar.element("#adddataSolicitacao");
            }
        });
        $("#adddataSolicitacao").click(function(e){            
            $("#adddataSolicitacao").datepicker("setDate",null);
        });

        $("#dataSolicitacao").datepicker({changeYear: true,
            onSelect: function(txtdata) {                                        
               SolicitacaoAtendimentoView.validadorAdicionar.element("#dataSolicitacao");
            } 
        });

        $("#dataSolicitacao").click(function(e){
            $("#dataSolicitacao").datepicker("setDate",null);
        });

        $("#modalBuscarDono").on("hidden.bs.modal", function() {
            if(SolicitacaoAtendimentoView.addflag)
            {
                SolicitacaoAtendimentoView.addflag=false;            
                $("#modalAdicionar").modal();
            }
            if(SolicitacaoAtendimentoView.edflag)
            {
                SolicitacaoAtendimentoView.edflag=false;
                $("#modalEdicao").modal();
            }
        });

        $("#menuSolicitacao").addClass("extraActive");

        EscolaController.ListarEscolas(
            function(retorno){
                if(retorno.sucesso)
                {
                    var str="";
                    $.each(retorno.dados,function(indice,escola){
                        str+="<option value=\""+escola.idEscola+"\">"+escola.nome+"</option>";
                    });
                    $("#escola").append(str);
                    $("#addescola").append(str);
                    $("#edescola").append(str);
                }   
                else
                    alert("Falha na consulta para preencher escolas");
            },
            function(req,erro,msg){
                alert("Falha ao preencher escolas");
                console.log(req);console.log(erro); console.log(msg);
            }
        );

        SolicitacaoAtendimentoView.validadorAdicionar=criarValidador("#formAdicionar",
            {
                adddataSolicitacao: {
                    required: true
                },
                addidnit: {
                    required: true
                }, 
                addescola: {
                    required: "#adddonoAlternativo:blank",
                    OuEscolaOuDono: true
                    /*required: true,*/
                    //require_from_group: [1,".aomenosum"]
                },
                adddonoAlternativo: {
                    required: "#addescolablank:blank",
                    OuEscolaOuDono: true
                    //require_from_group: [1,".aomenosum"]
                },
                addnomeEntregador: {
                    required: true
                },
                adddescricaoProblema: {
                    required: true
                }                
            }
        );

        SolicitacaoAtendimentoView.validadorBuscar=criarValidador("#formBuscar",
            {
                dataSolicitacao: {
                    require_from_group: [1,".nominimoum"]
                },
                escola: {
                    require_from_group: [1,".nominimoum"]
                },
                idnit: {
                    require_from_group: [1,".nominimoum"]
                }
            }
        );

        $("#modalBuscarDono").on("hidden.bs.modal", function() {
            //alert("fechado");
            if(SolicitacaoAtendimentoView.addflag)
            {
                console.log("Modo adicionar");
                $("#vadddonoAlternativo").html("");
                $("#vaddescola").html("");
                SolicitacaoAtendimentoView.validadorAdicionar.element("#adddonoAlternativo");
                SolicitacaoAtendimentoView.validadorAdicionar.element("#addescola");
            }
            else
            {
                $("#veddonoAlternativo").html("");
                $("#vedescola").html("");
                SolicitacaoAtendimentoView.validadorAdicionar.element("#eddonoAlternativo");
                SolicitacaoAtendimentoView.validadorAdicionar.element("#edescola");
            }
        });

        $("#btnSalvarSolicitacao").click(function(){            
            if($("#formAdicionar").valid()) {
                //alert($("#adddescricaoProblema").val());
                var  idDAlternativo = $("#adddonoAlternativo").val();
                if(idDAlternativo != "")
                {
                    alert(idDAlternativo);
                    idDAlternativo = idDAlternativo.split(" - ")[0];                    
                }                
                SolicitacaoAtendimentoController.AdicionaSolicitacao(
                    {
                        dataabertura: $("#adddataSolicitacao").val(), idnit: $("#addidnit").val(),
                        descricaoproblema: $("#adddescricaoProblema").val(), nomeentregador: $("#addnomeEntregador").val(),
                        idescola: $("#addescola").val(), iddonoalternativo: idDAlternativo
                    },
                    function(retorno) {
                        if(retorno.sucesso) {
                            alert("Solicitação adicionada com sucesso !");
                            $("#modalAdicionar").modal("hide");
                        }
                        else    
                        {
                            alert("Falha ao cadastrar dados no servidor.");
                            console.log(retorno);
                        }
                    },
                    function(req,erro,msg) {
                        console.log(req); console.log(erro); console.log(msg);
                        alert("Falha no servidor");
                    }
                );
            }
        });

        $("#btnNovo").click(function(e){            
            SolicitacaoAtendimentoView.validadorAdicionar.resetForm();
            $("#btnResetarFormAdicionar").click();
            $("#modalAdicionar .help-block").html("");
            $("#adddataSolicitacao").datepicker("setDate",new Date());
            $("#modalAdicionar").modal("show");            
        });
        
        $("#dataSolicitacao").click(function(e){

        });

        $("#btnProcurar").click(function(e){
            e.preventDefault();
            if($("#formBuscar").valid()){
                SolicitacaoAtendimentoController.BuscarSolicitacao(
                    {escola:$("#escola").val(),idnit:$("#idnit").val(),dataabertura:$("#dataSolicitacao").val()},
                    function(retorno) {
                        novalinha="";
                        //console.log(retorno);
                        if(retorno.sucesso)
                        {
                            SolicitacaoAtendimentoView.tabela.clear().draw();
                            if(!retorno.dados.length)
                                alert("Nenhum valor encontrado !");
                            else
                            {
                                $.each(retorno.dados,function(indice,solicitacao){
                                    novalinha=[(new Date(solicitacao.dataAbertura.date)).toLocaleDateString(), (solicitacao.escola == null)?"-----":solicitacao.escola, (solicitacao.donoAlternativo == null)?"-----":solicitacao.donoAlternativo, "<button type=\"button\" onclick=\"SolicitacaoAtendimentoView.CarregarSolicitacao("+solicitacao.idSolicitacaoAtendimento+")\"><span class=\"glyphicon glyphicon-pencil\"></span></button>"];
                                    SolicitacaoAtendimentoView.tabela.row.add(novalinha).draw(false);
                                });
                            }
                        }
                        else
                        {
                            alert("Ocorreram falhas no servidor");
                            console.log(retorno);
                        }

                    },
                    function(req,erro,msg) {
                        console.log(req,erro,msg);
                        alert("Falha na solicitação");
                    }
                );
            }
        });

        $("#btnEditarSalvar").click(function(e){
            e.preventDefault();            
            if($("#formEditar").valid())
            {
                var idDAlternativo = $("#eddonoAlternativo").val();
                var nomeAlternativo = null;
                var resultado = null;

                if(idDAlternativo != "")
                {
                    resultado = idDAlternativo.split(" - ");                
                    idDAlternativo = resultado[0];
                    nomeAlternativo = resultado[1];
                }

                SolicitacaoAtendimentoController.EditarSolicitacao(
                    {idsolicitacao:SolicitacaoAtendimentoView.idSolicitacaoEditada,
                     dataabertura: $("#eddataSolicitacao").val(), iddonoalternativo: idDAlternativo/*$("#eddonoAlternativo").val()*/,
                     idnit:$("#edidnit").val(),descricaoproblema:$("#eddescricaoProblema").val(),
                     idescola:$("#edescola").val(),nomeentregador:$("#ednomeEntregador").val()
                    },
                    function(retorno) {
                        var linhaEditada=null;                        
                        var dadosLinha=null;
                        if(retorno.sucesso)
                        {
                            alert("Dados alterados com sucesso !");
                            $("#modalEdicao").modal("hide");
                            alert("#tbl"+SolicitacaoAtendimentoView.idSolicitacaoEditada);
                            linhaEditada=SolicitacaoAtendimentoView.tabela.row("#tbl"+SolicitacaoAtendimentoView.idSolicitacaoEditada);                               
                            dadosLinha=linhaEditada.data();
                            
                            if($("#edescola").val() != "")
                                dadosLinha[1]=$("#edescola option:selected").text(); //Coluna da Escola                                
                            else
                                dadosLinha[1]="-----";
                           
                            if(nomeAlternativo != null)
                                dadosLinha[2]=nomeAlternativo;
                            else
                                dadosLinha[2]="-----";
                            
                            linhaEditada.data(dadosLinha).draw(false);
                        }
                        else
                        {
                            console.log(retorno);
                            alert("Falha na requisição ao servidor");
                        }
                    },
                    function(req,erro,msg) {
                        alert("Falha na solicitação ao servidor - erro interno");
                        console.log(req); console.log(erro); console.log(msg);
                    }
                );
            }
            else
                alert("Falha na validação");
        });

        $("#btnProcurarDono").click(function(e){
            e.preventDefault();
            if($("#formBuscarDono").valid())
            {
                DonoAlternativoController.BuscarDono(
                    {dono:$("#donoProcurado").val()},
                    function(retorno) {
                        if(retorno.sucesso) {                       
                            $("#donoSelecionado").html("");
    
                            $.each(retorno.dados, function(indice,dados){
                                $("#donoSelecionado").append(" <option value=\""+dados.idDonoAlternativo+"\">"+dados.nome+"</option> ");
                            });
    
                            if(!retorno.dados.length)
                                alert("Nenhum dono encontrado.");
                            console.log(retorno);
                        }
                        else {
                            if(window.console) {
                                console.log(retorno);                            
                            }
                            alert("Falha ao retornar dados do servidor");
                        }
                    },
                    function(req,erro,msg) {
                        if(window.console)  {
                            console.log(req); console.log(erro); console.log(msg);
                        }
                        alert("Falha ao realizar requisição.");
                    }
                );   

            }
        });

        $("#btnListarLivres").click(function(e){
            e.preventDefault();
            novalinha = "";
            SolicitacaoAtendimentoController.BuscaSolicitacoesLivres(
                function(retorno) {
                    if(retorno.sucesso) 
                    {
                        SolicitacaoAtendimentoView.tabela.clear().draw();
                        $.each(retorno.dados,function(indice,solicitacao) {
                            novalinha=[(new Date(solicitacao.dataAbertura.date)).toLocaleDateString(), (solicitacao.escola == null)?"-----":solicitacao.escola, (solicitacao.donoAlternativo == null)?"-----":solicitacao.donoAlternativo, "<button type=\"button\" onclick=\"SolicitacaoAtendimentoView.CarregarSolicitacao("+solicitacao.idSolicitacaoAtendimento+")\" title=\"Editar\"><span class=\"glyphicon glyphicon-pencil\"></span></button> <button type=\"button\" onclick=\"SolicitacaoAtendimentoView.RemoverSolicitacao("+solicitacao.idSolicitacaoAtendimento+")\" title=\"Excluir\"><span class=\"glyphicon glyphicon-trash\"></span></button>"];
                            //SolicitacaoAtendimentoView.tabela.row.add(novalinha).draw(false);
                            SolicitacaoAtendimentoView.tabela.row.add(novalinha).node().id="tbl"+solicitacao.idSolicitacaoAtendimento;
                        });
                        SolicitacaoAtendimentoView.tabela.draw(false);
                        if(retorno.dados.length)
                            alert("Carregados "+retorno.dados.length+" solicitações livres");
                        else
                            alert("Nenhum solicitação livre disponível.");
                    }
                    else
                    {
                        if(window.console)
                            console.log(retorno);
                        alert("Não foi possível retornar dados do servidor");
                    }
                },
                function(req,erro,msg) {
                    if(window.console)
                    {
                        console.log(req); console.log(msg); console.log(erro);
                    }
                    alert("Falha na solicitação ao servidor");
                }
            );
        }); 

        $("#btnSelecionarDono").click(function(){
            var donoselecionado=$("#donoSelecionado").val();
            if(donoselecionado == null)
                alert("Escolha ao menos um dono alternativo");
            else
            {                
                if(SolicitacaoAtendimentoView.addflag)
                {
                    //console.log("MODO ADICIONAR");
                    $("#adddonoAlternativo").val(donoselecionado+" - "+$("#donoSelecionado :selected").text());
                    $("#vaddescola").html("");
                    $("#vadddonoAlternativo").html("");                    
                    SolicitacaoAtendimentoView.validadorAdicionar.element("#adddonoAlternativo");
                    SolicitacaoAtendimentoView.validadorAdicionar.element("#addescola");
                }
                else
                {
                    //console.log("MODO EDITAR");
                    $("#eddonoAlternativo").val(donoselecionado+" - "+$("#donoSelecionado :selected").text());
                    $("#vedescola").html("");
                    $("#veddonoAlternativo").html("");
                    SolicitacaoAtendimentoView.validadorAdicionar.element("#eddonoAlternativo");
                    SolicitacaoAtendimentoView.validadorAdicionar.element("#edescola");
                }
                $("#modalBuscarDono").modal("toggle");             
            }
        });
    }
};