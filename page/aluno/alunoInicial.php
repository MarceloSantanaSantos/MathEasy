<?php
    session_start();
    if (!isset($_SESSION['idAluno']))
    {
        header ("location: ../login/entrarAluno.php");
    }
    else
    {
        // ############### INFORMAÇÕES CLASSES ###############
        require_once("../../class/clsEscola.class.php");
        require_once("../../class/clsTurma.class.php");
        require_once("../../class/clsAluno.class.php");
        $o = new escola;
        $t = new turma;
        $a = new aluno;

        // ############### REQUISIÇÕES ALUNO ###############
        $idAluno = $_SESSION['idAluno'];
        $nomeAluno = "";
        $a->conectar("matheasy", "localhost", "root", "root");
        if($a->msgErro == "")
        {
            $nomeAluno = $a->perfilAluno($idAluno);
        }
        else 
        {
            die();
        }

        if ($a->verificarTurma($idAluno) == false) 
        {
            header("location: alunoVazio.php");
            exit;
        }

        $pontuacao += $_GET['pontuacao'];
        $a->updatePontuacao($idAluno, $pontuacao);
        $dadosAluno = $a->consultarAluno($idAluno);
        if ($dadosAluno->rowCount() != 0)
        {
            while ($row=$dadosAluno->fetch())
            {
                $nomeAluno = $row['nomeAluno'];
                $emailAluno = $row['emailAluno'];
                $FK_idTurma = $row['FK_idTurma'];
                $pont = $row['pontuacao'];
            }
        }

        
        $dadosTurma = $a->dadosTurma($FK_idTurma);
        while ($row=$dadosTurma->fetch())
        {
            $idTurma = $row['idTurma'];
            $anoTurma = $row['ano'];
            $letraTurma = $row['letra'];
            
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/molde.css">
        <link rel="stylesheet" href="../../css/stAlunoInicial.css">
        <title>Aluno - Inicial</title>
    </head>
    <body>
        <?php require_once("../parte/headerLogadoAluno.php");?>
        <div class="hdAluno"><h2>Aluno - Turma </h2></div>
        <section>
            <aside>
                <div class="ptAside1">
                    <h3>Perfil Aluno(a)</h3>
                </div>
                <div class="ptAside2">
                    <div class="user">
                        <img src="../../img/user.png" alt="">
                    </div>
                </div>
                <div class="ptAside3">
                    <h4><?php echo "$nomeAluno"?></h4>
                    <h4><?php echo "$emailAluno"?></h4>
                    <h4><?php echo "Id do Aluno: #$idAluno"?></h4>
                    <h4><?php echo "Turma: $anoTurma"." "."$letraTurma"?></h4>
                    <h4><?php echo "ID Turma: #$idTurma"?></h4>
                </div>
                <div class="ptAside4">
                    <form method="POST">
                        <input type="submit" id='sairTurma' class="btnTurma" name='sairTurma' value='Sair da Turma'>
                    </form>
                </div>
                <div class="msgAlunoTurma">
                    <?php
                        if (isset($_POST['sairTurma']))
                        {
                            $idTurma = null;
                            $a->conectar("matheasy", "locahost", "root", "root");
                            if ($a->msgErro == "")
                            {
                                if ($a->updateIdTurma($addTurmaId, $idAluno) == false)
                                {
                                    echo "<script language='javascript' type='text/javascript'>
                                            
                                            window.location.href='alunoVazio.php';
                                          </script>";
                                }
                            }
                        }
                    ?>
                </div>
            </aside>
            <article>
                <div class="articleUp">
                    <form action="" method="post">
                        <input class="btnJogar" name="jogar" id="jogar" type="submit" value="JOGAR">
                    </form>
                    <?php
                        if (isset($_POST['jogar']))
                        {
                            // header ("location: ../game/gameTutorial.php?idAluno=$idAluno");
                            header ("location: ../game/gameTutorial.php?idAluno=$idAluno");
                        }
                    ?>
                </div>
                <div class="articleDown">
                    <div class="hdTabela"><h1>Pontuação</h1></div>  
                    <div class="dadosJogo">
                        <h4>Pŕoxima Fase Liberada: Tutorial</h4>
                        <h4>Pontuação: <?php echo $pont?></h4>
                    </div>
                </div>
            </article>
        </section>
        <?php require_once("../parte/footer.php");?>
    </body>
</html>