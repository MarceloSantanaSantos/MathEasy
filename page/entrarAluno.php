<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro - Aluno</title>
    </head>
    <body>
        <header></header>
        <section>
            <article class="logAluno">
                <form action="" method="post" name="fmrLogAluno" id="fmrLogAluno">
                    <!-- Campo de Informações -->
                    <input type="text" name="emailAluno" id="emailLogAluno" placeholder="E-mail">
                    <input type="text" name="senhaAluno" id="senhaLogAluno" placeholder="Senha">
                    <!-- Botão Login -->
                    <a href="#" onclick="logarAluno('logarAluno');">Entrar</a>
                </form>
            </article>
            <article class="cadAluno">
                <form action="" method="post" name="fmrCadAluno" id="fmrCadAluno">
                    <!-- Campos de Informações -->
                    <input type="text" name="nomeAluno" id="nomeAluno" placeholder="Nome Completo">
                    <input type="text" name="emailAluno" id="emailAluno" placeholder="E-mail">
                    <input type="text" name="senhaAluno" id="senhaAluno" placeholder="Senha">
                    <input type="text" name="senhaAlunoC " id="senhaAlunoC" placeholder="Confirmar Senha">
                    <!-- Botão Cadastro -->
                    <a href="#" onclick="cadastrarAluno('cadastrarAluno');">Cadastrar</a>
                </form>
                <div>
                    <?php echo $msgAluno; ?>
                </div>
            </article>
        </section>
    </body>
</html>

<script src="../script/scriptEntrar.js"></script>