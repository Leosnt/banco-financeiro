<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Verifique novamente!</div>"];
} elseif (empty($dados['conta'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo conta!</div>"];
} elseif (empty($dados['tipo_de_despesa'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o tipo de despesa!</div>"];
} elseif (empty($dados['valor'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o valor!</div>"];
} elseif (empty($dados['data_de_vencimento'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a data de vencimento!</div>"];
} elseif (empty($dados['data_de_pagamento'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a data de pagamento!</div>"];
} else {
    
    $query_registro= "UPDATE cadastro_despesa SET conta =:conta, tipo_de_despesa =:tipo_de_despesa, valor =:valor, data_de_vencimento =:data_de_vencimento, data_de_pagamento =:data_de_pagamento WHERE id=:id";
    $edit_registro = $conn->prepare($query_registro);
    $edit_registro->bindParam(':conta', $dados['conta']);
    $edit_registro->bindParam(':tipo_de_despesa', $dados['tipo_de_despesa']);
    $edit_registro->bindParam(':valor', $dados['valor']);
    $edit_registro->bindParam(':data_de_vencimento', $dados['data_de_vencimento']);
    $edit_registro->bindParam(':data_de_pagamento', $dados['data_de_pagamento']);
    $edit_registro->bindParam(':id', $dados['id']);

    if ($edit_registro->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Cadastro editado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Cadastro não editado!</div>"];
    }
}

echo json_encode($retorna);
