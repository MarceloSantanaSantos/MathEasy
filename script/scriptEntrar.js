function cadastrarProfessor(menu) {

    var nome;
    var email;
    var senha;

    nome = document.getElementById("nomeProf").value;
    email = document.getElementById("emailProf").value;
    senha = document.getElementById("senhaProf").value;
    senhac = document.getElementById("senhaProfC").value;

    if (nome == '' && email == '' && senha == '' && senhac == '') {
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

    email = document.getElementById("emailLogProf").value;
    senha = document.getElementById("senhaLogProf").value;

    if (email == '' && senha == '') {
        alert ("Atenção: Formulário vazio.");
    }
    else if (email == '') {
        alert ("Atenção: Campo E-mail vazio.");
    }
    else if (senha == '') {
        alert ("Atenção: Campo Senha vazio.");
    }
    else {
        document.fmrCadProf.action = "./entrarProfessor.php?acaoProfessor="+menu;
        document.fmrCadProf.submit();
    }
}

function cadastrarAluno(menu) {
    
    var nome;
    var email;
    var senha;
    var senhac;

    nome = document.getElementById("nomeAluno").value;
    email = document.getElementById("emailAluno").value;
    senha = document.getElementById("senhaAluno").value;
    senhac = document.getElementById("senhaAlunoC").value;

    if (nome == '' && email == '' && senha == '' && senhac == '') {
        alert ("Atenção: Formulário vazio.");
    }
    else if (nome == '') {
        alert ("Atenção: Campo Nome vazio.");
    }
    else if (email == '') {
        alert ("Atenção: Campo E-mail vazio.");
    }
    else if (senha == '') {
        alert ("Atenção: Campo Senha vazio.");
    }
    else if (senhac == '') {
        alert ("Atenção: Campo Confirmar Senha vazio.");
    }
    else if (senha != senhac) {
        alert ("Atenção: Senhas inseridas não coincidem.");
    }
    else {
        document.fmrCadAluno.action = "./entrarAluno.php?acaoAluno="+menu;
        document.fmrCadAluno.submit();
    }
}

function logarAluno(menu) {

    var email;
    var senha;

    email = document.getElementById("emailLogAluno").value;
    senha = document.getElementById("senhaLogAluno").value;

    if (email == '' && senha == '') {
        alert ("Atenção: Formulário vazio.");
    }
    else if (email == '') {
        alert ("Atenção: Campo E-mail vazio.");
    }
    else if (senha == '') {
        alert ("Atenção: Campo Senha vazio");
    }
    else {
        document.fmrCadAluno.action = "./entrarAluno.php?acaoAluno="+menu;
        document.fmrCadAluno.submit();
    }
}