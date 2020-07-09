<?php
    require_once(__DIR__."/clsBancoDados.class.php");

    class escola extends BancoDados {

        public $idEscola;
        public $nomeEscola;
        public $cidadeEscola;

        private $strerro = "";

        public function getGravarEscola() {
            try {
                $sqlstring = "insert into escola (idEscola, nomeEscola, cidadeEscola) values (NULL,";
                $sqlstring .= "'".$this->nomeEscola."','".$this->cidadeEscola."')";

                if (self::getExecutarSQL($sqlstring) > 0) {
                    $retorno = true;
                }
                else {
                    $this->strerro = "Problema com a gravaçao dos dados da EScola.";
                    $retorno = false;
                }
                return $retorno;
            }
            catch (Exception $erros) {
                $this->strerro = $erros.getMessage();
                return false;
            }
        }

        public function getConsultarEscola() {
            try {
                $sqlstring = "select idEscola, nomeEscola from escola where nomeEscola = ".$this->nomeEscola;
                $dadosEscola = self::getConsultarEscola($sqlstring);
                return $dadosEscola;
            }
            catch (Exception $erros) {
                $this->strerro = $erros.getMessage();
                return null;
            }

        }
    }
?>