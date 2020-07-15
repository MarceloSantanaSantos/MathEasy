<?php
    session_start();
    if (!isset($_SESSION['idProf']))
    {
        header ("location: ../login/entrarProfessor.php");
        exit;
    }
    else 
    {
        // ############### INFORMAÇÕES CLASSES ###############

        require_once("../../class/clsProfessor.class.php");
        $u = new professor;
        require_once("../../class/clsEscola.class.php");
        $o = new escola;

        // ############### REQUISIÇÕES PROFESSOR ###############

        $nomeProfessor = "";
        $idProf = $_SESSION['idProf'];
        $u->conectar("matheasy", "localhost", "root", "root");
        if ($u->msgErro == "")
        {
            $nomeProfessor = $u->perfilProfessor($idProf);
        }
        else {
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/molde.css">
    <link rel="stylesheet" href="../../css/stProfessorEscola.css">
    <title>Math Easy - Escolas</title>
</head>
    <body>
        <?php require_once("../parte/headerLogadoProf.php"); ?>
        <div class="hdProfessor">
            <h2>Professor - Sessão Escolas</h2>
        </div>
        <section>
            <aside>
                <div class="ptAside1">
                    <h3>Gestão do Professor</h3>
                </div>
                <div class="ptAside2">
                    <div class="user">
                        <img src="../../img/user.png" alt="">
                    </div>
                </div>
                <div class="ptAside3">
                    <h4>Nome: <?php echo $nomeProfessor;?></h4>
                    <h5>ID Professor: <?php echo $idProf?></h5>
                </div>
                <!-- Formulário de Gerenciamento de Escolas -->
                <div class="ptAside4">
                    <form action="" method="POST" id="fmrProfEsc" name="fmrProfEsc" >
                        <h3>Gerenciar Escolas</h3>
                        <!-- Campo de Informações -->
                        <input type="text" id="nomeEscola" name="nomeEscola" placeholder="Nome da Escola">
                        <input type="text" id="cidadeEscola" name="cidadeEscola" placeholder="Cidade">
                        <!-- Botões Gerenciar Escola -->
                        <div class="gerenciarEscola">
                            <input type="submit" value="Adicionar" name="add" class="btnEscola">
                            <input type="submit" value="Remover" name="rmv" class="btnEscola">
                        </div>
                    </form>
                </div>
                    <div class="msgEscola">
                        <?php
                            //############### ADICIONAR ESCOLA ###############
                            if (isset($_POST['add'])) 
                            {
                                $nomeEscola = addslashes($_POST['nomeEscola']);
                                $cidadeEscola = addslashes($_POST['cidadeEscola']);
                                if (!empty($nomeEscola) && !empty($cidadeEscola)) 
                                {
                                    $o->conectar("matheasy", "localhost", "root", "root");
                                    if ($o->msgErro == "") 
                                    {
                                        if ($o->cadastrarEscola($nomeEscola, $cidadeEscola, $idProf))
                                        {
                                            header("location: professorEscola.php");
                                        }
                                        else 
                                        {
                                            ?>
                                                <?php echo "*Escola já cadastrada";?>
                                            <?php
                                        }
                                    }
                                }
                                else 
                                {
                                    echo "<script language='javascript' type='text/javascript'>
                                    alert ('Preencha os campos');
                                    window.location('professorEscola.php');
                                    </script>";
                                }
                            }
                            //############### REMOVER ESCOLA ###############
                            if (isset($_POST['rmv'])) 
                            {
                                $nomeEscola = addslashes($_POST['nomeEscola']);
                                $cidadeEscola = addslashes($_POST['cidadeEscola']);
                                if (!empty($nomeEscola) && !empty($cidadeEscola))
                                {
                                    $o->conectar("matheasy", "localhost", "root", "root");
                                    if ($o->msgErro == "")
                                    {
                                        if ($o->removerEscola($nomeEscola, $cidadeEscola, $idProf))
                                        {
                                            header("Refresh: 0");
                                        }
                                        else 
                                        {
                                            ?>
                                                <?php echo "*Escola não cadastrada";?>
                                            <?php
                                        }
                                    }
                                }
                                else 
                                {
                                    echo "<script language='javascript' type='text/javascript'>
                                    alert ('Preencha os campos');
                                    window.location('professorEscola.php');
                                    </script>";
                                }
                            }
                        ?>
                    </div>
            </aside>
            <!-- Tabela de Escolas -->
            <article>
                <table>
                    <?php
                        echo "<tr>
                                <th>NOME ESCOLA:</th>
                                <th>CIDADE:</th>
                                <th>CÓDIGO ESCOLA:</th>
                                <th>VER TURMAS:</th>
                             </tr>";
                        $o->conectar("matheasy", "localhost", "root", "root");
                        if ($o->msgErro == "") 
                        {
                            $escolas = $o->consultarEscola($idProf);

                            if ($escolas->rowCount() != 0)
                            {
                                while ($row=$escolas->fetch())
                                {
                                    $idEscolaTurma = $row['idEscola'];
                                    $nomeEscolaTurma = $row['nomeEscola'];
                                    echo "<tr>".
                                            "<td>".$row['nomeEscola']."</td>".
                                            "<td>".$row['cidadeEscola']."</td>".
                                            "<td>".$row['idEscola']."</td>".
                                            "<td class='verTurmasBG'>"."<a href='professorTurma.php?idEscolaTurma=$idEscolaTurma&nomeEscolaTurma=$nomeEscolaTurma' class='verTurmas'>Ver Turmas</a> </td>".
                                            // "<td>"."<form method='post'><input type='submit' id='vt' name='vt' value='Ver Turmas' class='verTurmas'></form>"."</td>".
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
    </body>
</html>