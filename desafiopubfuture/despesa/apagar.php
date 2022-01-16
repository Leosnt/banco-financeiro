<?php
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_registro = "DELETE FROM cadastro_despesa WHERE id=:id";
    $result_registro = $conn->prepare($query_registro);
    $result_registro->bindParam(':id', $id);

    if($result_registro->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>registro apagado com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: registro não apagado com sucesso!</div>"];
    }    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum registro encontrado!</div>"];
}

echo json_encode($retorna);
