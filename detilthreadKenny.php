<?php
session_start();
include_once('service/grup.php');
$objGrup = new grup();
include_once('service/thread.php');
$objThread = new thread();
if (!$objGrup->checkMemberGrup($_SESSION['username'], $_GET['grup'])) {
    require_once('service/404.php');
    exit;
}

$idThread = $_GET['id'];
$idGrup   = $_GET['grup'];
$status_thread="";
$thread=$objThread->getThreadInfo($idThread);
while($t = $thread->fetch_assoc()){
    $status_thread=$t['status'];
}

$chat   = $objThread->getChatList($idThread);
$member = $objGrup->getMemberList($idGrup);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Detil Thread</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>

<div class="detilgrup">

<!-- KIRI -->
<div class="grup member-box">
    <div class="grupDesc">
        <h2>Member</h2>
        <?php while ($m = $member->fetch_assoc()) { ?>
            <p><?= $m['username'] ?></p>
        <?php } ?>
    </div>
</div>

<!-- KANAN -->
<div class="grup" style="width:80%; display:flex; flex-direction:column; align-items: center; justify-content: center;">

    <!-- CHAT -->
    <div id="chat" style="width: 90%; flex:1; overflow-y:auto; padding:1rem;">
        <?php while ($c = $chat->fetch_assoc()) { ?>
            <?php if ($c['username_pembuat'] == $_SESSION['username']) { ?>
                <div style="margin-bottom:1rem; text-align:right; color:greenyellow;">
                    <b><?= $c['username_pembuat'] ?></b><br>
                    <?= $c['isi'] ?>
                </div>
            <?php } else { ?>
                <div style="margin-bottom:1rem;">
                    <b><?= $c['username_pembuat'] ?></b><br>
                    <?= $c['isi'] ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

   <!-- INPUT -->
    <?php if($status_thread != "Close") { ?>
        <div style="border-top:1px solid #333; padding:1rem; width: 90%;">
            <form id="formChat" style="display:flex; flex-direction: row; gap:1rem;">
                <input type="hidden" name="idthread" value="<?= $idThread ?>">
                <input type="text" name="isi" id="isi" placeholder="ketik pesan" style="flex:3;" required>
                <button type="submit" style="flex:1;">SEND</button>
            </form>
        </div>
    <?php } ?>
    

</div>
</div>

<script>
const chatBox = document.getElementById("chat");
const form = document.getElementById("formChat");
const isi = document.getElementById("isi");

chatBox.scrollTop = chatBox.scrollHeight;

form.addEventListener("submit", function(e) {
    e.preventDefault();

    const data = new FormData(form);

    fetch("insertchat.php", {
        method: "POST",
        body: data
    })
    .then(res => res.text())
    .then(html => {
        chatBox.insertAdjacentHTML("beforeend", html);
        isi.value = "";
        chatBox.scrollTop = chatBox.scrollHeight;
    });
});

function selectChat(){
    const data = new FormData();
    data.append("idthread","<?=$idThread?>")
    fetch("selectchat.php",{
        method: "POST",
        body: data
    })
    .then(res => res.text())
    .then (html =>{
        chatBox.innerHTML = html;
        chatBox.scrollTop = chatBox.scrollHeight;
    });
}

setInterval(selectChat, 1000); // akan membuat update chat setiap 1 detik sekali
</script>

</body>
</html>
