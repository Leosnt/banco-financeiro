<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['conta'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o conta!</div>"];
} elseif (empty($dados['tipo_de_conta'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Tipo de conta!</div>"];
} elseif (empty($dados['instituicao'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o instituicao!</div>"];
} elseif (empty($dados['saldo'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o saldo!</div>"];
} else {
    $query_registro= "UPDATE cadastro_conta SET conta=:conta,tipo_de_conta=:tipo_de_conta,instituicao=:instituicao,saldo=:saldo WHERE id=:id";
    $edit_registro= $conn->prepare($query_registro);
    $edit_registro->bindParam(':conta', $dados['conta']);
    $edit_registro->bindParam(':tipo_de_conta', $dados['tipo_de_conta']);
    $edit_registro->bindParam(':instituicao', $dados['instituicao']);
    $edit_registro->bindParam(':saldo', $dados['saldo']);
    $edit_registro->bindParam(':id', $dados['id']);
    
    if ($edit_registro->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Cadastro editado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Cadastro não editado!</div>"];
    }
}

echo json_encode($retorna);
