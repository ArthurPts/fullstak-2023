<?php 
session_start();
include_once('service/grup.php');
$objGrup = new grup();
include_once('service/thread.php');
$objThread = new thread();
if (!$objGrup->checkMemberGrup($_SESSION['username'], $_GET['grup'])){// biar ga bisa di akses lewat ketik di web
	require_once ('service/404.php');
}
$thisIDThread = $_GET['id'];

$chat = $objThread->getChatList($thisIDThread);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detil Thread</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="styleTampilan" style="font-size: 2vw;">
        <div style="width: 100%;">
            <table border="1" style="margin: 0 auto; ">
                <tr>
                    <th>
                        nama grup
                    </th>
                </tr>
            </table>
        </div>

        <div style="width: 100%;height: 62vh; overflow-y: auto;" id="chat">
            <table border="1" style="margin: 0 auto; "> 
                <tr>
                    <td style="text-align: left; padding-left: 5vw;">
                        <p>nama || timestamp</p>
                        <p>isi chat akun lain</p> 
                    </td>
                </tr>
<!-- //! TR DAN TD TINGGAL DI LOOPING -->
                <tr>
                    <td style="text-align: right; padding-right: 5vw; color:greenyellow;">
                        <p>timestamp || nama</p>
                        <p>isi chat akun saat ini</p> 
                    </td>
                </tr>
         
            </table>
        </div>
    
        <input style="margin: 0 auto; width:80%; font-size: 3vw;" type="text" name="kirimChat" placeholder="ketik pesan">
        <a href=""><button>KIRIM PESAN</button></a>
<!--//! UNTUK KIRIM CHAT MASIH BELUM -->
    </div>

    <script>
    // Start scroll at bottom
    const chat = document.getElementById("chat");
    chat.scrollTop = chat.scrollHeight;
</script>
</body>
</html>