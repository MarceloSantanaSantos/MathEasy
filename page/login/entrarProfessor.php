<?php
    require_once("../../class/clsProfessor.class.php");
    $u = new professor;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/molde.css">
        <link rel="stylesheet" href="../../css/stEntrarMolde.css">
        <title>Entrar - Professor</title>
    </head>
    <body>
        <?php require_once("../parte/header.php");?>
        <section>
            <article class="logProfessor">
                <h2>LOGIN PROFESSOR</h2>
                <form action="" method="post" name="fmrLogProf" id="fmrLogProf">
                    <!-- Campo de Informações -->
                    <input type="text" name="emailLogProf" id="emailLogProf" placeholder="E-mail" class="boxLogin" maxlength='100'>
                    <input type="password" name="senhaLogProf" id="senhaLogProf" placeholder="Senha" class="boxLogin" maxlength='50'>
                    <!-- Botão Login -->
                    <input type="submit" value="ENTRAR" class="btnLogin">
                </form>
                <p>Não tem conta? <a href="../cadastro/cadProfessor.php">&nbsp;&nbsp;Cadastre-se já!&nbsp;&nbsp;</a></p>
            </article>
        </section>
        <?php require_once("../parte/footer.php");?>
        <?php
            if (isset($_POST['emailLogProf'])) 
            {
                $emailLogProf = addslashes($_POST['emailLogProf']);
                $senhaLogProf = addslashes($_POST['senhaLogProf']);
                // Verificar se os campos foram preenchidos
                if (!empty($emailLogProf) && !empty($senhaLogProf))
                {
                    $u->conectar("matheasy", "localhost", "root", "root"); 
                    if ($u->msgErro == "")
                    {
                        if($u->logarProfessor($emailLogProf,$senhaLogProf))
                        {
                            header("location: ../professor/professorEscola.php");
                        }
                        else 
                        {
                            echo "Email e/ou Senha incorreto(s)";
                        }
                    }
                    else 
                    {
                        echo "Erro: ".$u->msgErro;
                    }
                    
                }
                else 
                {
                    echo "<script language='javascript' type='text/javascript'>
                    alert ('Preencha os campos');
                    window.location('../page/login/entrarProfessor.php');
                </script>";
                }
            }
        ?>
    </body>
</html>