<?php
session_start();
include_once('service/grup.php');
include_once('service/event.php');
include_once('service/thread.php');

$objGrup = new grup();
$objEvent = new event();
$objThread = new thread();

if (!isset($_SESSION['login'])) {
    header("Location: login_temp.php");
    exit();
}

$result = $objGrup->getGrupInfoDetail($_GET['id']);
$info = $result->fetch_assoc();

$namaGrup = $info['nama'];
$deskripsi = $info['deskripsi'];
$pembuat = $info['namaPembuat'];
$tanggalPembentukan = $info['tanggal_pembentukan'];
$jenis = $info['jenis'];
$kode = $info['kode_pendaftaran'];
$isPembuatGrup = ($_SESSION['username'] == $info['username_pembuat']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Grup</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('header.php'); ?>

    <div class="styleTampilan">

        <h2><?= $namaGrup ?></h2>
        <p><strong>Deskripsi:</strong> <?= $deskripsi ?></p>
        <?php if ($_SESSION['username'] == $info['username_pembuat']) { ?>
            <a href="editdetailgrup.php?id=<?= $_GET['id'] ?>">
                <button>Edit</button>
            </a>
        <?php } ?>

        <table style="margin-top: 10px;">
            <tr>
                <td><strong>Pembuat</strong></td>
                <td> <?= $pembuat ?></td>
            </tr>
            <tr>
                <td><strong>Tanggal Dibentuk</strong></td>
                <td> <?= $tanggalPembentukan ?></td>
            </tr>
            <tr>
                <td><strong>Jenis Grup</strong></td>
                <td> <?= $jenis ?></td>
            </tr>
            <?php if ($_SESSION['username'] == $info['username_pembuat']) { ?>
                <tr>
                    <td><strong>Kode Pendaftaran Grup</strong></td>
                    <td> <?= $kode ?></td>
                </tr>
            <?php } ?>
        </table>


        <div class="detilgrup">
            <div style="width: 100%; ">
                <table border="1" style="margin: 0 auto; ">
                    <tr>
                        <th colspan="2">Event</th>
                    </tr>
                    <?php if ($isPembuatGrup) { ?>
                        <tr>
                            <th colspan="2"><a style="color:green;" href="insertevent.php?id=<?= $_GET['id'] ?>">Tambah Event</a></th>
                        </tr>
                    <?php } ?>
                    
                    <!-- diloop berdasarkan data event -->
                    <?php
                    $result = $objEvent->getGrupEvent($_GET['id']);
                    while ($event = $result->fetch_assoc()) {
                        $imgSrc = 'gambar/event/' . $event['idevent'] . '.' . $event['poster_extension'];
                        echo '<tr>
                                <td>
                                    <div style="display:flex; gap:1rem; align-items:center;">
                                        <div style="flex:0 0 120px; height:80px; overflow:hidden; border:1px solid #ddd;">
                                            <img src="'.$imgSrc. '" alt="' . $event['judul'] . '" style="width:100%; height:100%; object-fit:cover; display:block;">
                                        </div>
                                        <div style="flex:1;">
                                            <strong>' . $event['judul'] . '</strong><br>
                                            Tanggal: ' . $event['tanggal'] . '<br>
                                            Jenis: ' . $event['jenis'] . '
                                        </div>
                                    </div>
                                </td>';

                            if($isPembuatGrup){
                                echo '
                                    <td style="width: 1rem;">
                                        <a href="editevent.php?id=' . $event['idevent'] . '">
                                            Edit
                                        </a>
                                        <a href="delevent.php?id=' . $event['idevent'] . '">
                                            Delete
                                        </a>
                                    </td>';
                            }
                        echo'</tr>';
                    }
                    ?>
                    <tr>
                        <td colspan="2">ujung event</td>
                    </tr>
                </table>
            </div>

            <div style="width: 100%;">
                <table border="1" style="margin: 0 auto; ">
                    <tr>
                        <th colspan='2' >Anggota</th>
                    </tr>
                    <?php if ($isPembuatGrup) { ?>
                        <tr>
                            <th colspan="2"><a style="color:green;" href="insertmember.php?id=<?= $_GET['id'] ?>">Tambah Anggota</a></th>
                        </tr>
                    <?php } ?>
                    <!-- diloop berdasarkan data anggota -->
                    <?php
                    $result = $objGrup->getMemberList($_GET['id']);
                    if ($isPembuatGrup){
                        while ($member = $result->fetch_assoc()) {
                            echo '<tr >
                                    <td>' . $member['username'] . '</td>
                                    <td style="width: 1rem;"> <a href="delgrup.php?user=' . $member['username'] . '&id=' . $_GET['id'] . '" onclick="return confirm(\'Yakin hapus anggota ini?\');">Keluar</a> </td>
                                </tr>';
                        }
                    }
                    else {
                        while ($member = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>' . $member['username'] . '</td>
                                </tr>';
                        }
                    }

                    ?>
                    <tr>
                        <td colspan="2">ujung anggota</td>
                    </tr>
                </table>
            </div>

             <div style="width: 100%;"> //! UNTUK THREAD BLM SELESAI
                <table border="1" style="margin: 0 auto; ">
                    <tr>
                        <th colspan='2' >Thread</th>
                    </tr>
                    <tr>
                        <th colspan="2"><a style="color:green;" href="????.php?id=<?= $_GET['id'] ?>">Tambah Thread</a></th> //! BLM DIHUBUNGKAN KE HALAMAN tambah THREAD
                    </tr>
                    <?php
                    $result = $objThread->getThreadList($_GET['id']);

                    while ($threadInfo = $result->fetch_assoc()) {
                        if ($_SESSION['username'] == $threadInfo['username_pembuat'] && $threadInfo['status'] == "Open"){
                            echo '<tr >
                                    <td><h3>' . $threadInfo['username_pembuat'] . '</h3><h6>'. $threadInfo['tanggal_pembuatan'] .'</h6></td>
                                    <td style="width: 1rem;"> <a href="close_thread.php?id=' . $threadInfo['idthread'] . '">Tutup</a> ----- <a href="?????.php?id=' . $threadInfo['idthread'] . '">Lihat</a> </td>
                                </tr>'; //! BLM DIHUBUNGKAN KE HALAMAN DETAIL THREAD DAN TUTUP THREADNYA  ===>> DIHALAMAN DETAIL THREAD, KALO STATUSNYA OPEN, BARU BISA CHAT, KALO CLOSE, TIDAK BISA CHAT
                        }
                        else {
                            echo '<tr>
                                    <td><h3>' . $threadInfo['username_pembuat'] . '</h3><h6>'. $threadInfo['tanggal_pembuatan'] .'</h6></td> 
                                    <td style="width: 1rem;"> <a href="?????.php?id=' . $threadInfo['idthread'] . '">Lihat</a> </td>
                                </tr>'; //! BLM DIHUBUNGKAN KE HALAMAN DETAIL THREAD THREADNYA ===>> DIHALAMAN DETAIL THREAD, KALO STATUSNYA OPEN, BARU BISA CHAT, KALO CLOSE, TIDAK BISA CHAT
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="2">ujung Thread</td>
                    </tr>
                </table>
            </div>

        </div>

    </div>

</body>

</html>