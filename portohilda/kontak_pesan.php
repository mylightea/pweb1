<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kontak";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$namalengkap = $_POST['namalengkap'];
$email = $_POST['email'];
$notelepon = $_POST['notelepon'];
$pesan = $_POST['pesan'];

// Query untuk menyimpan data
$sql = "INSERT INTO kontak (nama_lengkap, email, no_telepon, pesan) VALUES ('$namalengkap', '$email', '$notelepon', '$pesan')";

if ($conn->query($sql) === TRUE) {
    // Redirect ke halaman contact.html dengan query string
    header("Location: contact.html?action=terkirim");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>