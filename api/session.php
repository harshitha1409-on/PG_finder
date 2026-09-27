<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once '../config.php';

$out=['logged_in'=>isset($_SESSION['user_id']),'name'=>$_SESSION['user_name']??'','email'=>'','phone'=>'','user_id'=>$_SESSION['user_id']??null];
if ($out['logged_in']) {
  $u=$pdo->prepare('SELECT name,email,phone FROM users WHERE id=?');
  $u->execute([$_SESSION['user_id']]);
  $user=$u->fetch();
  if($user){$out['name']=$user['name'];$out['email']=$user['email'];$out['phone']=$user['phone']??'';}

  $stmt=$pdo->prepare("SELECT property_id FROM interested_users WHERE user_id=?");
  $stmt->execute([$_SESSION['user_id']]);
  $out['interests']=$stmt->fetchAll(PDO::FETCH_COLUMN);
} else $out['interests']=[];
echo json_encode($out);
?>