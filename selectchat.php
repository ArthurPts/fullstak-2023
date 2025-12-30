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
        <tr>
            <td style="text-align: right; padding-right: 5vw; color: greenyellow;">
                <p style="font-size: 1vw;"><?= htmlspecialchars($c['nama_pengirim']) ?></p>
                <div style="font-size: 2vw;"><?= htmlspecialchars($c['isi']) ?></div>
                <small style="font-size: 0.8vw;"><?= $waktu ?></small>
            </td>
        </tr>
        <?php
    } else {
        ?>
        <tr>
            <td style="text-align: left; padding-left: 5vw;">
                <p style="font-size: 1vw;"><?= htmlspecialchars($c['nama_pengirim']) ?></p>
                <div style="font-size: 2vw;"><?= htmlspecialchars($c['isi']) ?></div>
                <small style="font-size: 0.8vw;"><?= $waktu ?></small>
            </td>
        </tr>
        <?php
    }
}
