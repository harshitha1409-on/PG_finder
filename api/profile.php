<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once '../config.php';
if (!isset($_SESSION['user_id'])) { echo json_encode(['logged_in'=>false]); exit; }
$stmt=$pdo->prepare('SELECT id,name,email,phone,created_at FROM users WHERE id=?');
$stmt->execute([$_SESSION['user_id']]);
$user=$stmt->fetch();
if(!$user){ echo json_encode(['logged_in'=>false]); exit; }
$q=$pdo->prepare('SELECT p.id,p.name,p.city,p.area,p.price,p.gender,p.rating,p.description,p.image_url FROM interested_users i JOIN properties p ON p.id=i.property_id WHERE i.user_id=? ORDER BY i.created_at DESC');
$q->execute([$_SESSION['user_id']]);
echo json_encode(['logged_in'=>true,'user'=>$user,'saved'=>$q->fetchAll()]);
?>