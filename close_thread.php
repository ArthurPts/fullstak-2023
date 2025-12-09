<?php
session_start();
include_once('service/thread.php');

$objThread = new thread();

// pastikan parameter id ada
if (!isset($_GET['id'])) {
    die("ID thread tidak ditemukan.");
}

$idThread = $_GET['id'];

// jalankan fungsi
$objThread->closeThread($idThread);

// redirect kembali (optional)
header("Location: detilgrup.php?id=" . $idThread);
exit();
?>
