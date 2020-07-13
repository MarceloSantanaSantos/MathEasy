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
                $sql->bindValue(":s",md5($senhaAluno));
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
            $sql->bindValue(":s",md5($senhaAluno));
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

            $sql = $pdo->prepare("select * from aluno where idProf = :e");
            $sql->bindValue(":e",$idAuno);
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
            $sql->bindValue(":a", $idAluno);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                return true;
            }
            else 
            {
                return false;
            }
        }
    }
?>