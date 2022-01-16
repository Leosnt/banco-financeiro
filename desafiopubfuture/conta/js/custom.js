const tbody = document.querySelector(".listar-registros");
const cadForm = document.getElementById("cad-registro-form");
const editForm = document.getElementById("edit-registro-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadregistroModal"));

const listarregistros = async (pagina) => {
    const dados = await fetch("./list.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarregistros(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    document.getElementById("btncadastro").value = "Cadastrar";

    if (document.getElementById("conta")!= null){
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo conta!</div>";
    } else if (document.getElementById("saldo")!= null){
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo saldo!</div>";
    } else {
        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);
        
        const dados = await fetch("cadastrar.php", {
            method: "POST",
            body: dadosForm,
        });
    
        const resposta = await dados.json();
        
        if(resposta['erro']){
            msgAlertaErroCad.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            cadForm.reset();
            cadModal.hide();
            listarregistros(1);
        }
    }    
    
    document.getElementById("btncadastro").value = "Cadastrar";
});

async function editregistroDados(id) {
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editregistroModal"));
        editModal.show();
        document.getElementById("editid").value = resposta['dados'].id;
        document.getElementById("editConta").value= resposta['dados'].conta;
        document.getElementById("editTipo").value = resposta['dados'].tipo_de_despesa;
        document.getElementById("editInst").value = resposta['dados'].instituicao;
        document.getElementById("editSaldo").value = resposta['dados'].saldo;
    }
}

        editForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            document.getElementById("btnsalvar").value = "Salvar";

            const dadosForm = new FormData(editForm);
        
            const dados = await fetch("editar.php", {
                method: "POST",
                body: dadosForm
            });

            const resposta = await dados.json();

            if (resposta['erro']) {
                msgAlertaErroEdit.innerHTML = resposta['msg'];
            } else {
                msgAlertaErroEdit.innerHTML = resposta['msg'];
                listarregistros(1);
            }

            document.getElementById("btnsalvar").value = "Salvar";
});



async function apagarregistroDados(id) {

    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){
        const dados = await fetch('apagar.php?id=' + id);

        const resposta = await dados.json();
        if (resposta['erro']) {
            msgAlerta.innerHTML = resposta['msg'];
        } else {
            msgAlerta.innerHTML = resposta['msg'];
            listarregistros(1);
        }
    }    

}