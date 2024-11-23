<?php
include("koneksi.php");
$query = "SELECT * FROM siswa";
$result = mysqli_query($koneksi, $query);
$db = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="card mb-5">
            <div class="card-header">
                <h2 class="text-center">CRUD</h2>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            TAMBAH
        </button>
        <div class="card-body">
            <table class="table table-striped table-bordered text-center ">

                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>Aksi</th>
                </tr>
                <?php
                foreach ($db as $no => $row) {
                    ?>

                    <tr>
                        <td><?php echo $no + 1; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['jenis_kelamin']; ?></td>
                        <td><?php echo $row['umur']; ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                               <!-- Tombol Pemicu Modal untuk Edit -->
<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">
    <i class="fa-solid fa-pen"></i> Edit
</button>

<!-- Modal untuk Edit Data -->
<div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="update.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?php echo $row['id']; ?>">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input Hidden untuk ID -->
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="nama<?php echo $row['id']; ?>" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama<?php echo $row['id']; ?>" name="nama" value="<?php echo $row['nama']; ?>" required>
                    </div>

                    <!-- Input Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="jenis_kelamin<?php echo $row['id']; ?>" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin<?php echo $row['id']; ?>" name="jenis_kelamin" required>
                            <option value="Laki-Laki" <?php echo ($row['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo ($row['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <!-- Input Umur -->
                    <div class="mb-3">
                        <label for="umur<?php echo $row['id']; ?>" class="form-label">Umur</label>
                        <input type="number" class="form-control" id="umur<?php echo $row['id']; ?>" name="umur" value="<?php echo $row['umur']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

                                <!-- Button trigger modal for Delete -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                                <!-- Add a separate delete confirmation modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-danger">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA SISWA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="creat.php" method="post">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">ID</label>
                                    <input type="number" name="id" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="laki-laki">laki-laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">umur</label>
                                    <input type="number" name="umur" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpam</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>