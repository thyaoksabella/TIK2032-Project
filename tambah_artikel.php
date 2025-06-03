<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $konten = mysqli_real_escape_string($conn, $_POST['konten']);

    $sql = "INSERT INTO blog (judul, konten) VALUES ('$judul', '$konten')";
    if (mysqli_query($conn, $sql)) {
        $pesan = "Artikel berhasil ditambahkan!";
    } else {
        $pesan = "Gagal menambahkan artikel: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Artikel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Artikel Blog</h1>

    <?php if (isset($pesan)) echo "<p>$pesan</p>"; ?>

    <form method="post" action="">
        <label for="judul">Judul:</label><br>
        <input type="text" id="judul" name="judul" required><br><br>

        <label for="konten">Konten:</label><br>
        <textarea id="konten" name="konten" rows="8" cols="50" required></textarea><br><br>

        <input type="submit" value="Tambah Artikel">
    </form>

    <p><a href="blog.php">Lihat Semua Artikel</a></p>
</body>
</html>
