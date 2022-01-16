<?php
include_once "conexao.php";

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    //Calcular o inicio visualização
    $qnt_result_pg = 40; //Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_registros = "SELECT id, conta, tipo_de_receita, valor, data_de_pagamento, data_de_vencimento, descricao FROM cadastro_receita ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
    $result_registros = $conn->prepare($query_registros);
    $result_registros->execute();

    $dados     = "<div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Conta</th>
                        <th>Tipo de receita</th>
                        <th>Valor</th>
                        <th>Data de pagamento</>
                        <th>Data de vencimento</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row_registro = $result_registros->fetch(PDO::FETCH_ASSOC)) {
        extract($row_registro);
        $dados .= "<tr>
                    <td>$id</td>
                    <td>$conta</td>
                    <td>$tipo_de_receita</td>
                    <td>$valor</td>
                    <td>$data_de_vencimento</td>
                    <td>$data_de_pagamento</td>
                    <td>$descricao</td>
                    <td>
                        <button id='$id' class='btn btn-outline-info btn-sm' onclick='editregistroDados($id)'>Editar</button>

                        <button id='$id' class='btn btn-outline-danger btn-sm' onclick='apagarregistroDados($id)'>Apagar</button>
                    </td>
                </tr>";
    }

    $dados .= "</tbody>
        </table>
    </div>";

    //Paginação - Somar a quantidade de registros
    $query_pg = "SELECT COUNT(id) AS num_result FROM cadastro_receita";
    $result_pg = $conn->prepare($query_pg);
    $result_pg->execute();
    $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

    //Quantidade de pagina
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;

    $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

    $dados .= "<li class='page-item'><a href='#' class='page-link' onclick='listarregistros(1)'>Primeira</a></li>";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
        if($pag_ant >= 1){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarregistros($pag_ant)' >$pag_ant</a></li>";
        }        
    }    

    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
        if($pag_dep <= $quantidade_pg){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarregistros($pag_dep)'>$pag_dep</a></li>";
        }        
    }

    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarregistros($quantidade_pg)'>Última</a></li>";
    $dados .=   '</ul></nav>';

    echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhum registro encontrado!</div>";
}
