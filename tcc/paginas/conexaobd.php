<?php
try {
    // Defina as credenciais do banco de dados
    $host = 'localhost'; // Nome do host (localhost para o ambiente local)
    $dbname = 'tcc'; // Nome do banco de dados
    $username = 'root'; // Nome de usuário (geralmente 'root' para o ambiente local)
    $password = ''; // Senha do MySQL (pode estar em branco se não houver senha)

    // Cria a conexão usando PDO
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Define o modo de erro do PDO para exceções
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Use UTF-8 encoding
    $conexao->exec("set names utf8");

} catch (PDOException $e) {
    // Exibe a mensagem de erro, caso a conexão falhe
    die("Erro de conexão: " . $e->getMessage());
}
?>
