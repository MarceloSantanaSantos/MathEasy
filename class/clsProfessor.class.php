<?php
    class professor {

        private $pdo;
        public $msgErro = "";
        public $nomeProfessor;
        public $emailProfessor;

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

        public function cadastrarProfessor($nomeProf, $emailProf, $senhaProf) 
        {
            global $pdo;

            // Verificar se já existe o email cadastrado
            $sql = $pdo->prepare("select idProf from professor where emailProf = :e");
            // Substituir informação (emailProf) com bindValue
            $sql->bindValue(":e", $emailProf);
            // Executar comandos 
            $sql->execute();
            // Verificar a quantidade de linhas que o banco enviou
            if ($sql->rowCount() > 0) {
                // Email já está cadastrado
                return false;
            }
            else {
                // Cadastrar professor
                $sql = $pdo->prepare("insert into professor (nomeProf, emailProf, senhaProf) values (:n, :e, :s)");
                // Substituir informação com bindValue
                $sql->bindValue(":n",$nomeProf);
                $sql->bindValue(":e",$emailProf);
                $sql->bindValue(":s",md5($senhaProf));
                // Executar comandos 
                $sql->execute();
                return true;
            }
        }

        public function logarProfessor($emailProf, $senhaProf) 
        {
            global $pdo;

            // Verificar se o email e senha estão cadastrados
            $sql = $pdo->prepare("select idProf from professor where emailProf = :e and senhaProf = :s");
            // Substituir informação com bindValue
            $sql->bindValue(":e",$emailProf);
            $sql->bindValue(":s",md5($senhaProf));
            $sql->execute();
            // Verificar a quantidade de linhas que o banco enviou
            if ($sql->rowCount() > 0) 
            {
                // Cadastro encontrado - Entrar no sistema (Sessão)
                $dado = $sql->fetch();
                // Iniciar a sessão do usuário
                session_start();
                // Definir o valor da variável global de Sessão
                $_SESSION['idProf'] = $dado['idProf'];
                return true; 
                // Logado com sucesso
            }
            else 
            {
                return false;
                // Não foi possível logar
            }
        }

        public function perfilProfessor($idProf)
        {
            global $pdo;

            $sql = $pdo->prepare("select * from professor where idProf = :e");
            $sql->bindValue(":e",$idProf);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                $dado = $sql->fetch();
                $nomeProfessor = $dado['nomeProf'];
                return $nomeProfessor;
            }
            else 
            {
                return false;
            }
        }

        public function consultarProfessor($idProf)
        {
            global $pdo;

            $sql = $pdo->prepare("select * from professor where idProf = :p");
            $sql->bindValue(":p", $idProf);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                return $sql;
            }
        }

        public function consultarAlunoTurma($idTurma)
        {
            global $pdo;

            $sql = $pdo->prepare("select * from aluno where FK_idTurma = :t");
            $sql->bindValue(":t",$idTurma);
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                return $sql;
            }
        }
    }
?>