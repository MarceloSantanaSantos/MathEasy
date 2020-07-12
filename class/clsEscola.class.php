<?php
    class escola {
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

        public function cadastrarEscola($nomeEscola, $cidadeEscola, $idProf)
        {
            global $pdo;

            // Verificar se já existe nomeEscola cadastrado
            $sql = $pdo->prepare("select idEscola from escola where nomeEscola = :n and cidadeEscola = :c");
            // Substituir informação (nomeEscola) com bindValue
            $sql->bindValue(":n",$nomeEscola);
            $sql->bindValue(":c",$cidadeEscola);
            $sql->execute();
            if($sql->rowCount() > 0) 
            {
                return false;
            }
            else
            {
                $sql = $pdo->prepare("insert into escola (nomeEscola, cidadeEscola, FK_idProf) values (:n, :c, :f)");
                $sql->bindValue(":n",$nomeEscola);
                $sql->bindValue(":c",$cidadeEscola);
                $sql->bindValue(":f",$idProf);
                $sql->execute();
                return true;
            }
        }

        public function consultarEscolas($idProf)
        {
            global $pdo;

            $sql = $pdo->prepare("select * from escola where FK_idProf = :f ");
            $sql->bindValue(":f",$idProf);
            $sql->execute();
            if ($sql->rowCount() > 0) 
            {   
                return $sql;
            }
        }

        public function removerEscola($nomeEscola, $cidadeEscola, $idProf)
        {
            global $pdo;

            $sql = $pdo->prepare("delete from escola where nomeEscola = :n and cidadeEscola = :c and FK_idProf = :f");
            $sql->bindValue(":n",$nomeEscola);
            $sql->bindValue(":c",$cidadeEscola);
            $sql->bindValue(":f",$idProf);
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