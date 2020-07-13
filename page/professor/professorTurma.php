<?php
     session_start();
     if (!isset($_SESSION['idProf']) && !isset($_SESSION['IdEscolaTurma']))
     {
         header ("location: entrarProfessor.php");
         exit;
     }
     else 
     {
        // ############### INFORMAÇÕES CLASSES ###############
        require_once("../../class/clsProfessor.class.php");
        $u = new professor;
        require_once("../../class/clsEscola.class.php");
        $o = new escola;
        require_once("../../class/clsTurma.class.php");
        $t = new turma;

        


        // ############### REQUISIÇÕES PROFESSOR ###############
        $nomeProfessor = "";
        $idProf = $_SESSION['idProf'];
        $u->conectar("matheasy","localhost","root","root");
        if ($u->msgErro == "")
        {
            $nomeProfessor = $u->perfilProfessor($idProf);
        }
        

        // ############### REQUISIÇÕES ESCOLA ###############
        $idEscolaTurma = $_GET['idEscolaTurma'];
        $nomeEscolaTurma = $_GET['nomeEscolaTurma'];      
     }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/molde.css">
        <link rel="stylesheet" href="../../css/stProfessorTurma.css">
        <title>Math Easy - Turmas</title>
    </head>
    <body>
        <?php require_once("../parte/headerLogado.php"); ?>
        <div class="hdProfessor">
            <h2>Escola: <?php echo $nomeEscolaTurma; ?></h2>
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
                    <!-- Formulário de Gerenciamento de Turma -->
                    <div class="ptAside4">
                        <form method="POST" id="fmrProfTur" name="fmrProfTur" >
                            <h3>Gerenciar Turmas</h3>
                            <!-- Campo de Informações -->
                            <input type="text" id="ano" name="ano" placeholder="Ano">
                            <input type="text" id="letra" name="letra" placeholder="Letra">
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
                                    $ano = addslashes($_POST['ano']);
                                    $letra = addslashes($_POST['letra']);
                                    if (!empty($ano) && !empty($letra)) 
                                    {
                                        $t->conectar("matheasy", "localhost", "root", "root");
                                        if ($t->msgErro == "") 
                                        {
                                            if ($t->cadastrarTurma($ano, $letra, $idProf, $idEscolaTurma))
                                            {
                                                header("Refresh: 0");
                                            }
                                            else 
                                            {
                                                ?>
                                                    <?php echo "*Turma já cadastrada";?>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                if (isset($_POST['rmv'])) 
                                {
                                    $ano = addslashes($_POST['ano']);
                                    $letra = addslashes($_POST['letra']);
                                    if (!empty($ano) && !empty($letra))
                                    {
                                        $t->conectar("matheasy", "localhost", "root", "root");
                                        if ($t->msgErro == "")
                                        {
                                            if ($t->removerTurma($ano, $letra, $idProf, $idEscolaTurma))
                                            {
                                                header("Refresh: 0");
                                            }
                                            else 
                                            {
                                                ?>
                                                    <?php echo "*Turma não cadastrada";?>
                                                <?php
                                            }
                                        }
                                    }
                                    else 
                                    {
                                        echo "*Preencha os campos";
                                    }
                                }
                            ?>
                        </div>
                </aside>
                <article>
                    <table>
                        <?php
                            echo "<tr>
                                    <th>ANO:</th>
                                    <th>LETRA:</th>
                                    <th>IR PARA:</th>
                                </tr>";
                            $t->conectar("matheasy", "localhost", "root", "root");
                            if ($t->msgErro == "") 
                            {
                                $turmas = $t->consultarTurma($idEscolaTurma, $idProf);

                                if ($turmas->rowCount() != 0)
                                {
                                    while ($row=$turmas->fetch())
                                    {
                                        
                                        echo "<tr>".
                                                "<td>".$row['ano']."</td>".                                                
                                                "<td>".$row['letra']."</td>".                                                
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
    </body>
</html>