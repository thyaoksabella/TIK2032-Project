<?php
include 'koneksi.php';

// Proses form tambah artikel
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

// Ambil semua artikel dari database
$query = "SELECT * FROM blog ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Blog</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="gallery.html">Gallery</a>
            <a href="blog.php">Blog</a>
            <a href="contact.html">Contact</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Artikel Terbaru</h2>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <article class="blog-post">
                    <h3><?= htmlspecialchars($row['judul']) ?></h3>
                    <small><?= $row['tanggal'] ?></small>
                    <p><?= nl2br(htmlspecialchars($row['konten'])) ?></p>
                </article>
            <?php endwhile; ?>
        </section>

        <section class="form-artikel">
            <h2>Tambah Artikel Baru</h2>
            <?php if (isset($pesan)) echo "<p>$pesan</p>"; ?>
            <form method="post" action="">
                <label for="judul">Judul:</label><br>
                <input type="text" id="judul" name="judul" required><br><br>

                <label for="konten">Konten:</label><br>
                <textarea id="konten" name="konten" rows="8" cols="50" required></textarea><br><br>

                <input type="submit" value="Tambah Artikel">
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Thya Oksabella Biringpasemba</p>
    </footer>
</body>
</html>
