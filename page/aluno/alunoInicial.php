<?php
    session_start();
    if (!isset($_SESSION['idProf']))
    {
        header ("location: ../login/entrarAluno.php");
        exit;
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno - Inicial</title>
</head>
<body>
    <h1>Aluno com turma!</h1>
    <?php
        echo "Turma:$idTurma"."<br>"."Nome do Aluno: $nomeAluno"."<br>"."Id do Aluno:$idAluno";
    ?>
</body>
</html>