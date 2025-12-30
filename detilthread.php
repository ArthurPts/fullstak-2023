<?php
session_start();
include_once('service/grup.php');
$objGrup = new grup();
include_once('service/thread.php');
$objThread = new thread();
if (!$objGrup->checkMemberGrup($_SESSION['username'], $_GET['grup'])) { // biar ga bisa di akses lewat ketik di web
    require_once('service/404.php');
}
$thisIDThread = $_GET['id'];
$thisIDGrup = $_GET['grup'];

$username = $_SESSION['username'];

$status_thread = "";
$thread = $objThread->getThreadInfo($thisIDThread);
while ($t = $thread->fetch_assoc()) {
    $status_thread = $t['status'];
}
$namaGrup = "";
$grupInfo = $objGrup->getGrupInfoDetail($thisIDGrup);
while ($g = $grupInfo->fetch_assoc()) {
    $namaGrup = $g['nama'];
}

$chat = $objThread->getChatList($thisIDThread);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detil Thread</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="styleTampilan" style="font-size: 2vw;">
        <div style="width: 100%;">
            <table border="1" style="margin: 0 auto; ">
                <tr>
                    <th>
                        <p><?php echo $namaGrup; ?></p>
                    </th>
                </tr>
            </table>
        </div>

        <div style="width: 100%;height: 62vh; overflow-y: auto;">
            <table border="1" style="margin: 0 auto; " id="chat">
                <!-- <tr>
                    <td style="text-align: left; padding-left: 5vw;">
                        <p>nama || timestamp</p>
                        <p>isi chat akun lain</p> 
                    </td>
                </tr> -->
                <!-- //! TR DAN TD TINGGAL DI LOOPING -->
                <!-- <tr>
                    <td style="text-align: right; padding-right: 5vw; color:greenyellow;">
                        <p>timestamp || nama</p>
                        <p>isi chat akun saat ini</p> 
                    </td>
                </tr> -->

            </table>
        </div>

        <?php if ($status_thread != "Close") { ?>
            <form action="insertchat.php?id=<?php echo $thisIDThread; ?>&grup=<?php echo $thisIDGrup; ?>" method="post">
                <input style="margin: 0 auto; width:80%; font-size: 3vw;" type="text" name="kirimChat" placeholder="ketik pesan">
                <input type="submit" value="KIRIM PESAN">
            </form>
        <?php } else { ?>
            <p style="text-align: center; color: red; font-size: 3vw;">THREAD TELAH DITUTUP</p>
        <?php } ?>
    </div>

    <script>
        function loadChat() {
            $.ajax({
                url: 'selectchat.php',
                type: 'POST',
                data: {
                    idthread: <?= $thisIDThread ?>
                },
                success: function(data) {
                    $('#chat').html(data);
                    $('#chat').scrollTop($('#chat')[0].scrollHeight);
                }
            });
        }

        loadChat(); // load pertama kali

        setInterval(loadChat, 2000); // refresh tiap 2 detik
    </script>
    <script src="service/theme.js"></script>
</body>

</html>