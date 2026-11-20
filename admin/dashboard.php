<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/dashboard.css">
    
</head>
<body>

<div class="container mt-4">
    <div class="dashboard-title"></div>

    <!-- Stat Boxes -->
    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="stat-box">
                <div>Sudah Absen</div>
                <div>20</div> <!-- Replace with PHP variable if dynamic -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div>Tidak Absen</div>
                <div>30</div> <!-- Replace with PHP variable if dynamic -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div>Laki-laki</div>
                <div>100</div> <!-- Replace with PHP variable if dynamic -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div>Perempuan</div>
                <div>200</div> <!-- Replace with PHP variable if dynamic -->
            </div>
        </div>
    </div>

    <!-- Date aligned to the left -->
    <div class="date-container mb-3">Tanggal: 2023-01-01</div>

    <!-- Attendance Table -->
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>Nama Siswa</th>
                    <th>Tanggal Absensi</th>
                    <th>Waktu Absensi</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ivan</td>
                    <td>20-07-2024</td>
                    <td>07.00</td>
                    <td>10A</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
