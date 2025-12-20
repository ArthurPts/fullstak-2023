<?php
session_start();
include_once('service/thread.php');

$objThread = new thread();

$idthread = $_POST['idthread'];
$isi = $_POST['isi'];
$username = $_SESSION['username'];

$objThread->insertChat($idthread, $username, $isi);
?>

<div style="margin-bottom:1rem; text-align:right; color:greenyellow;">
    <b><?= $username ?></b><br>
    <?= htmlspecialchars($isi) ?>
</div>
