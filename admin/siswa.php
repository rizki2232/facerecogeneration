<div class="content">
    <h2>Data Siswa</h2>
    <button class="add-button">Tambah Siswa</button>
    
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        
        <?php
        // Example data - Replace this with data from your database
        $students = [
            ['no' => 1, 'nama' => 'Akbar', 'kelas' => 'XI', 'alamat' => 'Jl. Mawar No. 10'],
            ['no' => 2, 'nama' => 'Budi', 'kelas' => 'X', 'alamat' => 'Jl. Melati No. 5'],
            ['no' => 3, 'nama' => 'Citra', 'kelas' => 'XII', 'alamat' => 'Jl. Anggrek No. 7']
        ];

        // Display data in the table
        foreach ($students as $student) {
            echo "<tr>";
            echo "<td>" . $student['no'] . "</td>";
            echo "<td>" . $student['nama'] . "</td>";
            echo "<td>" . $student['kelas'] . "</td>";
            echo "<td>" . $student['alamat'] . "</td>";
            echo "<td><button>Edit</button> <button>Hapus</button></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>