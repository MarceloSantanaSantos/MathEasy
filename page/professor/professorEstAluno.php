<?php
    session_start();
    if (!isset($_SESSION['idProf']) && !isset($_SESSION['IdEscolaTurma']))
    {
        header ("location: entrarProfessor.php");
        exit;
    }
    else
    {
        require_once("../../class/clsProfessor.class.php");
        require_once("../../class/clsEscola.class.php");
        require_once("../../class/clsTurma.class.php");
        require_once("../../class/clsAluno.class.php");

        $u = new professor;
        $o = new escola;
        $t = new turma;
        $a = new aluno;

        $idProf = $_SESSION['idProf'];

        $u->conectar("matheasy", "localhost", "root", "root");
        $dadosProfessor = $u->consultarProfessor($idProf);
        if ($dadosProfessor->rowCount() != 0)
        {
            while ($row=$dadosProfessor->fetch())
            {
                $nomeProfessor = $row['nomeProf'];
                $emailProfessor = $row['emailProf'];
            }
        }

        $o->conectar("matheasy", "localhost", "root", "root");
        $dadosEscola = $o->consultarEscola($idProf);
        if ($dadosEscola->rowCount() != 0)
        {
            while ($row=$dadosEscola->fetch())
            {
                $idEscola = $row['idEscola'];
                $nomeEscola = $row['nomeEscola'];
                $cidadeEscola = $row['cidadeEscola'];
            }
        }

        $idAluno = $_GET['idAluno'];
        $a->conectar("matheasy", "localhost", "root", "root");
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

        $idTurma = $_GET['idTurma'];
        $sqlTotalTurma = $u->consultarAlunoTurma($idTurma);
        $totalAlunos = $sqlTotalTurma->rowCount();

        $t->conectar("matheasy", "localhost", "root", "root");
        $dadosTurma = $t->consultarTurma($idEscola, $idProf);
        if ($dadosTurma->rowCount() >0)
        {
            while ($row=$dadosTurma->fetch())
            {
                $ano = $row['ano'];
                $letra = $row['letra'];
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
    <link rel="stylesheet" href="../../css/stEstAluno.css">
    <title>Professor - Estatísticas</title>
</head>
<body>
    <?php require_once("../parte/headerLogadoProf.php");?>
    <div class="hdProfessor">
        <h2>Estatísticas Aluno</h2>
    </div>
    <section>
        <aside>        
            <div class="Escola">
                <h3>Dados da Escola</h3>
                <div class="ptUp">
                <h4>Nome Escola:<?php echo $nomeEscola?></h4>
                <h4>Id da Escola: <?php echo "#$idEscola"?></h4>
                <h4>Cidade: <?php echo $cidadeEscola?></h4>
                </div>
                <h3>Dados da Turma</h3>
                <div class="ptDown">
                <h4>Turma: <?php echo "$anoTurma - $letraTurma"?></h4>
                <h4>Id da Turma: <?php echo "#$idTurma"?></h4>
                <h4>Quantidade de Alunos: <?php echo $totalAlunos?></h4>
                </div>
            </div>
        </aside>
        <aside>
            <div class="Aluno">
                <h3>Dados do Aluno</h3>
                <div class="ptUp">
                    <h4>Nome Aluno:<?php echo $nomeAluno?></h4>
                    <h4>E-mail: <?php echo $emailAluno?></h4>
                    <h4>Id do Aluno: <?php echo "#$idAluno"?></h4>
                </div>
                <h3>Dados do Jogo</h3>
                <div class="ptDown">
                    <h4>Pontuação: </h4>
                    <h4>Fase: </h4>
                    <h4>Ultima vez que jogou: </h4>
                </div>
            </div>
        </aside>
    </section>
    <?php require_once("../parte/footer.php");?>
</body>
</html>