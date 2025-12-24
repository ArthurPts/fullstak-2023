<?php
session_start();

include_once('service/thread.php');
$objThread = new thread();

if (!isset($_POST['idthread']) || !isset($_SESSION['username'])) {
    exit;
}

$idthread = $_POST['idthread'];
$chat = $objThread->getChatList($idthread);

while ($c = $chat->fetch_assoc()) {

    $waktu = date("d M Y H:i", strtotime($c['tanggal_pembuatan']));

    if ($c['username_pembuat'] == $_SESSION['username']) {
        ?>
        <div style="margin-bottom:1rem; text-align:right; color:greenyellow;">
            <b><?= htmlspecialchars($c['nama_pengirim']) ?></b><br>
            <?= htmlspecialchars($c['isi']) ?><br>
            <small style="color:#aaa;"><?= $waktu ?></small>
        </div>
        <?php
    } else {
        ?>
        <div style="margin-bottom:1rem;">
            <b><?= htmlspecialchars($c['nama_pengirim']) ?></b><br>
            <?= htmlspecialchars($c['isi']) ?><br>
            <small style="color:#aaa;"><?= $waktu ?></small>
        </div>
        <?php
    }
}
