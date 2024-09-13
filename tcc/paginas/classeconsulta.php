<?php
class Consulta
{
    private $idConsulta;
    private $nomeAnimal;
    private $raca;
    private $proprietario;
    private $dataConsulta;
    private $horaConsulta;
    private $status;

    // Métodos setters
    public function setIdConsulta($valor) {
        $this->idConsulta = $valor;
    }

    public function setNomeAnimal($valor) {
        $this->nomeAnimal = $valor;
    }

    public function setRaca($valor) {
        $this->raca = $valor;
    }

    public function setProprietario($valor) {
        $this->proprietario = $valor;
    }

    public function setDataConsulta($valor) {
        $this->dataConsulta = $valor;
    }

    public function setHoraConsulta($valor) {
        $this->horaConsulta = $valor;
    }

    public function setStatus($valor) {
        $this->status = $valor;
    }

    // Métodos getters
    public function getIdConsulta() {
        return $this->idConsulta;
    }

    public function getNomeAnimal() {
        return $this->nomeAnimal;
    }

    public function getRaca() {
        return $this->raca;
    }

    public function getProprietario() {
        return $this->proprietario;
    }

    public function getDataConsulta() {
        return $this->dataConsulta;
    }

    public function getHoraConsulta() {
        return $this->horaConsulta;
    }

    public function getStatus() {
        return $this->status;
    }

    // Listar todas as consultas
    public function listar() {
        require("conexaobd.php");

        $consulta = "SELECT * FROM consultas_marcadas ORDER BY data_consulta, hora_consulta";
        $resultado = $conexao->prepare($consulta);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar uma consulta específica
    public function consultar($idConsulta) {
        require("conexaobd.php");

        $comando = "SELECT * FROM consultas_marcadas WHERE idConsulta = :idConsulta";
        $resultado = $conexao->prepare($comando);
        $resultado->bindParam(":idConsulta", $idConsulta);
        $resultado->execute();

        if ($resultado->rowCount() == 1) {
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $this->idConsulta = $registro["idConsulta"];
            $this->nomeAnimal = $registro["nome_animal"];
            $this->raca = $registro["raca"];
            $this->proprietario = $registro["proprietario"];
            $this->dataConsulta = $registro["data_consulta"];
            $this->horaConsulta = $registro["hora_consulta"];
            $this->status = $registro["status"];
            return true;
        }
        return false;
    }

    // Inserir uma nova consulta
    public function inserir($nomeAnimal, $raca, $proprietario, $dataConsulta, $horaConsulta, $status) {
        require("conexaobd.php");

        $comando = "INSERT INTO consultas_marcadas (nome_animal, raca, proprietario, data_consulta, hora_consulta, status) 
                    VALUES (:nomeAnimal, :raca, :proprietario, :dataConsulta, :horaConsulta, :status)";
        $resultado = $conexao->prepare($comando);
        $resultado->bindParam(':nomeAnimal', $nomeAnimal);
        $resultado->bindParam(':raca', $raca);
        $resultado->bindParam(':proprietario', $proprietario);
        $resultado->bindParam(':dataConsulta', $dataConsulta);
        $resultado->bindParam(':horaConsulta', $horaConsulta);
        $resultado->bindParam(':status', $status);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }

    // Alterar uma consulta existente
    public function alterar($idConsulta, $nomeAnimal, $raca, $proprietario, $dataConsulta, $horaConsulta, $status) {
        require("conexaobd.php");

        $comando = "UPDATE consultas_marcadas 
                    SET nome_animal = :nomeAnimal, raca = :raca, proprietario = :proprietario, 
                        data_consulta = :dataConsulta, hora_consulta = :horaConsulta, status = :status 
                    WHERE idConsulta = :idConsulta";
        $resultado = $conexao->prepare($comando);
        $resultado->bindParam(':idConsulta', $idConsulta);
        $resultado->bindParam(':nomeAnimal', $nomeAnimal);
        $resultado->bindParam(':raca', $raca);
        $resultado->bindParam(':proprietario', $proprietario);
        $resultado->bindParam(':dataConsulta', $dataConsulta);
        $resultado->bindParam(':horaConsulta', $horaConsulta);
        $resultado->bindParam(':status', $status);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }

    // Excluir uma consulta
    public function excluir($idConsulta) {
        require("conexaobd.php");

        $comando = "DELETE FROM consultas_marcadas WHERE idConsulta = :idConsulta";
        $resultado = $conexao->prepare($comando);
        $resultado->bindParam(':idConsulta', $idConsulta);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }
}
?>
