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

        $dadosAluno = $a->consultarAluno($idAluno);
        if ($dadosAluno->rowCount() != 0)
        {
            while ($row=$dadosAluno->fetch())
            {
                $nomeAluno = $row['nomeAluno'];
                $emailAluno = $row['emailAluno'];
                $FK_idTurma = $row['FK_idTurma'];
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
                    <h4><?php echo "Id do Aluno: $idAluno"?></h4>
                    <h4><?php echo "Turma: $anoTurma"." "."$letraTurma"?></h4>
                    <h4><?php echo "ID Turma: $idTurma"?></h4>
                </div>
            </aside>
            <article></article>
        </section>
        <?php require_once("../parte/footer.php");?>
    </body>
</html>