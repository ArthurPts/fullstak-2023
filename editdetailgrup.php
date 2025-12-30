<?php
session_start();
include_once('service/grup.php');

$objGrup = new grup();
$result = $objGrup->getGrupInfoDetail($_GET['id']);
$info = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $jenis = $_POST['jenis'];

    $objGrup->updateGrup($nama, $deskripsi, $jenis, $_GET['id']);  // sesuaikan nama fungsi update
    header("Location: detilgrup.php?id=" . $_GET['id']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail Grup</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

    <h2>Edit Detail Grup</h2>

    <form method="POST">
        <label>Nama Grup:</label><br>
        <input type="text" name="nama" value="<?= $info['nama'] ?>" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="4" required><?= $info['deskripsi'] ?></textarea><br><br>

        <label>Jenis:</label><br>
        <select name="jenis" required>
            <option value="Publik" <?= $info['jenis'] == "Publik" ? "selected" : "" ?>>Publik</option>
            <option value="Privat" <?= $info['jenis'] == "Privat" ? "selected" : "" ?>>Privat</option>
        </select><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <script src="service/theme.js"></script>
</body>

</html>