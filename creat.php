<?php
require_once("koneksi.php");
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];
    $query = "INSERT INTO 
        siswa(id,nama,jenis_kelamin,umur)
        values ('$id','$nama','$jenis_kelamin','$umur')";
    mysqli_query($koneksi, $query);
    echo "<script> alert ('Berhasil input data siswa');
    window.location.replace('index.php');
    </script>";
}

?>