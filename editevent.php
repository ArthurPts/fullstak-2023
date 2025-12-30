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
} elseif (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$idevent = $_GET['id'];

$result = $objEvent->getEventDetail($idevent);
$dataEvent = $result->fetch_assoc();

if (!$dataEvent) {
    header("Location: index.php");
    exit();
}

$message = "";

if (isset($_POST['submit'])) {
    $idevent = $_POST['txtidevent'];
    $judul = $_POST['txtjudul'];
    $judul_slug = $_POST['txtslug'];
    $tanggal = $_POST['txttanggal'];
    $keterangan = $_POST['txtketerangan'];
    $jenis = $_POST['rad_jenis'];

    $poster_extension = $dataEvent['poster_extension'];
    $uploadDir = 'gambar/event/';

    if (isset($_FILES['fileposter']) && $_FILES['fileposter']['error'] == 0) {

        $fileInfo = pathinfo($_FILES['fileposter']['name']);
        $poster_extension = strtolower($fileInfo['extension']);

        $temp_file_name = $idevent . "." . $poster_extension;
        $uploadPath = $uploadDir . $temp_file_name;

        if (!move_uploaded_file($_FILES['fileposter']['tmp_name'], $uploadPath)) {
            die("Failed to upload file!");
        }
    }

    if ($objEvent->updateEvent(
        $idevent,
        $judul,
        $judul_slug,
        $tanggal,
        $keterangan,
        $jenis,
        $poster_extension
    )) {
        echo "<script>alert('Event berhasil diperbarui!');</script>";
    }

    header("Location: tampilangrup.php?list=5");
    exit();
}

$tanggal_input = date("Y-m-d\TH:i", strtotime($dataEvent['tanggal']));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('header.php'); ?>

    <div class="style">
        <div class="container">
            <h2>Edit Event</h2>

            <form method="post" action="editevent.php?id=<?php echo $idevent; ?>" enctype="multipart/form-data" onsubmit="return validateForm()">

                <input type="hidden" name="txtidevent" value="<?php echo $idevent; ?>">

                <div>
                    <label for="judul">Judul Event:</label>
                    <input type="text" id="judul" name="txtjudul" maxlength="45" required
                        value="<?php echo htmlspecialchars($dataEvent['judul']); ?>">
                </div>

                <div>
                    <label for="slug">Judul Slug:</label>
                    <input type="text" id="slug" name="txtslug" maxlength="45" required
                        value="<?php echo htmlspecialchars($dataEvent['judul-slug']); ?>">
                </div>

                <div>
                    <label for="tanggal">Tanggal & Waktu Event:</label>
                    <input type="datetime-local" id="tanggal" name="txttanggal" required
                        value="<?php echo $tanggal_input; ?>">
                </div>

                <div>
                    <label for="keterangan">Keterangan/Deskripsi:</label>
                    <textarea id="keterangan" name="txtketerangan" rows="5" required><?php echo htmlspecialchars($dataEvent['keterangan']); ?></textarea>
                </div>

                <label>Jenis:</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <label><input type="radio" name="rad_jenis" value="Privat" <?php echo ($dataEvent['jenis'] == 'Privat') ? 'checked' : ''; ?>> Privat</label>
                    <label><input type="radio" name="rad_jenis" value="Publik" <?php echo ($dataEvent['jenis'] == 'Publik') ? 'checked' : ''; ?>> Publik</label>
                </div>

                <div>
                    <label for="fileposter">Poster Event (Opsional):</label>
                    <input type="file" id="fileposter" name="fileposter" accept=".jpg,.jpeg,.png,.gif">
                    <br>
                    <img src="gambar/event/<?php echo $idevent . "." . $dataEvent['poster_extension']; ?>"
                        style="height: 7rem; margin-top: 10px;" alt="Poster Event">
                </div>

                <input type="submit" name="submit" value="Update Event">
            </form>

            <a href="tampilan_eventmu.php">⬅ Kembali</a>
        </div>
    </div>

    <script>
        function validateForm() {
            const judul = $('#judul').val();
            const tanggal = $('#tanggal').val();
            const keterangan = $('#keterangan').val();
            const jenis = $('input[name="rad_jenis"]:checked').val();
            const filePoster = $('#fileposter');

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
                alert("Pilih jenis event!");
                return false;
            }

            const maxFileSize = 4 * 1024 * 1024; // 4MB
            if (filePoster[0].files.length > 0 && filePoster[0].files[0].size > maxFileSize) {
                alert("Ukuran file poster terlalu besar. Maksimal 4MB.");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>