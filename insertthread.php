<?php
session_start();
include_once("service/thread.php");

$objThread = new thread();
if (!isset($_GET['id'])) {
    die("ID thread tidak ditemukan.");
}
$idThread = $_GET['id'];
$objThread -> createThread($idThread,$_SESSION['username']);
header("Location: detilgrup.php?id=" . $idThread);
exit();
?>