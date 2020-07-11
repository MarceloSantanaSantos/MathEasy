<?php
    class turma {
        private $pdo;
        public $msgErro;

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

        public function cadastrarTurma($turma, $escolaTurma, $idProf)
        {
            global $pdo;

            $sql = $pdo->prepare("select idTurma from turma where turma = :t and escolaTurma = :et");
            $sql->bindValue(":t",$turma);
            $sql->bindValue(":et",$escolaTurma);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                return false;
            }
            else 
            {
                $sql = $pdo->prepare("insert into turma (turma, escolaTurma, FK_idProf) values (:t, :et, :fp)");
                $sql->bindValue(":t",$turma);
                $sql->bindValue(":et",$escolaTurma);
                $sql->bindValue(":fp",$idProf);
                $sql->execute();
                return true;
            }
        }

        public function consultarTurma($idProf) 
        {
            global $pdo;

            $sql = $pdo->prepare("select turma, escolaTurma from turma where FK_idProf = :fp");
            $sql->bindValue(":fp",$idProf);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                return $sql;
            }
        }

        public function removerTurma($turma, $escolaTurma, $idProf)
        {
            global $pdo;

            $sql = $pdo->prepare("delete from turma where turma = :t and escolaTurma = :et and FK_idProf = :f");
            $sqlVerify = $pdo->prepare("select * from turma where turma = :tv and escolaTurma = :etv and FK_idProf = :fv");
            $sqlVerify->bindValue(":tv",$turma);
            $sqlVerify->bindValue(":etv",$escolaTurma);
            $sqlVerify->bindValue(":fv",$idProf);
            $sql->bindValue(":t",$turma);
            $sql->bindValue(":et",$escolaTurma);
            $sql->bindValue(":f",$idProf);
            $sql->execute();
            $sqlVerify->execute();
            if ($sqlVerify->rowCount() <= 0)
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