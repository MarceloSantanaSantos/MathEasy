function cadastrarProfessor(menu) {

    var nome;
    var email;
    var senha;

    nome = document.getElementById("nomeProf").value;
    email = document.getElementById("emailProf").value;
    senha = document.getElementById("senhaProf").value;
    senhac = document.getElementById("senhaProfC").value;

    if (nome == '' && email == '' && senha == '') {
        alert ("Atenção: Formulário vazio.");
    }
    else if (nome == '') {
        alert ("Atenção: Campo Nome vazio.");
    }
    else if (email == '') {
        alert ("Atenção: Campo E-mail vazio");
    }
    else if (senha == '') {
        alert ("Atenção: Campo Senha vazio.");
    }
    else if (senhac == '') {
        alert ("Atenção: Campo Confirmar Senha vazio.");
    }
    else if (senha != senhac) {
        alert ("Atenção: Senhas inseridas não coincidem");
    }
    else {
        document.fmrCadProf.action = "./entrarProfessor.php?acaoProfessor="+menu;
        document.fmrCadProf.submit();
    }
}

function logarProfessor(menu) {

    var email;
    var senha;

    email = document.getElementById("emailProf").value;
    senha = document.getElementById("senhaProf").value;

    if (email == '' && senha == '') {
        alert ("Atenção: Formulário vazio.");
    }
    else if (email == '') {
        alert ("Atenção: Campo E-mail vazio.");
    }
    else if (senha == '') {
        alert ("Atenção: Campo Senha vazia.");
    }
    else {
        document.fmrCadProf.action = "./entrarProfessor.php?acaoProfessor="+menu;
        document.fmrCadProf.submit();
    }
}