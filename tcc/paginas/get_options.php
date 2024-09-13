<?php
include 'conexaobd.php'; // Certifique-se de que o caminho está correto

header('Content-Type: application/json');

try {
    $tabela = $_GET['tabela']; // 'vacinas', por exemplo
    $sql = "";

    switch ($tabela) {
        case 'vacinas':
            $sql = "SELECT idVacina, nomeVacina FROM vacinas";
            break;
        // Adicione outros casos conforme necessário
    }

    if ($sql) {
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
