<?php
    session_start();
    if (!isset($_SESSION['idProf']))
    {
        header ("location: entrarProfessor.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/molde.css">
    <link rel="stylesheet" href="../css/stProfessorEscola.css">
    <title>Math Easy - Escolas</title>
</head>
    <body>
        <?php require_once("header.php") ?>
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
                        <img src="../img/eu.jpg" alt="">
                    </div>
                </div>
                <div class="ptAside3">
                    <h4><?php echo $nomeProfessor;?></h4>
                    <h5>Número de Escolas: <?php echo $total;?></h5>
                </div>
                <div class="ptAside4">
                    <form action="" method="post" id="fmrProfEsc" name="fmrProfEsc" >
                        <h3>Adicionar Nova Escola</h3>
                        <!-- Campo de Informações -->
                        <input type="text" id="nomeEscola" name="nomeEscola" placeholder="Nome da Escola">
                        <input type="text" id="cidadeEscola" name="cidadeEscola" placeholder="Cidade">
                        <!-- Botão Adicionar Escola -->
                        <a href="#" onclick="adicionarEscola('adicionarEscola');">Adicionar</a>
                    </form>
                </div>
            </aside>
            <article>
                <table>
                    <?php
                        echo "<tr>
                                <th>NOME ESCOLA:</th>
                                <th>CIDADE:</th>
                             </tr>";
                    ?>
                </table>
            </article>
        </section>
        <?php require_once("footer.php") ?>
    </body>
</html>

<script src="../script/scriptEscola.js"></script>