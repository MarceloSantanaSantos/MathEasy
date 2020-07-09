<?php
    $msgProfessor = "";
    require_once("../dbase/dbconn.php");
    require_once("../class/clsBancoDados.class.php");
    require_once("../class/clsProfessor.class.php");

    // Variáveis Professor
    $idProf = "";
    $nomeProf = "";
    $emailProf = "";
    $senhaProf = "";

    if ($_POST) {
        $acaoProfessor = "";
        // Verificando se o parẫmetro acaoProfessor existe na URL
        if (isset($_REQUEST["acaoProfessor"])) {
            $acaoProfessor = $_REQUEST["acaoProfessor"];
        }
        // Criando objeto para representar classe professor
        $objProfessor = new professor();
        // Recuperar todos os dados que o usuário digitou e enviando para os atributos da classe professor
        $objProfessor->nomeProf = $_REQUEST["nomeProf"];
        $objProfessor->emailProf = $_REQUEST["emailProf"];
        $objProfessor->senhaProf = $_REQUEST["senhaProf"];

        // Verificar qual o parâmetro acaoProfessor
        if ($acaoProfessor == 'cadastrarProfessor') {
            if ($objProfessor->getGravarProfessor()) {
                $msgProfessor = "Professor cadastrado com sucesso.";
                echo    "<script language='javascript' type='text/javascript'>
                            alert ('Professor cadastrado com sucesso.');
                            window.location.href='../page/professorEscola.php'
                        </script>";
            }
            else {
                $msgProfessor = $objProfessor->getErro();
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro - Professor</title>
    </head>
    <body>
        <header></header>
        <section>
            <article class="logProfessor">
                <form action="" method="post" name="fmrLogProf" id="fmrLogProf">
                    <!-- Campo de Informações -->
                    <input type="text" name="emailProf" id="emailLogProf" placeholder="E-mail">
                    <input type="text" name="senhaProf" id="senhaLogProf" placeholder="Senha">
                    <!-- Botão Login -->
                    <a href="#" onclick="logarProfessor('logarProfessor');">Entrar</a>
                </form>
            </article>
            <article class="cadProfessor">
                <form action="" method="post" name="fmrCadProf" id="fmrCadProf">
                    <!-- Campos de Informações -->
                    <input type="text" name="nomeProf" id="nomeProf" placeholder="Nome Completo">
                    <input type="text" name="emailProf" id="emailProf" placeholder="E-mail">
                    <input type="text" name="senhaProf" id="senhaProf" placeholder="Senha">
                    <input type="text" name="senhaProfC " id="senhaProfC" placeholder="Confirmar Senha">
                    <!-- Botão Cadastro -->
                    <a href="#" onclick="cadastrarProfessor('cadastrarProfessor');">Cadastrar</a>
                </form>
                <div> 
                    <?php echo $msgProfessor; ?>
                </div>
            </article>
        </section>
    </body>
</html>

<script src="../script/scriptEntrar.js"></script>