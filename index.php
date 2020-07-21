<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/icon.ico">
    <link rel="stylesheet" href="./css/molde.css">
    <link rel="stylesheet" href="./css/stIndex.css">
    <title>Math Easy - Início</title>
    <style> .ativado { color: white;} </style>
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="hd-left">           
            <a href="page/processamento/sair.php">
                <img src="img/icon.png">
                <span><strong>MATH<br>EASY</strong></span>
            </a>
        </div>
        <div class="hd-right">
            <a href="index.php">Início</a>
            <a href="index.php#sobrenos">Sobre Nós</a>
        </div>
    </header>
    <!-- SECTION 01 -->
    <section class="secOne">
        <div class="scOne-left">
            <h1>
                Aprenda matemática mais facilmente
            </h1>
            <p>
                Conheça uma forma mais intuitiva, dinâmica e divertida de aprender matemática. O Math Easy te ensinará matemática enquanto você se diverte.</p>
            <div>
                <a href="./page/login/entrarProfessor.php" class="btnIndex">Sou Professor</a>
                <a href="./page/login/entrarAluno.php" class="btnIndex">Sou Aluno</a>
            </div>
        </div>
        <div class="scOne-right">
            <img src="./img/calc.png">
        </div>
    </section>
    <!-- SECTION 02 -->
    <section class="secTwo">
        <div class="scTwo-left">
            <img src="./img/comp.png">
        </div>
        <div class="scTwo-right">
            <div class="scTwoContentText">
                <h1>
                    Você aprenderá matérias como:
                </h1>
                <h3>
                    Soma - Fração - Divisão - Multiplicação
                </h3>
                <p>
                    Sente dificuldade em aprender matemática apenas copiando contas da lousa e sentando em uma carteira?
                    <br>
                    Entenda como a matemática funciona enquanto mata dragões, esqueletos e até zumbis! Aprender matemática nunca foi tão fácil.
                </p>
            </div>
        </div>
    </section>
    <!-- SECTION 03 -->
    <section class="secThree">
        <div class="scThree-up">
            <h1 id="sobrenos" >Sobre o Projeto Math Easy</h1>
        </div>
        <div class="scThree-down">
            <p>
            Após muitas pesquisas, foi constatado que o brasileiro uma enorme deficiência em matemática, e descobriram a origem da mesma. Sete de cada dez alunos do 3º ano do Ensino Médio têm nível insuficiente em português e matemática. Entre os estudantes desta etapa de ensino, menos de 4% têm conhecimento adequado nestas disciplinas. É o que mostram os dados do Sistema de Avaliação da Educação Básica (Saeb) 2017 divulgados pelo Ministério da Educação (MEC).
            <br><br>
            A iniciativa do Math Easy é focada na melhoria e facilidade no aprendizado, ensinar os alunos com uma ferramenta intuitiva, dinâmica, divertida e que faz com que o aluno se interesse pela matéria. Utilizando de mini jogos, a diversão que o aluno tem em casa é trazida para a escola, uma tática para ter o aluno mais focado e interessado em aprender matemática, fugindo daquela tradicionalidade "desmotivante". Uma nova geração necessita de novos métodos.
            <br><br>
            O Math Easy deseja melhorar a situação do ensino brasileiro, melhorar a sua qualidade para uma possível expansão para outras matérias como história, geografia, física e por aí vai. Trazer o “futuro” para as escolas como uma nova didática, inovar o que já nos é passado a centenas de anos. Com um foco maior no ensino público, será adotado apenas pelos professores que optarem o plano Math Easy, totalmente opcional. Aprenda uma matemática diferente, uma matemática fácil.
            </p>
        </div>
    </section>
    <!-- FOOTER -->
    <?php require_once("./page/parte/footer.php")?>
</body>
</html>