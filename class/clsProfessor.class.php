<?php
    require_once(__DIR__."/clsBancoDados.class.php");

    class professor extends BancoDados {

        public $idProf;
        public $nomeProf;
        public $emailProf;
        public $senhaProf;

        private $strerro = "";

        public function getGravarProfessor() {
            try {
                $sqlstring = "insert into professor (idProf, nomeProf, emailProf, senhaProf) values (NULL,";
                $sqlstring .= "'".$this->nomeProf."','".$this->emailProf."','".$this->senhaProf."')";

                if (self::getExecutarSQL($sqlstring) > 0) {
                    $retorno = true;
                }
                else {
                    $this->strerro = "Problema com a gravação dos dados do Professor";
                    $retorno = false;
                }
                return $retorno;
            }
            catch (Exception $erros) {
                $this->strerro = $erros.getMessage();
                return false;
            }
        }
    }
?>