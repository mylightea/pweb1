<?php 
include 'Latihan_09_config.php'; 

// Handle form submission for adding a job
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $judul_pekerjaan = $_POST['judul_pekerjaan'];
    $perusahaan = $_POST['perusahaan'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "INSERT INTO bursa_kerja (judul_pekerjaan, perusahaan, deskripsi) VALUES ('$judul_pekerjaan', '$perusahaan', '$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Lowongan berhasil ditambahkan.</div>"; 
    } else {
        echo "<div class='alert alert-danger'>Error: ".$sql."<br>".$conn->error."</div>";
    }
}

// Handle job deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM bursa_kerja WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Lowongan berhasil dihapus.</div>"; 
    } else {
        echo "<div class='alert alert-danger'>Error: ".$conn->error."</div>";
    }
}

// Fetch all job listings
$sql = "SELECT * FROM bursa_kerja ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Bursa Kerja</title>
</head>
<body>

<div class="container mt-5"> 
    <h2 class="mb-4 text-center">Bursa Kerja</h2>
    
    <!-- Job Listing Form -->
    <form method="POST" action="" class="mb-4">
        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" id="judul_pekerjaan" name="judul_pekerjaan" placeholder="Judul Pekerjaan" required>
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" id="perusahaan" name="perusahaan" placeholder="Perusahaan" required>
            </div>
            <div class="col-md-4 mb-3">
                <button type="submit" name="add" class="btn btn-primary">Tambah Lowongan</button>
            </div>
        </div>
        <div class="mb-3">
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi" required></textarea>
        </div>
    </form>

    <h3 class="mt-5">Lowongan Pekerjaan yang Tersedia</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama Pekerjaan</th>
                    <th>Perusahaan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Posting</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['judul_pekerjaan']); ?></td>
                            <td><?php echo htmlspecialchars($row['perusahaan']); ?></td>
                            <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_posting']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Belum ada lowongan yang ditambahkan.</td></tr>";
                } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $conn->close(); ?>

</body>
</html>