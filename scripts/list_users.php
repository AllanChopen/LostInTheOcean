<?php
$db = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$stmt = $db->query('SELECT id, name, email, email_verified_at FROM users');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows, JSON_PRETTY_PRINT) . PHP_EOL;
