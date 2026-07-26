<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?? 'E-Parkir Mahasiswa'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #eef2f8 !important;
            overflow-x: hidden;
        }
        .main-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content-area {
            flex: 1;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <nav class="navbar navbar-dark bg-primary px-4 py-3 shadow-sm">
            <div class="container-fluid px-0">
                <span class="navbar-brand fw-bold fs-5">E-Parking Mahasiswa</span>
            </div>
        </nav>

        <div class="content-area">