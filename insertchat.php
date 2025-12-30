<?php
session_start();
include_once('service/thread.php');

$objThread = new thread();

$idthread = $_GET['id'];
$idgrup = $_GET['grup'];
$isi = $_POST['kirimChat'];
$username = $_SESSION['username'];

$objThread->insertChat($idthread, $username, $isi);
header("location: detilthread.php?id=".$idthread."&grup=".$idgrup);
exit;
?>

