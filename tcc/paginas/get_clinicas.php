<?php
include('db.php');

header('Content-Type: application/json');

$sql = "SELECT id, nome FROM clinicas";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clinicas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['clinicas' => $clinicas]);
