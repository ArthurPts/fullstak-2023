<?php
session_start();
include_once('service/event.php');

$objEvent = new event();

if (!isset($_SESSION['login'])) {
    header("Location: login_temp.php");
    exit();
} elseif (($_SESSION['username'][0] === 'D') == false) {
    header("Location: index.php");
    exit();
}

$message = '';
if (isset($_POST['submit'])) {
    $idgrup = $_POST['txtidgrup'];
    $judul = $_POST['txtjudul'];
    $tanggal = $_POST['txttanggal'];
    $keterangan = $_POST['txtketerangan'];
    $jenis = $_POST['rad_jenis'];
    $judul_slug = $_POST['txtslug'];

    $poster_extension = '';
    $upload_success = true;
    $uploadDir = 'gambar/event/';

    if (isset($_FILES['fileposter']) && $_FILES['fileposter']['error'] == 0) {

        $fileInfo = pathinfo($_FILES['fileposter']['name']);
        $poster_extension = strtolower($fileInfo['extension']);

        $eventID = $objEvent->insertEvent(
            $idgrup,
            $judul,
            $judul_slug,
            $tanggal,
            $keterangan,
            $jenis,
            $poster_extension
        );

        $temp_file_name = $eventID . '.' . $poster_extension;
        $uploadPath = $uploadDir . $temp_file_name;

        if (!move_uploaded_file($_FILES['fileposter']['tmp_name'], $uploadPath)) {
            die("Failed to upload file!");
        }

        echo "<script>alert('Event berhasil dibuat!');</script>";
    }
    header("Location: detilgrup.php?id=" . $idgrup);
    exit();
}
$tglDefault = date("Y-m-d\TH:i");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Event Baru</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('header.php'); ?>

    <div class="style">
        <div class="container">
            <h2>Buat Event Baru</h2>

            <form method="post" action="insertevent.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                <input type="hidden" name="txtidgrup" value="<?php echo $_GET['id']; ?>">

                <div>
                    <label for="judul">Judul Event:</label>
                    <input type="text" id="judul" name="txtjudul" maxlength="45" required>
                </div>

                <div>
                    <label for="judul">Judul slug:</label>
                    <input type="text" id="slug" name="txtslug" maxlength="45" required>
                </div>

                <div>
                    <label for="tanggal">Tanggal & Waktu Event:</label>
                    <input type="datetime-local" id="tanggal" name="txttanggal" value="<?php echo $tglDefault; ?>" required>
                </div>

                <div>
                    <label for="keterangan">Keterangan/Deskripsi:</label>
                    <textarea id="keterangan" name="txtketerangan" rows="5" required></textarea>
                </div>

                <label>Jenis:</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <label><input type="radio" name="rad_jenis" value="Privat"> Privat</label>
                    <label><input type="radio" name="rad_jenis" value="Publik"> Publik</label>
                </div>

                <div>
                    <label for="fileposter">Poster Event (Max 4MB):</label>
                    <input type="file" id="fileposter" name="fileposter" accept=".jpg,.jpeg,.png,.gif" required>
                </div>

                <input type="submit" name="submit" value="Insert Event">
            </form>

            <a href="detilgrup.php?id=<?= $_GET['id'] ?>">⬅ Kembali</a>
        </div>
    </div>

    <script>
        function validateForm() {
            const judul = $('#judul').val();
            const tanggal = $('#tanggal').val();
            const keterangan = $('#keterangan').val();
            const jenis = $('input[name="rad_jenis"]:checked').val();
            const fileInput = $('#fileposter');
            const filePoster = fileInput.val();

            if ($.trim(judul) === "") {
                alert("Judul Event tidak boleh kosong!");
                return false;
            }

            if ($.trim(tanggal) === "") {
                alert("Tanggal Event tidak boleh kosong!");
                return false;
            }

            if ($.trim(keterangan) === "") {
                alert("Keterangan tidak boleh kosong!");
                return false;
            }

            if (!jenis) {
                alert("Harap pilih Jenis Event!");
                return false;
            }

            if (filePoster === "") {
                alert("Harap unggah Poster Event!");
                return false;
            }

            const maxFileSize = 4 * 1024 * 1024; // 4MB
            if (fileInput[0].files.length > 0 && fileInput[0].files[0].size > maxFileSize) {
                alert("Ukuran file poster terlalu besar. Maksimal 4MB.");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>