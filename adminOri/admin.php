<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="dasboardUtama.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #video {
            transform: scaleX(-1); /* Membuat tampilan kamera menjadi mirror */
            width: 640px;
            height: 480px;
        }
        #canvas {
            display: none;
        }
        #status {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include 'navbar.php'; ?>
            <div class="mx-auto my-5 row col-9">
                <div>
                    <div class="col-md-12 text-center mt-3">
                        <h1 class="display-12">Selamat Datang!</h1>
                        <p class="lead">Di Dashboard Admin</p>
                    </div>
                    <div class="info-box mt-5 ml-4">
                        <video id="video" autoplay></video>
                        <canvas id="canvas" style="display:none;"></canvas>
                        <div id="status"></div>

                        <script>
                            const video = document.getElementById('video');
                            const canvas = document.getElementById('canvas');
                            const context = canvas.getContext('2d');
                            const statusDiv = document.getElementById('status');

                            // Akses kamera
                            navigator.mediaDevices.getUserMedia({ video: true })
                                .then(stream => {
                                    video.srcObject = stream;
                                })
                                .catch(err => {
                                    console.error("Error accessing camera:", err);
                                    statusDiv.innerHTML = "Error accessing camera.";
                                });

                            function captureAndSend() {
                                context.save();
                                context.scale(-1, 1); // Membalik gambar di canvas agar mirror
                                context.drawImage(video, -canvas.width, 0, canvas.width, canvas.height);
                                context.restore();
                                const imageData = canvas.toDataURL('image/jpeg');

                                $.ajax({
                                    url: 'http://localhost:5000/absen',
                                    method: 'POST',
                                    contentType: 'application/json',
                                    data: JSON.stringify({ image: imageData }),
                                    headers: {
                                        'Access-Control-Allow-Origin': '*'
                                    },
                                    success: function(response) {
                                        context.clearRect(0, 0, canvas.width, canvas.height);
                                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                                        if (response.status === "success" && response.faces) {
                                            response.faces.forEach(face => {
                                                context.strokeStyle = "green";
                                                context.lineWidth = 2;
                                                context.strokeRect(face.x, face.y, face.w, face.h);
                                                context.font = "16px Arial";
                                                context.fillStyle = "green";
                                                context.fillText(face.name, face.x, face.y - 10);
                                            });
                                        }
                                        statusDiv.innerHTML = response.message;
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Error:", error);
                                        statusDiv.innerHTML = "Error sending data.";
                                    }
                                });
                            }

                            // Kirim gambar setiap 5 detik
                            setInterval(captureAndSend, 5000);
                        </script>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal Absensi</th>
                                        <th>Waktu Absensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once("koneksi.php");

                                    $query = "SELECT * FROM absen ORDER BY tanggal DESC, jam DESC";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                        $index = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            $time = strtotime($row["jam"]);
                                            $pagi_mulai = strtotime("05:00");
                                            $pagi_selesai = strtotime("08:00");
                                            $siang_selesai = strtotime("16:00");

                                            if ($time >= $pagi_mulai && $time <= $pagi_selesai) {
                                                $warna = "background-color: green;";
                                            } else {
                                                $warna = "background-color: red";
                                            }
                                    ?>
                                            <tr>
                                                <td><?php echo $index; ?></td>
                                                <td><?php echo $row["nama"]; ?></td>
                                                <td><?php echo $row["tanggal"]; ?></td>
                                                <td style="<?php echo $warna; ?>"><?php echo $row["jam"]; ?></td>
                                            </tr>
                                    <?php
                                            $index++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>Tidak ada data yang ditemukan</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function absen() {
            fetch("http://localhost:5000/absen")
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Menampilkan pesan sukses atau gagal dari server
                    if (data.status === "success") {
                        location.reload(); // Memuat ulang halaman jika absen berhasil
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>