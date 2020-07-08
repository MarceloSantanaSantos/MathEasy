<?php
class BancoDados {
    private $servidor = "localhost";
    private $banco = "matheasy";
    private $usuario = "root";
    private $senha = "root";
    private $strerro = "";
    private $conexao = "";

    private function getConectar() {
        try {
            $this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
            if($this->conexao) {
                mysqli_select_db($this->conexao, $this->banco);
                return true;
            }
            else {
                $this->strerro = "Problema na conexão com o Banco de Dados!";
                return false;
            }
        }
        catch (Exception $erros) {
            $this->strerro = $erros.getMessage();
            return false;
        }
    }

    private function getDesconectar() {
        try {
            if($this->conexao) {
                mysqli_close($this->conexao);
                return true;
            }
            else {
                $this->strerro = "Falha ao desconectar com o Banco de Dados!";
                return false;
            }
        }
        catch (Exception $erros) {
            $this->strerro = $erros.getMessage();
            return false;
        }
    }

    public function getExecutarSQL($strSQL) {
        try {
            $retorno = -1;
            if($this->getConectar()) {
                $dados = mysqli_query($this->conexao, $strSQL);
                $retorno = mysqli_affected_rows($this->conexao);
            }
             return $retorno;
        }
        catch (Exception $erros) {
            $this->strerro = $erros.getMessage();
            return false;
        }
        finally {
            $this->getDesconectar();
        }
    }

    public function getConsultarDados($strSQL) {
        try {
            $registro = null;
            if($this->getConectar()) {
                $dados = mysqli_query($this->conexao, $strSQL);
                if(mysqli_affected_rows($this->conexao) > 0) {
                    $registro = mysqli_fetch_array($dados);
                }
            }
             return $registro;
        }
        catch (Exception $erros) {
            $this->strerro = $erros.getMessage();
            return false;
        }
        finally {
            $this->getDesconectar();
        }
    }

    public function getErro() {
        return $this->strerro;
    }
}
?>