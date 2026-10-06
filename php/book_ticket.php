<?php
session_start(); require_once __DIR__ . '/db.php';
if(!isset($_SESSION['user_id'])){header("Location: ../login.php");exit;}
$show_id=filter_input(INPUT_POST,'show_id',FILTER_VALIDATE_INT);
$seats=$_POST['seats']??[];
$seats=array_values(array_unique(array_filter($seats, fn($s)=>preg_match('/^[A-F][1-8]$/',$s))));
if(!$show_id || !$seats){header("Location: ../booking.php?show_id=".$show_id);exit;}

try {
    $pdo->beginTransaction();
    $stmt=$pdo->prepare("SELECT price FROM shows WHERE id=? FOR UPDATE"); $stmt->execute([$show_id]); $show=$stmt->fetch();
    if(!$show) throw new Exception('Invalid show');
    $check=$pdo->prepare("SELECT seat_number FROM bookings WHERE show_id=? AND seat_number=? AND booking_status='Confirmed' FOR UPDATE");
    foreach($seats as $seat){$check->execute([$show_id,$seat]); if($check->fetch()){throw new Exception('One or more selected seats are already booked.');}}
    $code='CB'.date('ymdHis').strtoupper(substr(bin2hex(random_bytes(2)),0,4));
    $total=count($seats)*(float)$show['price'];
    $insert=$pdo->prepare("INSERT INTO bookings(user_id,show_id,seat_number,booking_code,total_amount,booking_status) VALUES(?,?,?,?,?,'Confirmed')");
    foreach($seats as $seat){$insert->execute([$_SESSION['user_id'],$show_id,$seat,$code,$total]);}
    $pdo->commit();
    header("Location: ../booking-confirmation.php?code=".$code); exit;
} catch(Exception $e) {
    if($pdo->inTransaction()) $pdo->rollBack();
    header("Location: ../booking.php?show_id=".$show_id."&error=".urlencode($e->getMessage())); exit;
}