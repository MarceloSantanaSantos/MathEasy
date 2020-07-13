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
    <link rel="stylesheet" href="../../css/stCadMolde.css">
    <title>Cadastro - Aluno</title>
</head>
<body>
    <?php require_once("../parte/header.php") ?>
    <section>
        <article>
            <h2>CADASTRO ALUNO(A)</h2>
            <form method="post">
                <input type="text" class="boxLogin" name="nomeCadAluno" id="nomeCadAluno" placeholder="Nome Completo">        
                <input type="email" class="boxLogin" name="emailCadAluno" id="emailCadAluno" placeholder="E-mail">        
                <input type="password" class="boxLogin" name="senhaCadAluno" id="senhaCadAluno" placeholder="Senha">        
                <input type="password" class="boxLogin" name="confSenhaCadAluno" id="confSenhaCadAluno" placeholder="Confirmar Senha">
                <input type="submit" class="btnLogin" value="Cadastrar">       
            </form>
            <div>
                <?php
                    // Verificar se a pessoa clicou no botão
                    if (isset($_POST['nomeCadAluno']))
                    {
                        $nomeCadAluno = addslashes($_POST['nomeCadAluno']);
                        $emailCadAluno = addslashes($_POST['emailCadAluno']);
                        $senhaCadAluno = addslashes($_POST['senhaCadAluno']);
                        $confSenhaCadAluno = addslashes($_POST['confSenhaCadAluno']);
                        // Verificar se inputs estão preenchidos
                        if (!empty($nomeCadAluno) && !empty($emailCadAluno) && !empty($senhaCadAluno) && !empty($confSenhaCadAluno))
                        {
                            $a->conectar("matheasy", "localhost", "root", "root");
                            // Verificar se não existe erro
                            if ($a->msgErro == "")
                            {
                                // Verificar campos de senha
                                if ($senhaCadAluno == $confSenhaCadAluno)
                                {
                                    if ($a->cadastrarAluno($nomeCadAluno,$emailCadAluno, $senhaCadAluno))
                                    {
                                        echo "<script language='javascript' type='text/javascript'>
                                            alert ('Cadastro efetuado com sucesso, entre para acessar');
                                            window.location.href='../login/entrarAluno.php';
                                         </script>";
                                    }
                                    else 
                                    {
                                        echo "E-mail já cadastrado.";
                                    }
                                }
                                else 
                                {
                                    echo "Senhas não correspondem";
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
                                    window.location('../page/cadastro/cadAluno.php');
                                </script>";
                        }
                    }
                ?>
            </div>
        </article>
    </section>
    <?php require_once("../parte/footer.php");?>
</body>
</html>