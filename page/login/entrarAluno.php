<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/molde.css">
    <link rel="stylesheet" href="../css/stEntrarMolde.css">
    <title>Entrar - Aluno</title>
</head>
<body>
    <!-- HEADER -->
    <?php require_once("../header.php");?>
    <section>
            <article class="logAluno">
                <h2>LOGIN ALUNO</h2>
                <form action="" method="post" name="fmrLogAluno" id="fmrLogAluno">
                    <!-- Campo de Informações -->
                    <input type="text" name="emailLogAluno" id="emailLogAluno" placeholder="E-mail" class="boxLogin">
                    <input type="password" name="senhaLogAluno" id="senhaLogAluno" placeholder="Senha" class="boxLogin">
                    <!-- Botão Login -->
                    <input type="submit" value="ENTRAR" class="btnLogin">
                </form>
                <p>Não tem conta? <a href="cadAluno.php">&nbsp;&nbsp;Cadastre-se já!&nbsp;&nbsp;</a></p>
            </article>
        </section>
    <!-- FOOTER -->
    <?php require_once("../footer.php");?>
</body>
</html>