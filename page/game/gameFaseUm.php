<?php
    session_start();
    if (!isset($_SESSION['idAluno']))
    {
        header ("location: ../login/entrarAluno.php");
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

        $dadosAluno = $a->consultarAluno($idAluno);
        if ($dadosAluno->rowCount() != 0)
        {
            while ($row=$dadosAluno->fetch())
            {
                $nomeAluno = $row['nomeAluno'];
                $emailAluno = $row['emailAluno'];
                $FK_idTurma = $row['FK_idTurma'];
            }
        }

        $dadosTurma = $a->dadosTurma($FK_idTurma);
        while ($row=$dadosTurma->fetch())
        {
            $idTurma = $row['idTurma'];
            $anoTurma = $row['ano'];
            $letraTurma = $row['letra'];
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/molde.css">
        <link rel="stylesheet" href="../../css/stJogo.css">
        <link rel="stylesheet" href="../../css/stModalJogo.css">
        <title>Fase 1 - Math Easy</title>
    </head>
    <body>
        <?php require_once("../parte/headerJogo.php");?>
       <div class="hdJogo">
            <h2>Fase: Tutorial - Colete as Estrelas e <strong>NÃO</strong> toque nas bombas!</h2>
        </div> 
        <div class="modal1" id='ModalUm'>
            <div class="modalUm-content">
                <h2>Quanto é 5 * 3 + 10 ?</h2>
                <div class="btns">
                    <button id='certo1' class='certo1'>150</button>
                    <button id='errado1' class='errado1'>130</button>
                </div>
            </div>
        </div>
        <div class="modal2" id='ModalDois'>
            <div class="modalDois-content">
                <h2>Quanto é 4 / 2 * 10 ?</h2>
                <div class="btns">
                    <button id='errado2' class='errado2'>80</button>
                    <button id='certo2' class='certo2'>20</button>
                </div>
            </div>
        </div>
        <div class="modal3" id='ModalTres'>
            <div class="modalTres-content">
                <h2>Qual é a raiz quadrada de 16 ?</h2>
                <div class="btns">
                    <button id='certo3' class='certo3'>4</button>
                    <button id='errado3' class='errado3'>8</button>
                </div>
            </div>
        </div>
        <div class="modalFim" id='ModalFim'>
            <div class="modalFim-content">
                <h2>Muito Bem! O tutorial Acabou!</h2>
                <h3 id="pontuacao">Pontuação: </h3>
                <div class="btns">
                    <button id='voltar' class='voltar'>Voltar</button>
                </div>
            </div>
        </div>
        <div class="modalGO" id='ModalGO'>
            <div class="modalGO-content">
                <h2>Game Over!</h2>
                <div class="btns">
                    <button id='sair' class='sair'>Sair</button>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="../../script/phaser.min.js"></script>
<script>
    var config = {
        type: Phaser.AUTO,
        width: 1000,
        height: 550,
        physics: {
            default: 'arcade',
            arcade: {
                gravity: { y: 400 },
                debug: false
            }
        },
        scene: {
            preload: preload,
            create: create,
            update: update
        }
    };

    var game = new Phaser.Game(config);
    var platforms;
    var score = 0;
    var scoreText;
    var time = 10;
    var timeText;
    var countStar = 3;
    var starText;
    var modal1 = document.getElementById("ModalUm");
    var certo1 = document.getElementsByClassName("certo1")[0];
    var errado1 = document.getElementsByClassName("errado1")[0];
    var modal2 = document.getElementById("ModalDois");
    var certo2 = document.getElementsByClassName("certo2")[0];
    var errado2 = document.getElementsByClassName("errado2")[0];
    var modal3 = document.getElementById("ModalTres");
    var certo3 = document.getElementsByClassName("certo3")[0];
    var errado3 = document.getElementsByClassName("errado3")[0];
    var modalFim = document.getElementById("ModalFim");
    var voltar = document.getElementsByClassName("voltar")[0];
    var modalGO = document.getElementById("ModalGO");
    var sair = document.getElementsByClassName("sair")[0];
    var final = false;
    var cont = 0;
    var pontuacao = document.getElementById("pontuacao");
    

    function preload ()
    {
        this.load.image('sky', '../../script/assets/bg3.png');
        this.load.image('ground', '../../script/assets/plt1.png');
        this.load.image('star', '../../script/assets/star.png');
        this.load.spritesheet('dude', '../../script/assets/dude.png', { frameWidth: 32, frameHeight: 48 });

        this.load.image("dialogo1", "../../script/assets/dialogo1.png");
        this.load.image("resposta1", "../../script/assets/resposta1.png");
        this.load.image("resposta2", "../../script/assets/resposta2.png");
        this.load.image("diamond", "../../script/assets/diamond.png");
        this.load.image("bomb", "../../script/assets/bomb.png");
    }

    function create ()
    {
        
        this.add.image(500, 250, 'sky');

        platforms = this.physics.add.staticGroup();

        platforms.create(1000, 580, 'ground').setScale(4).refreshBody();
        platforms.create(600, 400, 'ground');
        platforms.create(50, 300, 'ground');
        platforms.create(750, 220, 'ground');


        player = this.physics.add.sprite(100, 450, 'dude').setScale(1.2).refreshBody();

        player.setBounce(0.2);
        player.setCollideWorldBounds(true);

        this.anims.create({
            key: 'left',
            frames: this.anims.generateFrameNumbers('dude', { start: 0, end: 3 }),
            frameRate: 10,
            repeat: -1
        });

        this.anims.create({
            key: 'turn',
            frames: [ { key: 'dude', frame: 4 } ],
            frameRate: 20
        });

        this.anims.create({
            key: 'right',
            frames: this.anims.generateFrameNumbers('dude', { start: 5, end: 8 }),
            frameRate: 10,
            repeat: -1
        });

        this.physics.add.collider(player, platforms);

        stars = this.physics.add.group();
        stars.create(50, 200, 'star');
        stars.create(600, 280, 'star');
        stars.create(750, 180, 'star');

        bombs = this.physics.add.group();
        bombs.create(200, 200, 'bomb');
        bombs.create(400, 280, 'bomb');
        bombs.create(600, 180, 'bomb');
        bombs.create(700, 230, 'bomb');


        function hitBomb (player, bomb)
        {
            this.physics.pause();

            player.setTint(0xff0000);

            player.anims.play('turn');

            gameOver = true;
            if (gameOver == true)
            {
                modalGO.style.display = "block";
                sair.onclick = function ()
                {
                    window.location.href="../aluno/alunoInicial.php";
                };
            }
        }

        
        this.physics.add.collider(stars, platforms);
        this.physics.add.overlap(player, stars, collectStar, null, this);
        this.physics.add.collider(bombs, platforms);
        this.physics.add.overlap(player, bombs, hitBomb, null, this);

        scoreText = this.add.text(16, 16, 'Pontuação: 0', { fontSize: '32px', fill: '#ffffff' });
        starText = this.add.text(300, 16, 'Estrelas Restantes: 3', { fontSize: '32px', fill: '#ffffff' })

        function collectStar (player, star)
        {
            if (star.disableBody(true, true))
            {
                countStar--;

                // ==================PRIMEIRA PERGUNTA==================
                if (countStar == 2)
                {
                    starText.setText('Estrelas Restantes: ' + countStar);
                    
                    modal1.style.display = "block";
                    this.scene.pause();
                    certo1.onclick = function() 
                    {
                        score += 10;
                        scoreText.setText('Pontuação: ' + score);
                        modal1.style.display = "none";
                        
                    };
                    errado1.onclick = function() 
                    {
                        modal1.style.display = "none";
                    };
                    this.scene.resume();
                    cont++;
                }

                // ==================SEGUNDA PERGUNTA==================
                else if (countStar == 1)
                {
                    
                    modal2.style.display = "block";
                    this.scene.pause();
                    certo2.onclick = function() 
                    {
                        score += 10;
                        scoreText.setText('Pontuação: ' + score);
                        modal2.style.display = "none";
                        
                    };
                    errado2.onclick = function() 
                    {
                        modal2.style.display = "none";
                    };
                    starText.setText('Estrelas Restantes: ' + countStar);
                    this.scene.resume();
                    cont++;

                }

                // ==================TERCEIRA PERGUNTA==================
                else if (countStar == 0)
                {
                    modal3.style.display = "block";
                    this.scene.pause();
                    certo3.onclick = function() 
                    {
                        score += 10;
                        scoreText.setText('Pontuação: ' + score);
                        modal3.style.display = "none";
                        final = true;
                        cont++;
                        console.log(cont);
                        if (cont == 3)
                        {   
                            pontuacao.innerHTML ="<h3>Pontuação: "+score+"</h3>";
                            console.log(score);
                            modalFim.style.display = "block";
                            voltar.onclick = function ()
                            {   
                                window.location.href = '../aluno/alunoInicial.php?pontuacao='+score;
                            };
                        }
                    };
                    errado3.onclick = function() 
                    {

                        modal3.style.display = "none";
                        final = true;
                        countStar = (countStar-1);
                        cont++;       
                        console.log(cont);
                        if (cont == 3)
                        {   
                            pontuacao.innerHTML ="<h3>Pontuação: "+score+"</h3>";
                            console.log(score);
                            modalFim.style.display = "block";
                            voltar.onclick = function ()
                            {   
                                window.location.href = '../aluno/alunoInicial.php?pontuacao='+score;
                            };
                        }          
                    };
                    
                }
                    
                // var x = (player.x < 400) ? Phaser.Math.Between(400, 800) : Phaser.Math.Between(0, 400);
                // var bomb = bombs.create(x, 16, 'bomb');
                // bomb.setBounce(1);
                // bomb.setCollideWorldBounds(true);
                // bomb.setVelocity(Phaser.Math.Between(-200, 200), 20);
            }
            // ==================MODAL FINAL==================
            
        };
    }

    function update ()
    {
        cursors = this.input.keyboard.createCursorKeys();

    
        if (cursors.left.isDown)
        {
            player.setVelocityX(-200);

            player.anims.play('left', true);
        }
        else if (cursors.right.isDown)
        {
            player.setVelocityX(200);

            player.anims.play('right', true);
        }
        else
        {
            player.setVelocityX(0);

            player.anims.play('turn');
        }

        if (cursors.up.isDown && player.body.touching.down)
        {
            player.setVelocityY(-330);
        }
    };
</script>