  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" />
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
      #video {
        transform: scaleX(-1);
        /* Membuat tampilan kamera menjadi mirror */
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

  <body
    class="font-sans antialiased bg-gray-50 transition-all duration-300"
    x-data="{ sidebarOpen: false }">
    <div class="relative h-screen">
      <!-- Main Content -->
      <div class="flex-1 transition-all duration-300">
        <?php include 'sidebar.php'; ?>
        <!-- Main Content Area -->
        <main class="h-screen pt-12 flex-1">
          <div class="py-4 h-full">
            <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
              <div
                class="bg-white shadow-sm sm:rounded-lg h-full flex flex-row">
                <!-- Sidebar di sebelah kiri -->
                <div class="basis-4/12 h-full border-r flex flex-col">
                  <div class="p-4 pb-2">
                    <p class="text-muted-foreground">Terbaru</p>
                    <input
                      type="text"
                      name="search"
                      id="search"
                      class="w-full mt-2 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" />
                  </div>

                  <div class="flex-grow p-4 overflow-y-auto">
                    <div
                      class="flex flex-col gap-y-2 max-h-[calc(100vh-240px)]">
                      <!-- Daftar nama -->
                      <?php
                      require_once("koneksi.php");

                      $query = "SELECT 
                                          siswa.id AS siswa_id,
                                          siswa.NISN,
                                          siswa.class AS kelas,
                                          absen.id AS absen_id,
                                          absen.nama AS nama_absen,
                                          absen.tanggal,
                                          absen.jam 
                                      FROM 
                                          siswa
                                      LEFT JOIN 
                                          absen 
                                      ON 
                                          siswa.name = absen.nama
                                      ORDER BY 
                                          absen.tanggal DESC, absen.jam DESC";
                      $result = $conn->query($query);
                      if ($result->num_rows > 0) {
                        // Fetch data from the result set
                        $index = 1;
                        while ($row = $result->fetch_assoc()) {
                      ?>
                          <div
                            x-data="{ open: false }"
                            class="rounded-lg border p-3 text-left text-sm transition-all hover:bg-gray-100">
                            <div
                              @click="open = true"
                              class="flex w-full justify-between gap-1">
                              <div class="flex flex-col space-y-1">
                                <div class="font-semibold"><?php echo $row["nama_absen"]; ?></div>
                                <div class="text-xs"><?php echo $row["kelas"]; ?></div>
                              </div>
                              <div class="flex flex-col space-y-1">
                                <?php
                                $jam = $row["jam"]; // Asumsikan format waktu adalah HH:mm, misalnya "07:30"
                                $time = strtotime($jam); // Mengonversi waktu menjadi timestamp untuk perbandingan
                                $limit = strtotime("08:00"); // Batas waktu terlambat

                                if ($time <= $limit) {
                                  // Tepat Waktu
                                  echo '<div class="text-xs text-right">' . $jam . '</div>';
                                  echo '<div class="ml-auto inline-flex items-center rounded-md bg-green-500 text-white px-2.5 py-0.5 text-xs font-semibold shadow">Tepat Waktu</div>';
                                } else {
                                  // Terlambat
                                  echo '<div class="text-xs text-right">' . $jam . '</div>';
                                  echo '<div class="ml-auto inline-flex items-center rounded-md bg-red-500 text-white px-2.5 py-0.5 text-xs font-semibold shadow">Terlambat</div>';
                                }
                                ?>
                              </div>
                            </div>
                            <!-- Popup dialog overlay and content -->
                            <div
                              x-show="open"
                              x-transition:enter
                              class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50"
                              @click.outside="open = false"
                              style="display: none">
                              <div
                                @click.outside="open = false"
                                class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                                <!-- Close button -->
                                <button
                                  @click="open = false"
                                  class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                </button>

                                <!-- Dialog content -->
                                <div class="mb-4">
                                  <h2 class="text-xl font-semibold text-gray-800">
                                  <?php echo $row["nama_absen"]; ?>
                                  </h2>
                                  <p class="text-sm text-gray-600"><?php echo $row["kelas"]; ?></p>
                                </div>

                                <h5 class="text-gray-600 mb-2">Detail Kehadiran</h5>
                                <div class="grid grid-cols-5 gap-2 mb-8">
                                  <p class="text-black">Tanggal</p>
                                  <p class="col-span-4 text-black">: <?php echo htmlspecialchars($row["tanggal"]); ?></p>
                                  <p class="text-black">Pukul</p>
                                  <p class="col-span-4 text-black">
                                    : <?php echo htmlspecialchars($jam); ?>
                                  </p>
                                </div>

                                <!-- Close dialog button -->
                                <button
                                  @click="open = false"
                                  class="w-full bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                                  Tutup
                                </button>
                              </div>
                            </div>
                          </div>
                      <?php
                          $index++;
                        }
                      } else {
                        echo "No records found";
                      }
                      ?>
                      <div
                        x-data="{ open: false }"
                        class="rounded-lg border p-3 text-left text-sm transition-all hover:bg-gray-100">
                        <div
                          @click="open = true"
                          class="flex w-full justify-between gap-1">

                        </div>
                        <!-- Tambahkan item absensi lainnya di sini -->
                      </div>
                    </div>
                  </div>

                  <!-- Konten utama di sebelah kanan -->

                  <!-- Detail siswa di dalam preview -->
                </div>
                <div
                  class="basis-8/12 flex-1 h-full flex flex-col items-center justify-center relative p-4">
                  <!-- Preview kamera -->
                  <video id="video" autoplay></video>
                  <canvas id="canvas" style="display:none;"></canvas>
                  <div id="status"></div>

                  <script>
                    const video = document.getElementById('video');
                    const canvas = document.getElementById('canvas');
                    const context = canvas.getContext('2d');
                    const statusDiv = document.getElementById('status');

                    // Akses kamera
                    navigator.mediaDevices.getUserMedia({
                        video: true
                      })
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
                        data: JSON.stringify({
                          image: imageData
                        }),
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

                </div>
              </div>
            </div>
          </div>
      </div>
      </main>
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