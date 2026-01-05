<?php
$db = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$stmt = $db->query('SELECT id, name, main_image_url FROM products');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows, JSON_PRETTY_PRINT);
