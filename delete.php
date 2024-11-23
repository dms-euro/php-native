<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "crud");

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses penghapusan data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM siswa WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Data berhasil dihapus');
            window.location.replace('index.php');
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan');
        window.location.replace('index.php');
    </script>";
}
?>