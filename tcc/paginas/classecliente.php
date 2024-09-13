<?php
class Cliente
{
    private $idCliente;
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $cidade;
    private $estado;
    private $cep;

    public function setIdCliente($valor)
    {
        $this->idCliente = $valor;
    }

    public function setNome($valor)
    {
        $this->nome = $valor;
    }

    public function setEmail($valor)
    {
        $this->email = $valor;
    }

    public function setTelefone($valor)
    {
        $this->telefone = $valor;
    }

    public function setEndereco($valor)
    {
        $this->endereco = $valor;
    }

    public function setCidade($valor)
    {
        $this->cidade = $valor;
    }

    public function setEstado($valor)
    {
        $this->estado = $valor;
    }

    public function setCep($valor)
    {
        $this->cep = $valor;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function listar()
{
    require("conexaobd.php");

    $consulta = "SELECT idCliente, nome, email, telefone, endereco, cidade, estado, cep FROM clientes ORDER BY nome;";
    $resultado = $conexao->prepare($consulta);
    $resultado->execute();
    
    return $resultado;
}


    public function consultar($idCliente) {
        require("conexaobd.php");
    
        $comando = "SELECT idCliente, nome, email, telefone, endereco, cidade, estado, cep FROM clientes WHERE idCliente = :idCliente";
        $resultado = $conexao->prepare($comando);
        $resultado->bindParam(":idCliente", $idCliente);
        $resultado->execute();
    
        if ($resultado->rowCount() == 1) {
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $this->idCliente = $registro["idCliente"];
            $this->nome = $registro["nome"];
            $this->email = $registro["email"];
            $this->telefone = $registro["telefone"];
            $this->endereco = $registro["endereco"];
            $this->cidade = $registro["cidade"];
            $this->estado = $registro["estado"];
            $this->cep = $registro["cep"];
            return true;
        }
        return false;
    }
    
}
?>
