<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "crud");

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];

    // Query untuk update data
    $query = "UPDATE siswa SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', umur = '$umur' WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Data berhasil diperbarui');
            window.location.replace('index.php');
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Ambil Data Berdasarkan ID (untuk diisi di Form)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id = '$id'");
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>
            alert('Data tidak ditemukan');
            window.location.replace('index.php');
        </script>";
    }
}
?>