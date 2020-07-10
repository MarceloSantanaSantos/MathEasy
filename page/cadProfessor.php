<?php
    require_once('../class/clsProfessor.class.php');
    $u = new professor;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cadastro - Professor</title>
</head>
<body>
    <section>
        <article>
            <form method="POST">
                <input type="text" name="nomeCadProf" id="nomeCadProf" placeholder="Nome Completo">        
                <input type="email" name="emailCadProf" id="emailCadProf" placeholder="E-mail">        
                <input type="password" name="senhaCadProf" id="senhaCadProf" placeholder="Senha">        
                <input type="password" name="confSenhaCadProf" id="confSenhaCadProf" placeholder="Confirmar Senha">
                <input type="submit" value="Cadastrar">       
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
                                        echo "Cadastrado com sucesso, acesse para entrar";
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
                                    window.location('../page/cadProfessor.php');
                                </script>";
                        }
                    } 
                ?>
            </div>
        </article>
    </section>
</body>
</html>