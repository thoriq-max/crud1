<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'config.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$success = $error = "";

if (isset($_POST['import'])) {
    $file = $_FILES['file']['tmp_name'];

    if ($file) {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        $rowStart = 2; // mulai dari baris kedua (baris pertama biasanya header)

        for ($i = $rowStart; $i < count($sheet); $i++) {
            $nama = $sheet[$i][0];
            $nim = $sheet[$i][1];
            $jurusan = $sheet[$i][2];

            if ($nama && $nim && $jurusan) {
                mysqli_query($conn, "INSERT INTO mahasiswa (nama, nim, jurusan) VALUES ('$nama', '$nim', '$jurusan')");
            }
        }

        $success = "Data berhasil diimport!";
    } else {
        $error = "File tidak ditemukan atau salah format.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Import Excel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Import Data Mahasiswa dari Excel</h3>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Upload File Excel (.xlsx)</label>
            <input type="file" name="file" class="form-control" accept=".xlsx" required>
        </div>
        <button name="import" class="btn btn-primary">Import</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
