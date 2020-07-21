<?php
    require_once("../../class/clsAluno.class.php");
    $a = new aluno;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/molde.css">
    <link rel="stylesheet" href="../../css/stEntrarMolde.css">
    <title>Entrar - Aluno</title>
</head>
<body>
    <!-- HEADER -->
    <?php require_once("../parte/header.php");?>
    <section>
            <article class="logAluno">
                <h2>LOGIN ALUNO</h2>
                <form action="" method="post" name="fmrLogAluno" id="fmrLogAluno">
                    <!-- Campo de Informações -->
                    <input type="text" name="emailLogAluno" id="emailLogAluno" placeholder="E-mail" class="boxLogin" maxlength='100'>
                    <input type="password" name="senhaLogAluno" id="senhaLogAluno" placeholder="Senha" class="boxLogin" maxlength='50'>
                    <!-- Botão Login -->
                    <input type="submit" value="ENTRAR" class="btnLogin">
                </form>
                <p>Não tem conta? <a href="../cadastro/cadAluno.php">&nbsp;&nbsp;Cadastre-se já!&nbsp;&nbsp;</a></p>
            </article>
        </section>
    <!-- FOOTER -->
    <?php require_once("../parte/footer.php");?>
    <?php 
        // Verificar se usuário clicou no botão
        if (isset($_POST['emailLogAluno']))
        {
            $emailLogAluno = addslashes($_POST['emailLogAluno']);
            $senhaLogAluno = addslashes($_POST['senhaLogAluno']);
            // Verificar se ps campos foram preenchidos
            if (!empty($emailLogAluno) && !empty($senhaLogAluno))
            {
                $a->conectar("matheasy", "localhost", "root", "root");  
                if ($a->msgErro == "")
                {
                    if ($a->logarAluno($emailLogAluno,$senhaLogAluno))
                    {
                        header("location: ../aluno/alunoInicial.php");
                    }
                    else 
                    {
                        echo "<script language='javascript' type='text/javascript'>
                        alert ('Dados Incorretos');
                        window.location('../page/login/entrarAluno.php');                               
                              </script>";
                    }
                }
                else 
                {
                    echo "Erro: ".$a->msgErro;
                }
            }
            else
            {
                echo "<script language='javascript' type='text/javascript'>
                alert ('Preencha os campos');
                window.location('../page/login/entrarAluno.php');
            </script>";
            }
        }
    ?>
</body>
</html>