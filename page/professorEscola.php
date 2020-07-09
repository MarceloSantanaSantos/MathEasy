<?php 
    $msgEscola = "";

    require_once("../dbase/dbconn.php");
    require_once("../class/clsBancoDados.class.php");
    require_once("../class/clsProfessor.class.php");
    require_once("../class/clsEscola.class.php");

    // definições de host, database, usuário e senha
    $host = "localhost";
    $db   = "matheasy";
    $user = "root";
    $pass = "root";

    // conecta ao banco de dados
    $con = mysqli_connect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 
    $con = mysqli_connect($host,$user,$pass, $db);

    // seleciona a base de dados em que vamos trabalhar
    mysqli_select_db($con,$db);

    // Variáveis Escola
    $idEscola = "";
    $nomeEscola = "";
    $cidadeEscola = "";

    // Dados Professor
    $login = $_POST['emailProfessor'];
    $login = $_POST['senhaProfessor'];

    
    if ($_POST) {
        $acaoProfessor = "";

        // Verificando se o parẫmetro acaoProfessor existe na URL
        if (isset($_REQUEST["acaoProfessor"])) {
            $acaoProfessor = $_REQUEST["acaoProfessor"];
        }

        // Criando objeto para representar classe escola
        $objEscola  = new escola();

        // Recuperar todos os dados que o usuário digitou e enviando para os atributos da classe escola
        $objEscola->nomeEscola = $_REQUEST["nomeEscola"];
        $objEscola->cidadeEscola = $_REQUEST["cidadeEscola"];
        
        // Verificar qual o parâmetro acaoProfessor
        if ($acaoProfessor == 'adicionarEscola') {
            if ($objEscola->getGravarEscola()) {
                echo    "<script language='javascript' type='text/javascript'>
                            alert ('Escola cadastrada com sucesso.');
                            window.location.href='../page/professorEscola.php'
                        </script>";
            }
            else {
                $msgEscola = $objEscola->getErro();
            }
        }
    }

    $query = sprintf("select nomeEscola, cidadeEscola from escola");
    $dados = mysqli_query($con, $query) or die(mysql_error());
    $linha = mysqli_fetch_assoc($dados);
    $total = mysqli_num_rows($dados);

    $queryProf = sprintf("select nomeProf from professor where")
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
                        if ($total > 0) {
                            do {
                    ?>
                                <tr>
                                    <td><?=$linha['nomeEscola']?></td>
                                    <td><?=$linha['cidadeEscola']?></td>
                                </tr>
                    <?php
                                // finaliza o loop que vai mostrar os dados
                                }while($linha = mysqli_fetch_assoc($dados));
                        // fim do if 
                        }
                        ?>
                </table>
            </article>
        </section>
        <?php require_once("footer.php") ?>
    </body>
</html>

<script src="../script/scriptEscola.js"></script>