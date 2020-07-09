function adicionarEscola(menu) {

    var nomeEscola, cidadeEscola;

    nomeEscola = document.getElementById("nomeEscola").value;
    cidadeEscola = document.getElementById("cidadeEscola").value;

    if (nomeEscola == '' && cidadeEscola == '') {
        alert ("Atenção: Formulário vazio.");        
    }
    else if (nomeEscola == '') {
        alert ("Atenção: Campo Nome da Escola vazio.");
    }
    else if (cidadeEscola == '') {
        alert ("Atenção: Campo Cidade vazio.");
    }
    else {
        document.fmrProfEsc.action = "./professorEscola.php?acaoProfessor="+menu;
        document.fmrProfEsc.submit();
    }
}