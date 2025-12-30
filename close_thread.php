<?php
session_start();
include_once('service/thread.php');

$objThread = new thread();

if (!isset($_GET['id'])) {
    die("ID thread tidak ditemukan.");
}

$idThread = $_GET['id'];
$idGrup = $_GET['grup'];

$objThread->closeThread($idThread);

header("Location: detilgrup.php?id=" . $idGrup);
exit();
?>
