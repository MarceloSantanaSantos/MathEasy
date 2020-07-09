<?php
    require_once(__DIR__."/clsBancoDados.class.php");

    class aluno extends BancoDados {

        public $idAluno;
        public $nomeAluno;
        public $emailAluno;
        public $senhaAluno;
        public $turmaAluno;

        private $strerro = "";

        public function getGravarAluno() {
            try {
                $sqlstring = "insert into aluno (idAluno,nomeAluno,emailAluno,senhaAluno,turmaAluno) values (NULL,";
                $sqlstring .= "'".$this->nomeAluno."','".$this->emailAluno."','".$this->senhaAluno."','".$this->turmaAluno."')";
                if (self::getExecutarSQL($sqlstring) > 0) {
                    $retorno = true;
                }
                else {
                    $this->strerro = "Problema com a gravação dos dados do Aluno.";
                    $retorno = false;
                }
                return $retorno;
            }
            catch (Exception $erros) {
                $this->strerro = $erros.getMessage();
                return false;
            }
        }

        // public function getConsultarAluno() {
        //     try {
        //         $sqlstring = "select email,senha from aluno where email";
        //     }
        // }
    }
?>