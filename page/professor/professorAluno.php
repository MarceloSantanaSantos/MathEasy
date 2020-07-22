<?php
    session_start();
    if (!isset($_SESSION['idProf']))
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
        if ($dadosProfessor->rowCount() > 0)
        {
            while ($row=$dadosProfessor->fetch())
            {
                $nomeProfessor = $row['nomeProf'];
                $emailProfessor = $row['emailProf'];
            }
        }
        $o->conectar("matheasy", "localhost", "root", "root");
        $dadosEscola = $o->consultarEscola($idProf);
        if ($dadosEscola->rowCount() > 0)
        {
            while ($row=$dadosEscola->fetch())
            {
                $idEscola = $row['idEscola'];
                $nomeEscola = $row['nomeEscola'];
                $cidadeEscola = $row['cidadeEscola'];
            }
        }

        $idTurma = $_GET['idTurma'];

        $sqlTotalTurma = $u->consultarAlunoTurma($idTurma);
        $totalAlunos = $sqlTotalTurma->rowCount();

        $idTurma = $_GET['idTurma'];
        $t->conectar("matheasy", "localhost", "root", "root");
        $sqlTurma = $t->consultarTurma($idEscola, $idProf);
        if ($sqlTurma->rowCount() > 0)
        {
            while ($row=$sqlTurma->fetch())
            {
                $ano = $row['ano'];
                $letra = $row['letra'];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/molde.css">
    <link rel="stylesheet" href="../../css/stProfessorAluno.css">
    <title>Professor - Alunos</title>
</head>
<body>
    <?php require_once("../parte/headerLogadoProf.php");?>
    <div class="hdProfessor">
        <h2>Turma: <?php echo "$ano"." "."$letra"; ?></h2>
    </div>
    <section>
        <aside>
            <div class="ptProf">
                <div class="ptAside1">
                    <h3>Perfil do Professor</h3>
                </div>
                <div class="ptAside2">
                    <div class="user">
                        <img src="../../img/user.png">
                    </div>
                </div>
                <div class="ptAside3">
                    <h4><?php echo $nomeProfessor;?></h4>
                    <h5>Id: <?php echo "#$idProf";?></h5>
                    <h5><?php echo $emailProfessor;?></h5>
                </div>
            </div>
            <div class="ptTurma">
                <div class="ptAside4">
                    <h3>Dados Turma</h3>
                </div>
                <div class="ptAside5">
                    <h4>Turma: <?php echo "$ano"." "."$letra";?></h4>
                    <h4>Id: <?php echo "#$idTurma"?></h4>
                    <h4>Quantidade de Alunos: <?php echo $totalAlunos;?></h4>
                </div>
            </div>
        </aside>
        <article>
            <table>
                <?php
                    echo "<tr>
                            <th>NOME:</th>
                            <th>ID ALUNO:</th>
                            <th>E-MAIL ALUNO:</th>
                            <th>IR PARA:</th>
                         </tr>";
                    $a->conectar("matheasy", "localhost", "root", "root");
                    if ($a->msgErro == "")
                    {
                        $alunos = $a->consultarAlunoTurma($idTurma);
                        if ($alunos->rowCount() > 0)
                        {
                            while ($row=$alunos->fetch())
                            {
                                $idAluno = $row['idAluno'];
                                $nomeAluno = $row['nomeAluno'];
                                $emailAluno = $row['emailAluno'];
                                echo "<tr>".
                                        "<td>".$nomeAluno."</td>".
                                        "<td>".$idAluno."</td>".
                                        "<td>".$emailAluno."</td>".
                                        "<td>".
                                            "<a href='professorEstAluno.php?idAluno=$idAluno&idTurma=$idTurma' class='verAluno'>Ver Aluno</a>".
                                        "</td>".
                                     "</tr>";
                            }
                        }
                    }
                ?>
            </table>
        </article>
    </section>
    <?php require_once("../parte/footer.php");?>
</body>
</html>