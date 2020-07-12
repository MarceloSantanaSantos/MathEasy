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

        public function cadastrarTurma($ano, $letra, $idProf, $idEscolaTurma)
        {
            global $pdo;

            $sql = $pdo->prepare("select idTurma from turma where ano = :a and letra = :l and FK_idProf = :fp and FK_idEscola = :f");
            $sql->bindValue(":a",$ano);
            $sql->bindValue(":l",$letra);
            $sql->bindValue(":fp",$$idProf);
            $sql->bindValue(":f",$idEscolaTurma);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                return false;
            }
            else 
            {
                $sql = $pdo->prepare("insert into turma (ano, letra, FK_idProf, FK_idEscola) values (:a, :l: :fp, :f)");
                $sql->bindValue(":a",$ano);
                $sql->bindValue(":l",$letra);
                $sql->bindValue(":fp",$idProf);
                $sql->bindValue(":f",$idEscolaTurma);
                $sql->execute();
                return true;
            }
        }

        public function consultarTurma($idEscolaTurma ,$idProf) 
        {
            global $pdo;

            $sql = $pdo->prepare("select * from turma where FK_idEscola = :fe and FK_idProf = :fp");
            $sql->bindValue(":fe",$idEscolaTurma);
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

        public function perfilTurma($idEscolaTurma)
        {
            global $pdo;

            $sql = $pdo->prepare("select * from turma where FK_idEscola = :f");
            $sql->bindValue(":f",$idEscolaTurma);
            $sql->execute();
            if ($sql->rowCount() > 0)
            {
                $dado = $sql->fetch();
                $nomeEscola = $dado['escolaTurma'];
                return $nomeEscola;
            }
            else
            {
                return false;
            }
        }
    }
?>