<div class="absen">
    <h2>Data Absen</h2>
    <form method="post">
        <label for="tahun">Tahun:</label>
        <select id="tahun" name="tahun">
            <?php
                // Generate year options dynamically from 2020 to the current year
                for ($year = 2020; $year <= date("Y"); $year++) {
                    echo "<option value='$year'>$year</option>";
                }
            ?>
        </select>

        <label for="bulan">Bulan:</label>
        <select id="bulan" name="bulan">
            <?php
                // Array of months in Indonesian
                $months = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];
                foreach ($months as $index => $month) {
                    echo "<option value='" . ($index + 1) . "'>$month</option>";
                }
            ?>
        </select>

        <button type="submit">Tampilkan</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Waktu</th>
        </tr>
        <?php
            // Sample data for demonstration purposes
            $attendanceData = [
                ["no" => 1, "nama" => "Aldi", "kelas" => "XII", "tanggal" => "2024-11-01", "waktu" => "08:00"],
                ["no" => 2, "nama" => "Rizki", "kelas" => "XI", "tanggal" => "2024-11-02", "waktu" => "08:05"],
                ["no" => 3, "nama" => "Iwan", "kelas" => "X", "tanggal" => "2024-11-03", "waktu" => "08:10"],
            ];

            // Display the attendance data in table rows
            foreach ($attendanceData as $row) {
                echo "<tr>
                        <td>{$row['no']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['kelas']}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['waktu']}</td>
                      </tr>";
            }
        ?>
    </table>
</div>

</body>
</html>