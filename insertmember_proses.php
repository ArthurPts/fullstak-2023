<?php
session_start();
include_once('service/grup.php');
$objGrup = new grup();

if (!isset($_SESSION['login']) && !($_SESSION['username'][0] === 'D')) {
    header("Location: login_temp.php");
    exit();
}

$idGrup = $_GET['id'];
$username = $_GET['user'];

if($objGrup -> addMember($username,$idGrup)){
    echo "<script>alert('Berhasil menambahkan anggota.');</script>";
}else {
    echo "<script>alert('gagal menambahkan anggota.');</script>";
}

header("Location: insertmember.php?id=$idGrup");
exit();
?>