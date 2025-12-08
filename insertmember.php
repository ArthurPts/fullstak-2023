<?php
session_start();

include_once('service/grup.php');

$objGrup = new grup();

if (!isset($_SESSION['login'])) {
    header("Location: login_temp.php");
    exit();
} elseif (!($_SESSION['username'][0] === 'D')) {
    header("Location: index.php");
    exit();
}
if (isset($_GET['search'])) {
    $result = $objGrup->nonMemberList($_GET['id'], $_GET['search']);
} else {
    $result = $objGrup->nonMemberList($_GET['id']);
}

//$nonMember = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota Grup</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="styleTampilan">

        <div style="width: 50%;">
            <table border="1" style="margin: 0 auto; ">
                <tr>
                    <td colspan="2">
                        <input type="text" id="searchBox" placeholder="Search..."
                            value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        
                    </td>
                    <td>
                        <input type="button" onclick="refreshWithSearch()" value="SEARCH">
                    </td>
                </tr>
                <tr>
                    <th colspan='3'>Daftar Non-Anggota</th>
                </tr>
                <tr>
                    <th>nrp/npk</td=>
                    <th>nama</td=>
                    <th>aksi</td=>
                </tr>

                <?php
                while ($nonMember = $result->fetch_assoc()) {
                    echo '<tr >
                                <td>' . $nonMember['nomor'] . '</td>
                                <td>' . $nonMember['nama'] . '</td>
                                <td style="width: 5rem;"> <a href="insertmember_proses.php?user=' . $nonMember['username'] . '&id=' . $_GET['id'] . ';">Tambahkan ke grup</a> </td>
                            </tr>';
                }
                ?>
            </table>
        </div>

    </div>
    <script>
        function refreshWithSearch() {
            const search = document.getElementById("searchBox").value;
            const id = "<?php echo $_GET['id']; ?>"; // keep existing id

            window.location.href = `insertmember.php?id=${id}&search=${encodeURIComponent(search)}`;
        }
    </script>
</body>

</html>