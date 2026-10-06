<?php
session_start(); require_once __DIR__ . '/db.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){header("Location: ../login.php");exit;}
$email=trim($_POST['email']??''); $password=$_POST['password']??'';
$stmt=$pdo->prepare("SELECT * FROM users WHERE email=?"); $stmt->execute([$email]); $u=$stmt->fetch();
if(!$u || !password_verify($password,$u['password'])){header("Location: ../login.php?error=Invalid email or password.");exit;}
$_SESSION['user_id']=$u['id']; $_SESSION['user_name']=$u['name'];
header("Location: ../movies.php"); exit;