<?php 
include 'Latihan_09_config.php'; 

// Handle form submission for searching alumni
$search_results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search_query = $_POST['search_query'];

    $sql = "SELECT * FROM alumni WHERE nama LIKE '%$search_query%' OR jurusan LIKE '%$search_query%' ORDER BY id DESC";
    $search_results = $conn->query($sql);
}

// Fetch all alumni for display if no search is performed
if (empty($search_results)) {
    $sql = "SELECT * FROM alumni ORDER BY id DESC";
    $search_results = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Pencarian Alumni</title>
</head>
<body>

<div class="container mt-5"> 
    <h2 class="mb-4 text-center">Penelusuran Alumni</h2>
    
    <!-- Search Form -->
    <form method="POST" action="" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="search_query" placeholder="Cari alumni berdasarkan nama atau jurusan" required>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="search">Cari</button>
            </div>
        </div>
    </form>

    <h3 class="mt-5">Hasil Pencarian Alumni</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Tahun Lulus</th>
                    <th>Jurusan</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($search_results->num_rows > 0) {
                    $no = 1;
                    while ($row = $search_results->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['tahun_lulus']); ?></td>
                            <td><?php echo htmlspecialchars($row['jurusan']); ?></td>
                            <td>
                                <?php if (!empty($row['foto'])): ?>
                                    <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Alumni" style="width: 50px; height: auto;">
                                <?php else: ?>
                                    Tidak ada foto
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada alumni ditemukan.</td></tr>";
                } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $conn->close(); ?>

</body>
</html>