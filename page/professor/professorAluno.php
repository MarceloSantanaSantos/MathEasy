<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/molde.css">
    <link rel="stylesheet" href="../../css/stProfessorAlunos.css">
    <title>Professor - Alunos</title>
</head>
<body>
    <?php require_once("../parte/headerLogadoProf.php");?>
    <div class="hdProfessor">
        <h2>Turma: <?php echo "$anoTurma"." "."$letraTurma"; ?></h2>
    </div>
    <section>
        <aside>
            <div class="ptAside1">
                <h3>Perfil Professor</h3>
            </div>
            <div class="ptAside2">
                <div class="user">
                    <img src="../../img/user.png">
                </div>
            </div>
            <div class="ptAside3">
                <h4>Nome: <?php echo $nomeProfessor;?></h4>
                <h4>Id Professor: <?php echo $idProf;?></h4>
            </div>
            <div class="ptAside4">
                <h3>Dados Turma</h3>
            </div>
            <div class="ptAside5">
                <h4>Turma: <?php echo "$anoTurma"." "."$letraTurma";?></h4>
                <h4>Quantidade de Alunos: <?php echo $totalAlunos;?></h4>
            </div>
        </aside>
        <article>
            <table>
                <?php
                    echo "<tr>
                            <th>NOME:</th>
                            <th>ID ALUNO:</th>
                            <th>IR PARA:</th>
                         </tr>";
                ?>
            </table>
        </article>
    </section>
    <?php require_once("../parte/footer.php");?>
</body>
</html>