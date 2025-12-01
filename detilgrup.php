<?php
session_start();
include_once('service/grup.php');
include_once('service/event.php');

$objGrup = new grup();
$objEvent = new event();

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
$isPembuat = ($_SESSION['username'] == $info['username_pembuat']);
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


        <div style="display: flex; width: 100%; margin-top: 2rem; padding: 0 4rem; box-sizing: border-box;">
            <div style="width: 100%; ">
                <table border="1" style="margin: 0 auto; ">
                    <tr>
                        <th colspan="2">Event</th>
                    </tr>
                    <?php if ($isPembuat) { ?>
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

                            if($isPembuat){
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
                    <?php if ($isPembuat) { ?>
                        <tr>
                            <th colspan="2"><a style="color:green;" href="insertmember.php?id=<?= $_GET['id'] ?>">Tambah Anggota</a></th>
                        </tr>
                    <?php } ?>
                    <!-- diloop berdasarkan data anggota -->
                    <?php
                    $result = $objGrup->getMemberList($_GET['id']);
                    if ($isPembuat){
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

        </div>

    </div>

</body>

</html>