<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
$stmt->execute([$id]);
$property = $stmt->fetch();

if (!$property) {
    http_response_code(404);
    echo json_encode(['error'=>'Property not found']);
    exit;
}

$stmt = $pdo->prepare("SELECT a.id,a.name FROM amenities a
                       JOIN property_amenities pa ON pa.amenity_id=a.id
                       WHERE pa.property_id=? ORDER BY a.name");
$stmt->execute([$id]);
$property['amenities'] = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT image_url FROM property_images WHERE property_id=? ORDER BY id");
$stmt->execute([$id]);
$property['gallery'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($property);
?>