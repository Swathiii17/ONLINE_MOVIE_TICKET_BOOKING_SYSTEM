<?php
session_start(); require_once __DIR__ . '/db.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){header("Location: ../register.php");exit;}
$name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $password=$_POST['password']??'';
if($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<6){header("Location: ../register.php?error=Please enter valid details.");exit;}
$stmt=$pdo->prepare("SELECT id FROM users WHERE email=?"); $stmt->execute([$email]);
if($stmt->fetch()){header("Location: ../register.php?error=Email is already registered.");exit;}
$hash=password_hash($password,PASSWORD_DEFAULT);
$stmt=$pdo->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)"); $stmt->execute([$name,$email,$hash]);
$_SESSION['user_id']=$pdo->lastInsertId(); $_SESSION['user_name']=$name;
header("Location: ../movies.php"); exit;