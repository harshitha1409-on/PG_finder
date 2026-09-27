<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once '../config.php';

$action = $_POST['action'] ?? '';

if ($action === 'signup') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<6) {
        echo json_encode(['success'=>false,'message'=>'Enter valid details. Password must be at least 6 characters.']); exit;
    }
    $check=$pdo->prepare("SELECT id FROM users WHERE email=?");
    $check->execute([$email]);
    if ($check->fetch()) { echo json_encode(['success'=>false,'message'=>'Email already registered.']); exit; }

    $stmt=$pdo->prepare("INSERT INTO users(name,email,password,phone) VALUES(?,?,?,?)");
    $stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT),$phone]);
    $_SESSION['user_id']=$pdo->lastInsertId();
    $_SESSION['user_name']=$name;
    echo json_encode(['success'=>true,'message'=>'Account created.']); exit;
}

if ($action === 'login') {
    $email=trim($_POST['email'] ?? '');
    $password=$_POST['password'] ?? '';
    $stmt=$pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user=$stmt->fetch();
    if ($user && password_verify($password,$user['password'])) {
        $_SESSION['user_id']=$user['id']; $_SESSION['user_name']=$user['name'];
        echo json_encode(['success'=>true,'message'=>'Logged in.','name'=>$user['name']]);
    } else echo json_encode(['success'=>false,'message'=>'Invalid email or password.']);
    exit;
}

if ($action === 'logout') {
    session_destroy();
    echo json_encode(['success'=>true]); exit;
}

echo json_encode(['success'=>false,'message'=>'Invalid action.']);
?>