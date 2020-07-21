<?php
    session_start();
    if (!isset($_SESSION['idAluno']))
    {
        header ("location: ../login/entrarAluno.php");
    }
    else 
    {
        require_once("../../class/clsEscola.class.php");
        require_once("../../class/clsTurma.class.php");
        require_once("../../class/clsAluno.class.php");
        $o = new escola;
        $t = new turma;
        $a = new aluno;

        $idAluno = $_SESSION['idAluno'];
        $nomeAluno = "";
        $emailAluno = "";
        $a->conectar("matheasy", "localhost", "root", "root");
        $dadosAluno = $a->consultarAluno($idAluno);
        if ($dadosAluno->rowCount() != 0)
        {
            while ($row=$dadosAluno->fetch())
            {
                $nomeAluno = $row['nomeAluno'];
                $emailAluno = $row['emailAluno'];
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
    <link rel="stylesheet" href="../../css/stAlunoVazio.css">
    <title>Aluno - Inicial</title>
</head>
<body>
    <?php require_once("../parte/headerLogadoAluno.php");?>
    <div class="hdAluno">
        <h2>Aluno -  Sem Turma Registrada</h2>
    </div>
    <section>
        <!--=====PERFIL DO ALUNO=====-->
        <aside>
            <div class="ptAside1">
                <h3>Perfil do aluno</h3>
            </div>
            <div class="ptAside2">
                <div class="user">
                    <img src="../../img/user.png" alt="">
                </div>
            </div>
            <div class="ptAside3">
                <h4>Nome: <?php echo $nomeAluno;?></h4>
                <h4>ID Aluno: <?php echo "#$idAluno"?></h4>
                <h4>E-mail: <?php echo $emailAluno?></h4>
            </div>
        </aside>
        <article>
            <div class="ptAside4">
                <h3>Entrar em Turma</h3>
                <form action="" method="post">
                    <input type="text" id="addTurmaId" name="addTurmaId" placeholder="Id da Turma" class="boxTurma" maxlength='5'>    
                    <input type="text" id="addTurmaAno" name="addTurmaAno" placeholder="Ano" class="boxTurma" maxlength='1'>
                    <input type="text" id="addTurmaLetra" name="addTurmaLetra" placeholder="Letra" class="boxTurma" maxlength='1'>
                    <input type="submit" id="add" name="add" class="btnTurma" value="Adicionar">
                </form>
                <div class="msgTurma">
                    <?php
                        // Verificar se o botão foi clicado
                        if (isset($_POST['add']))
                        {
                            $addTurmaId = addslashes($_POST['addTurmaId']);
                            $addTurmaAno = addslashes($_POST['addTurmaAno']);
                            $addTurmaLetra = addslashes($_POST['addTurmaLetra']);
                            if (!empty($addTurmaId) && !empty($addTurmaAno) && !empty($addTurmaLetra))
                            {
                                $a->conectar("matheasy", "locahost", "root", "root");
                                if ($a->msgErro == "")
                                {
                                    if ($a->consultarTurmaAdd($addTurmaId, $addTurmaAno, $addTurmaLetra))
                                    {
                                        echo "*Turma não registrada";
                                    }
                                    else 
                                    {
                                        if ($a->updateIdTurma($addTurmaId, $idAluno))
                                        {
                                            echo "<script language='javascript' type='text/javascript'>
                                                alert('Aluno entrou em uma turma!');
                                                window.location.href='alunoInicial.php';
                                              </script>";
                                        }
                                        
                                    }
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </article>
    </section>
    <?php require_once("../parte/footer.php");?>
</body>
</html>