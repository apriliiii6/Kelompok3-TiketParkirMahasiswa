<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$homeUrl = 'index.php?url=auth/index';
if (isset($_SESSION['role'])) {
    if (strtolower($_SESSION['role']) === 'admin') {
        $homeUrl = 'index.php?url=parkir/index';
    } elseif (strtolower($_SESSION['role']) === 'mahasiswa') {
        $homeUrl = 'index.php?url=parkir/tambah';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Parkir Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4" href="<?= $homeUrl; ?>">
        E-Parking
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto ms-3">
        <?php if (isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="index.php?url=parkir/index">Data Parkir</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" href="index.php?url=parkir/scan">Scan QR</a>
          </li>
        <?php elseif (isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'mahasiswa'): ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="index.php?url=parkir/tambah">Buat Tiket</a>
          </li>
        <?php endif; ?>
      </ul>

      <?php if (isset($_SESSION['role'])): ?>
        <div class="d-flex align-items-center gap-3">
          <span class="text-white small">
            Login sebagai: <strong><?= htmlspecialchars($_SESSION['username'] ?? 'april admin'); ?></strong> (<?= ucfirst($_SESSION['role']); ?>)
          </span>
          <a href="index.php?url=auth/logout" 
             class="btn btn-outline-light btn-sm px-3" 
             onclick="return confirm('Apakah Anda yakin ingin keluar?')">
             Logout
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container">