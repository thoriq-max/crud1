<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

// Pencarian
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Hitung total data
$total_result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%'");
$total = mysqli_num_rows($total_result);
$pages = ceil($total / $limit);

// Ambil data dengan limit
$query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' LIMIT $start, $limit";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Data Mahasiswa</h3>

    <form class="d-flex mb-3" method="GET">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari nama..." value="<?= $keyword ?>">
        <button class="btn btn-outline-success" type="submit">Cari</button>
    </form>

    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>
    <a href="import.php" class="btn btn-secondary mb-3">📂 Import Excel</a>
    <a href="logout.php" class="btn btn-danger mb-3 float-end">Logout</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = $start + 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= $keyword ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
</html>
