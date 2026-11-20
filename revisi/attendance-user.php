<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Absensi</title>
    <link rel="stylesheet" href="css/style.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-50 transition-all duration-300">
    <div class="relative">
        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300">
            <!-- Main Content Area -->
            <main class="pt-12 flex-1">
                <div class="py-4 h-full">
                    <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg h-full">
                            <div class="h-full border-r flex flex-col">
                                <!-- Search Input -->
                                <div class="p-4 pb-2">
                                    <p class="text-gray-600">Terbaru</p>
                                </div>

                                <!-- Absensi List -->
                                <div class="flex-grow p-4 overflow-y-auto">
                                    <div class="flex flex-col gap-y-2 max-h-[calc(100vh-240px)]">
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
                                                INNER JOIN 
                                                    absen 
                                                ON 
                                                    siswa.name = absen.nama
                                                ORDER BY 
                                                    absen.tanggal DESC, absen.jam DESC";
                                        $result = $conn->query($query);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $jam = $row["jam"];
                                                $time = strtotime($jam);
                                                $limit = strtotime("08:00");
                                                $status = $time <= $limit ? "Tepat Waktu" : "Terlambat";
                                                $statusColor = $time <= $limit ? "green" : "red";
                                        ?>
                                                <div
                                                    class="rounded-lg border p-3 text-left text-sm transition-all hover:bg-gray-100"
                                                    x-data="{ open: false }">
                                                    <div @click="open = true" class="flex w-full justify-between gap-1 cursor-pointer">
                                                        <div class="flex flex-col space-y-1">
                                                            <div class="font-semibold"><?php echo htmlspecialchars($row["nama_absen"]); ?></div>
                                                            <div class="text-xs"><?php echo htmlspecialchars($row["kelas"]); ?></div>
                                                        </div>
                                                        <div class="flex flex-col space-y-1 text-right">
                                                            <div class="text-xs"><?php echo htmlspecialchars($jam); ?></div>
                                                            <div class="ml-auto inline-flex items-center rounded-md bg-<?php echo $statusColor; ?>-500 text-white px-2.5 py-0.5 text-xs font-semibold shadow">
                                                                <?php echo $status; ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Popup Dialog -->
                                                    <div x-show="open"
                                                        x-cloak
                                                        x-transition
                                                        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
                                                        <div @click.outside="open = false"
                                                            class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                                                            <button @click="open = false"
                                                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                            <h2 class="text-xl font-semibold text-gray-800">
                                                                <?php echo htmlspecialchars($row["nama_absen"]); ?>
                                                            </h2>
                                                            <p class="text-sm text-gray-600">
                                                                NISN: <?php echo htmlspecialchars($row["NISN"]); ?> | Kelas: <?php echo htmlspecialchars($row["kelas"]); ?>
                                                            </p>
                                                            <div class="mt-4">
                                                                <h5 class="text-gray-600 mb-2">Detail Kehadiran</h5>
                                                                <div class="grid grid-cols-2 gap-2">
                                                                    <p class="text-gray-700">Tanggal</p>
                                                                    <p class="text-gray-900"><?php echo htmlspecialchars($row["tanggal"]); ?></p>
                                                                    <p class="text-gray-700">Jam</p>
                                                                    <p class="text-gray-900"><?php echo htmlspecialchars($jam); ?></p>
                                                                </div>
                                                            </div>
                                                            <button @click="open = false"
                                                                class="w-full mt-6 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                                                                Tutup
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo "<p class='text-gray-600'>Tidak ada data absensi.</p>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>