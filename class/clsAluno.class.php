<?php
    class aluno {

        private $pdo;
        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha) 
        {
            global $pdo;
            global $msgErro;

            try 
            {
                // Gerar conexão com banco de dados
                $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
            }
            catch (PDOException $e) 
            {
                // Capturar os erros
                $msgErro = $e->getMessage();
            }
            
        }

        public function cadastrarAluno($nomeAluno, $emailAluno, $senhaAluno) 
        {
            global $pdo;

            // Verificar se já existe o email cadastrado
            $sql = $pdo->prepare("select idAluno from aluno where emailAluno = :e");
            // Substituir informação (emailAluno) com bindValue
            $sql->bindValue(":e", $emailAluno);
            // Executar comandos 
            $sql->execute();
            // Verificar a quantidade de linhas que o banco enviou
            if ($sql->rowCount() > 0) {
                // Email já está cadastrado
                return false;
            }
            else {
                // Cadastrar professor
                $sql = $pdo->prepare("insert into aluno (nomeAluno, emailAluno, senhaAluno) values (:n, :e, :s)");
                // Substituir informação com bindValue
                $sql->bindValue(":n",$nomeAluno);
                $sql->bindValue(":e",$emailAluno);
                $sql->bindValue(":s",$senhaAluno);
                // Executar comandos 
                $sql->execute();
                return true;
            }
        }

        public function logarAluno($emailAluno, $senhaAluno) 
        {
            global $pdo;

            // Verificar se o email e senha estão cadastrados
            $sql = $pdo->prepare("select idAluno from aluno where emailAluno = :e and senhaAluno = :s");
            // Substituir informação com bindValue
            $sql->bindValue(":e",$emailAluno);
            $sql->bindValue(":s",$senhaAluno);
            $sql->execute();
            // Verificar a quantidade de linhas que o banco enviou
            if ($sql->rowCount() > 0) 
            {
                // Cadastro encontrado - Entrar no sistema (Sessão)
                $dado = $sql->fetch();
                // Iniciar a sessão do usuário
                session_start();
                // Definir o valor da variável global de Sessão
                $_SESSION['idAluno'] = $dado['idAluno'];
                return true; 
                // Logado com sucesso
            }
            else 
            {
                return false;
                // Não foi possível logar
            }
        }

        public function perfilAluno($idAluno)
        {
            global $pdo;

            $sql = $pdo->prepare("select * from aluno where idAluno= :a");
            $sql->bindValue(":a",$idAluno);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                $dado = $sql->fetch();
                $nomeAluno = $dado['nomeAluno'];
                return $nomeAluno;
            }
            else 
            {
                return false;
            }
        }

        public function verificarTurma($idAluno)
        {
            global $pdo;

            $sql = $pdo->prepare("select FK_idTurma from aluno where idAluno = :a");
            $sql->bindValue(":a",$idAluno);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                while($dado = $sql->fetch())
                {
                    $idTurma = $dado['FK_idTurma'];
                    if ($idTurma == null || $idTurma == "")
                    {
                        return false;
                    }
                    else if ($idTurma > 0)
                    {
                        return true;
                    }
                }
            }
            else 
            {
                return true;
            }
        }

        public function consultarTurmaAdd($idTurma, $turmaAno, $turmaLetra)
        {
            global $pdo;

            $sql = $pdo->prepare("select * from turma where idTurma = :t and ano = :a and letra = :l");
            $sql->bindValue(":t",$idTurma);
            $sql->bindValue(":a",$turmaAno);
            $sql->bindValue(":l",$turmaLetra);
            $sql->execute();
            if ($sql->rowCount() <= 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function dadosTurma($FK_idTurma) 
        {
            global $pdo;

            $sql = $pdo->prepare("select * from turma where idTurma = :t");
            $sql->bindValue(":t", $FK_idTurma);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                return $sql;
            }
        }

        public function consultarAluno($idAluno)
        {
            global $pdo;

            $sql = $pdo-> prepare("select * from aluno where idAluno = :a");
            $sql->bindValue(":a", $idAluno);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                return $sql;
            }
        }

        public function consultarAlunoTurma($idTurma)
        {
            global $pdo;

            $sql = $pdo-> prepare("select * from aluno where FK_idTurma = :t");
            $sql->bindValue(":t", $idTurma);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                return $sql;
            }
        }

        public function updateIdTurma($idTurma, $idAluno)
        {
            global $pdo;

            $sql = $pdo->prepare("update aluno set FK_idTurma = :f where idAluno = :a");
            $sql->bindValue(":f",$idTurma);
            $sql->bindValue(":a",$idAluno);
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                while ($dado=$sql->fetch())
                {
                    $idTurma = $dado['FK_idTurma'];
                }
                if ($idTurma == null || $idTurma == '')
                {
                    return false;   
                }
                else 
                {
                    return true;
                }
            }
        }

        public function updatePontuacao($idAluno, $pontuacao)
        {
            global $pdo;

            $sql = $pdo->prepare("update aluno set pontuacao = :p where idAluno = :a");
            $sql->bindValue(":p",$pontuacao);
            $sql->bindValue(":a",$idAluno);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                while ($dado=$sql->fetch())
                {
                    $pontuacao = $dado['pontuacao'];
                }
                if ($pontuacao == null || $pontuacao = '')
                {
                    return false;
                }
                else {
                    return true;
                }
            }
        }
    }
?>