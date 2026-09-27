<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success'=>false,'message'=>'Please login first.']); exit;
}
$user_id=(int)$_SESSION['user_id'];
$property_id=(int)($_POST['property_id'] ?? 0);
$action=$_POST['action'] ?? '';

if ($action==='toggle') {
    $stmt=$pdo->prepare("SELECT id FROM interested_users WHERE user_id=? AND property_id=?");
    $stmt->execute([$user_id,$property_id]);
    if ($stmt->fetch()) {
        $pdo->prepare("DELETE FROM interested_users WHERE user_id=? AND property_id=?")->execute([$user_id,$property_id]);
        echo json_encode(['success'=>true,'interested'=>false]); 
    } else {
        $pdo->prepare("INSERT INTO interested_users(user_id,property_id) VALUES(?,?)")->execute([$user_id,$property_id]);
        echo json_encode(['success'=>true,'interested'=>true]);
    }
    exit;
}
echo json_encode(['success'=>false,'message'=>'Invalid action.']);
?>