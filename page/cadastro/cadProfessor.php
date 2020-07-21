<?php
    require_once('../../class/clsProfessor.class.php');
    $u = new professor;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/molde.css">
    <link rel="stylesheet" href="../../css/stCadMolde.css">
    <title> Cadastro - Professor</title>
</head>
<body>
    <?php require_once("../parte/header.php") ?>
    <section>
        <article>
            <h2>CADASTRO PROFESSOR(A)</h2>
            <form method="POST">
                <input type="text" class="boxLogin" name="nomeCadProf" id="nomeCadProf" placeholder="Nome Completo" maxlength='100'>        
                <input type="email" class="boxLogin" name="emailCadProf" id="emailCadProf" placeholder="E-mail" maxlength='100'>        
                <input type="password" class="boxLogin" name="senhaCadProf" id="senhaCadProf" placeholder="Senha" maxlength='50'>        
                <input type="password" class="boxLogin" name="confSenhaCadProf" id="confSenhaCadProf" placeholder="Confirmar Senha" maxlength='50'> 
                <input type="submit" class="btnLogin" value="Cadastrar">       
            </form>
            <div>
                <?php
                    // Verificar se a pessoa clicou no botão
                    if (isset($_POST['nomeCadProf'])) 
                    {
                        $nomeCadProf = addslashes($_POST['nomeCadProf']);
                        $emailCadProf = addslashes($_POST['emailCadProf']);
                        $senhaCadProf = addslashes($_POST['senhaCadProf']);
                        $confSenhaCadProf = addslashes($_POST['confSenhaCadProf']);
                        // Verificar se estão preenchidos
                        if (!empty($nomeCadProf) && !empty($emailCadProf) && !empty($senhaCadProf) && !empty($confSenhaCadProf)) 
                        {
                            $u->conectar("matheasy", "localhost", "root", "root"); 
                            // Verificar se não existe erro
                            if ($u->msgErro == "") 
                            {
                                if ($senhaCadProf == $confSenhaCadProf) 
                                {
                                    if($u->cadastrarProfessor($nomeCadProf,$emailCadProf,$senhaCadProf))
                                    {
                                        echo "<script language='javascript' type='text/javascript'>
                                                alert ('Cadastro efetuado com sucesso, entre para acessar');
                                                window.location.href='../login/entrarProfessor.php';
                                             </script>";
                                    }
                                    else 
                                    {
                                        echo "E-mail já cadastrado.";
                                    }
                                    
                                }
                                else 
                                {
                                    echo "Senhas não correspondentes";
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
                                    window.location('../page/cadastro/cadProfessor.php');
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