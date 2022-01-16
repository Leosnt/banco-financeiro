<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['conta'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo!</div>"];
} elseif (empty($dados['valor'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo!</div>"];
} else {
    $query_registro = "INSERT INTO cadastro_despesa (conta, tipo_de_despesa, valor, data_de_vencimento, data_de_pagamento) 
    VALUES (:conta, :tipo_de_despesa, :valor, :data_de_vencimento, :data_de_pagamento)";
    $cad_registro = $conn->prepare($query_registro);
    $cad_registro->bindParam(':conta', $dados['conta']);
    $cad_registro->bindParam(':tipo_de_despesa', $dados['tipo_de_despesa']);
    $cad_registro->bindParam(':valor', $dados['valor']);
    $cad_registro->bindParam(':data_de_vencimento', $dados['data_de_vencimento']);
    $cad_registro->bindParam(':data_de_pagamento', $dados['data_de_pagamento']);
    $cad_registro->execute();

    if ($cad_registro->rowCount()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Registro cadastrado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Registro não cadastrado com sucesso!</div>"];
    }
}

echo json_encode($retorna);
