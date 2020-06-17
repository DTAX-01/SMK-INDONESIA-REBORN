<?php
include("../config/lib.php");

if (isset($_POST["simpan"])) {
    $kelas = safeData($_POST["kelas"]);
    $guru = safeData($_POST["guru"]);

    $sql = "INSERT INTO jadwal (id_jdwl, id_mg, kode_kelas, sts_jadwal) VALUES (NULL, '$guru', '$kelas', 1)";

    $q = executeSQL($sql); // eksekusi yg pertama

    if ($q) { // jika keduanya berhasil di eksekusi
        header("location:jadwal.php"); // maka pindah ke halaman siswa.php
    }

}

// buat sql untuk mengisi select option nya nanti.
$sql = "SELECT * FROM mapel_guru NATURAL JOIN mapel NATURAL JOIN guru WHERE sts_mg=1 AND sts_mapel=1 AND sts_guru=1";
$sql1 = "SELECT * FROM kelas NATURAL JOIN prodi WHERE sts_kelas = 1 AND sts_prodi = 1";

// panggil $q dan $q1 nanti dibawah ketika looping select option
$q = executeSQL($sql);
$q1 = executeSQL($sql1);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD ADMIN</title>
</head>
<body>
    <h1>Jadwal Add</h1>
    <form method="POST">
        <label for="">Guru</label><br/>
        <select name="guru" id="">
            <?php 
            foreach ($q as $k => $v) {
                $kode = $v["id_mg"];
                $nama = $v["nama_guru"];
                $mapel = $v["nama_mapel"];
                ?>
                <option value="<?php echo $kode ?>">
                    <?php echo $nama . " - " . $mapel ?>
                </option>
            <?php 
        }
        ?>
        </select><br/><br/>
        <label for="">Kelas</label><br/>
        <select name="kelas" id="">
            <?php 
            foreach ($q1 as $k => $v) {
                $kode = $v["kode_kelas"];
                $nama = $v["nama_prodi"];
                $kelas = $v["kelas"];
                $nama = $v["nama_prodi"];
                $ket = $v["ket"];
                $gabung = $kelas . " " . $nama . " " . $ket;
                ?>
                <option value="<?php echo $kode ?>">
                    <?php echo $gabung ?>
                </option>
            <?php 
        }
        ?>
        </select><br/><br/>
        <input type="submit" name="simpan" value="Simpan"> &nbsp;&nbsp;
        <a href="jadwal.php">Kembali</a>
    </form>
</body>
</html>