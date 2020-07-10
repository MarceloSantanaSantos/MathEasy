<?php
    require_once("../class/clsProfessor.class.php");
    $u = new professor;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Entrar - Professor</title>
    </head>
    <body>
        <section>
            <article class="logProfessor">
                <form action="" method="post" name="fmrLogProf" id="fmrLogProf">
                    <!-- Campo de Informações -->
                    <input type="text" name="emailLogProf" id="emailLogProf" placeholder="E-mail">
                    <input type="password" name="senhaLogProf" id="senhaLogProf" placeholder="Senha">
                    <!-- Botão Login -->
                    <input type="submit" value="Entrar">
                </form>
                <p>Ainda não tem conta? <a href="cadProfessor.php">Crie aqui!</a></p>
            </article>
        </section>
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
                            header("location: professorEscola.php");
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
                    echo "Preencha todos os campos";
                }
            }
        ?>
    </body>
</html>