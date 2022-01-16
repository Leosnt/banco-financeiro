<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['conta'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo!</div>"];
} elseif (empty($dados['saldo'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo!</div>"];
} else {
    $query_registro = "INSERT INTO cadastro_conta (conta, tipo_de_conta, instituicao, saldo) 
    VALUES (:conta, :tipo_de_conta, :instituicao, :saldo)";
    $cad_registro = $conn->prepare($query_registro);

    $cad_registro->bindParam(':conta', $dados['conta']);
    $cad_registro->bindParam(':tipo_de_conta', $dados['tipo_de_conta']);
    $cad_registro->bindParam(':instituicao', $dados['instituicao']);
    $cad_registro->bindParam(':saldo', $dados['saldo']);
    $cad_registro->execute();

    if ($cad_registro->rowCount()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>registro cadastrado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: registro não cadastrado com sucesso!</div>"];
    }
}

echo json_encode($retorna);
