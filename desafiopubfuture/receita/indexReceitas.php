<?php
include_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/style.css">
    <title>Desafio PubFuture</title>
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <a href="../index.html">
                        <button type="button" class="btn btn-outline-primary">Voltar</button>
                    </a>
                </div>
                <div>
                    <h4>LISTA DE RECEITAS</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadregistroModal">
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>
        <hr>

        <span id="msgAlerta"></span>

        <div class="row">
            <div class="col-lg-12">
                <span class="listar-registros"></span>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadregistroModal" tabindex="-1" aria-labelledby="cadregistroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadregistroModalLabel">Cadastrar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-registro-form" class="row g-4">
                        <span id="msgAlertaErroCad"></span>

                        <div class="col-md-2">

                        <label for="inputConta" class="form-label">Conta:</label>
                        <input type="number"  name="conta" class="form-control valor" required>
                        </div>

                        <div class="col-md-4">
                            <label for="inputTipoDeDespesa" class="form-label">Tipo de receita:</label>
                            <select id="tipoDespesa" class="form-select"  name="tipo_de_receita">
                                <option selected>---Selecione---</option>
                                <option>Salário</option>
                                <option>Presente</option>
                                <option>Premios</option>
                                <option>Outros</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="inputValor" class="form-label">Valor:</label>
                            <input type="number"  name="valor" class="form-control valor">
                        </div>

                        <div class="col-md-3">
                            <label for="inputDataFinal" class="form-label">Data de vencimento:</label>
                            <input type="date" class="form-control" name="data_de_vencimento">
                        </div>

                        <div class="col-md-3">
                            <label for="inputDataFinal" class="form-label">Data de pagamento:</label>
                            <input type="date" class="form-control" name="data_de_pagamento">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descrição</label>
                            <textarea class="form-control text" name="descricao" rows="3"></textarea>
                        </div>

                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <button type="button" class="btn btn-outline-secondary btn-sm"
                            data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" class="btn btn-outline-warning btn-sm" id="btncadastro" value="Salvar">
                        </div>

                
                        <div class="col-12">
                        <input id="btncadastro" type="submit" class="btn btn-primary" value="Cadastrar"></input>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="visregistroModal" tabindex="-1" aria-labelledby="visregistroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visregistroModalLabel">Detalhes do registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertaErroVis"></span>
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-9"><span id="idregistro"></span></dd>

                        <dt class="col-sm-3">Conta</dt>
                        <dd class="col-sm-9"><span id="visuConta"></span></dd>
                        
                        <dt class="col-sm-3">Tipo de receita</dt>
                        <dd class="col-sm-9"><span id="visuDesp"></span></dd>

                        <dt class="col-sm-3">Valor</dt>
                        <dd class="col-sm-9"><span id="visuValor"></span></dd>

                        <dt class="col-sm-3">Data vencimento</dt>
                        <dd class="col-sm-9"><span id="visuDataV"></span></dd>

                        <dt class="col-sm-3">Data pagamento</dt>
                        <dd class="col-sm-9"><span id="visuDataP"></span></dd>

                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editregistroModal" tabindex="-1" aria-labelledby="editregistroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editregistroModalLabel">Editar cadastro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-registro-form" class="row g-4">
                        <span id="msgAlertaErroEdit"></span>
                        <input type="hidden" name="id" id="editid">

                        <div class="col-md-3">

                        <label for="inputConta" class="form-label">Conta:</label>
                        <input type="number" name="conta" id="editConta" class="form-control valor" required>
                        </div>

                        <div class="col-md-4">
                            <label for="inputTipoDeDespesa" class="form-label">Tipo de receita:</label>
                            <select class="form-select"  name="tipo_de_receita" id="editRec">
                                <option selected>---Selecione---</option>
                                <option>Salário</option>
                                <option>Presente</option>
                                <option>Premios</option>
                                <option>Outros</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="inputValor" class="form-label">Valor:</label>
                            <input type="number"  name="valor" id="editValor" class="form-control valor">
                        </div>

                        <div class="col-md-3">
                            <label for="inputDataFinal" class="form-label">Data de vencimento:</label>
                            <input type="date" class="form-control" name="data_de_vencimento" id="editDataV">
                        </div>

                        <div class="col-md-3">
                            <label for="inputDataFinal" class="form-label">Data de pagamento:</label>
                            <input type="date" class="form-control" name="data_de_pagamento" id="editDataP">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descrição</label>
                            <textarea class="form-control text" id="editDesc" name="descricao" rows="3"></textarea>
                        </div>

                        <div class="modal-footer">
                            
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                data-bs-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-outline-warning btn-sm" id="btnsalvar" value="Salvar">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>

</html>