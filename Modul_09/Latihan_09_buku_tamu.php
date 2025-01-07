<?php 
include 'Latihan_09_config.php'; // Memasukkan file konfigurasi untuk koneksi database

// Menangani pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];

    // Masukkan data ke database
    $sql = "INSERT INTO buku_tamu (nama, pesan) VALUES ('$nama', '$pesan')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Pesan berhasil dikirim.</div>"; 
    } else {
        echo "<div class='alert alert-danger'>Error: ".$sql."<br>".$conn->error."</div>";
    }
}

// Ambil semua pesan dari database
$sql = "SELECT * FROM buku_tamu ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="container mt-5"> 
    <h2 class="mb-4">Buku Tamu</h2>
    
    <!-- Form Buku Tamu -->
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="pesan" class="form-label">Pesan</label>
            <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
    </form>

    <h3 class="mt-5">Pesan yang Dikirim</h3>
    <div class="list-group">
        <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <div class="list-group-item">
                    <strong><?php echo $row['nama']; ?></strong>
                    <p><?php echo $row['pesan']; ?></p>
                </div>
            <?php }
        } else {
            echo "<div class='alert alert-info'>Belum ada pesan yang dikirim.</div>";
        } ?>
    </div>
</div>

<?php $conn->close(); ?>