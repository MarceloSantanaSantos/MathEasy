<?php
     session_start();
     if (!isset($_SESSION['idProf']))
     {
         header ("location: entrarProfessor.php");
         exit;
     }
     else 
     {
        // ############### INFORMAÇÕES CLASSES ###############
        require_once("../class/clsProfessor.class.php");
        $u = new professor;
        require_once("../class/clsEscola.class.php");
        $o = new escola;
        require_once("../class/clsTurma.class.php");
        $t = new turma;


        // ############### REQUISIÇÕES PROFESSOR ###############
        $nomeProfessor = "";
        $idProf = $_SESSION['idProf'];
        $t->conectar("matheasy","localhost","root","root");
        if ($t->msgErro == "")
        {
            $nomeProfessor = $u->perfilProfessor($idProf);
        }
        
     }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/molde.css">
        <link rel="stylesheet" href="../css/stProfessorTurma.css">
        <title>Math Easy - Turmas</title>
    </head>
    <body>
        <?php require_once("headerLogado.php") ?>
        <div class="hdProfessor">
            <h2>Professor - Sessão Turmas</h2>
        </div>
        <section>
        <aside>
                    <div class="ptAside1">
                        <h3>Gestão do Professor</h3>
                    </div>
                    <div class="ptAside2">
                        <div class="user">
                            <img src="../img/user.png" alt="">
                        </div>
                    </div>
                    <div class="ptAside3">
                        <h4>Nome: <?php echo $nomeProfessor;?></h4>
                        <h5>ID Professor: <?php echo $idProf?></h5>
                    </div>
                    <!-- Formulário de Gerenciamento de Turma -->
                    <div class="ptAside4">
                        <form action="" method="POST" id="fmrProfTur" name="fmrProfTur" >
                            <h3>Gerenciar Turmas</h3>
                            <!-- Campo de Informações -->
                            <input type="text" id="nomeTurma" name="nomeTurma" placeholder="Turma">
                            <input type="text" id="escolaTurma" name="escolaTurma" placeholder="Escola">
                            <!-- Botões Gerenciar Escola -->
                            <div class="gerenciarTurma">
                                <input type="submit" value="Adicionar" name="add" class="btnTurma">
                                <input type="submit" value="Remover" name="rmv" class="btnTurma">
                            </div>
                        </form>
                    </div>
                        <div class="msgTurma">
                            <?php
                                //############### ADICIONAR TURMA ###############
                                if (isset($_POST['add'])) 
                                {
                                    $turma = addslashes($_POST['nomeTurma']);
                                    $escolaTurma = addslashes($_POST['escolaTurma']);
                                    if (!empty($turma) && !empty($escolaTurma)) 
                                    {
                                        $t->conectar("matheasy", "localhost", "root", "root");
                                        if ($t->msgErro == "") 
                                        {
                                            if ($t->cadastrarTurma($turma, $escolaTurma, $idProf))
                                            {
                                                echo "<script language='javascript' type='text/javascript'>
                                                    alert('Turma adicionada com sucesso');
                                                </script>";
                                                header ("location: professorTurma.php");
                                            }
                                            else 
                                            {
                                                ?>
                                                    <?php echo "*Turma já cadastrada";?>
                                                <?php
                                            }
                                        }
                                    }
                                    else 
                                    {
                                        header ("location: professorTurma.php");
                                    }
                                }
                                if (isset($_POST['rmv'])) 
                                {
                                    $turma = addslashes($_POST['nomeTurma']);
                                    $escolaTurma = addslashes($_POST['escolaTurma']);
                                    if (!empty($turma) && !empty($escolaTurma))
                                    {
                                        $t->conectar("matheasy", "localhost", "root", "root");
                                        if ($t->msgErro == "")
                                        {
                                            if ($t->removerTurma($turma, $escolaTurma, $idProf))
                                            {
                                                header ("location: professorTurma.php");
                                            }
                                            else 
                                            {
                                                    echo "*Turma não cadastrada";
                                            }
                                        }
                                    }
                                    else 
                                    {
                                        echo "<script language='javascript' type='text/javascript'>
                                        alert ('Preencha os campos');
                                        </script>";
                                        header ("location: professorTurma.php");
                                    }
                                }
                            ?>
                        </div>
                </aside>
                <article>
                    <table>
                        <?php
                            echo "<tr>
                                    <th>TURMA:</th>
                                    <th>ESCOLA:</th>
                                    <th>IR PARA:</th>
                                </tr>";
                            $t->conectar("matheasy", "localhost", "root", "root");
                            if ($t->msgErro == "") 
                            {
                                $turmas = $t->consultarTurma($idProf);

                                if ($turmas->rowCount() != 0)
                                {
                                    while ($row=$turmas->fetch())
                                    {
                                        echo "<tr>".
                                                "<td>".$row['turma']."</td>".
                                                "<td>".$row['escolaTurma']."</td>".
                                                "<td>"."<a class='verSalas' href='professorSala.php'>Ver Sala</a>"."</td>".
                                            "</tr>";
                                    }
                                }
                                else
                                {
                                    echo "Fail";
                                }
                            }
                        ?>
                    </table>
                </article>
        </section>
        <?php require_once("footer.php"); ?>
    </body>
</html>