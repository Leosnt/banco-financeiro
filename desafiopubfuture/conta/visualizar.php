<?php
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_registro = "SELECT id, conta, tipo_de_conta, instituicao, saldo FROM cadastro_conta WHERE id =:id LIMIT 1";
    $result_registro = $conn->prepare($query_registro);
    $result_registro->bindParam(':id', $id);
    $result_registro->execute();

    $row_registro = $result_registro->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_registro];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum registro encontrado!</div>"];
}

echo json_encode($retorna);
