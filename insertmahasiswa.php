<?php
session_start();

if ($_SESSION['admin'] == 0) {
	require_once('service/404.php');
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projek UTS - Input Mahasiswa</title>
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
	<?php include('header.php'); ?>
	<div class="style">
		<div class="container">
			<h2>Input Data Mahasiswa</h2>
			<form method="post" enctype="multipart/form-data" action="insertmahasiswa_proses.php" onsubmit="return validateForm()">
				<label>NRP:</label>
				<input type="text" maxlength="9" name="txt_nrp" id="txt_nrp">

				<label>Nama:</label>
				<input type="text" name="txt_nama" id="txt_nama">

				<label>Password:</label>
				<input type="password" name="txt_password" placeholder="buat password" required>

				<label>Gender:</label><br>
				<div style="display: flex; gap: 10px; align-items: center;">
					<label><input type="radio" name="rad_gender" value="Pria"> Pria</label>
					<label><input type="radio" name="rad_gender" value="Wanita"> Wanita</label>
				</div>
				<br><br>

				<label>Tanggal Lahir:</label>
				<input type="date" name="date_tanggal_lahir" id="date_tanggal_lahir">

				<label>Angkatan:</label>
				<input type="text" name="txt_angkatan" id="txt_angkatan">

				<label>Gambar:</label>
				<input type="file" name="img_gambar" accept="image/*">

				<input type="submit" name="submit" value="Insert Mahasiswa">
			</form>
		</div>
	</div>

	<script>
		function validateForm() {
			var nrp = $("#txt_nrp").val();
			var nama = $("#txt_nama").val();
			var tanggalLahir = $("#date_tanggal_lahir").val();
			var angkatan = $("#txt_angkatan").val();

			if (nrp === "" || nama === "" || tanggalLahir === "" || angkatan === "") {
				alert("Semua field harus diisi!");
				return false;
			}

			if (nrp.length !== 9 || isNaN(nrp)) {
				alert("NRP harus terdiri dari 9 digit angka.");
				return false;
			}

			if (isNaN(angkatan) || angkatan.length !== 4) {
				alert("Angkatan harus berupa tahun 4 digit.");
				return false;
			}

			return true;
		}
	</script>
</body>

</html>