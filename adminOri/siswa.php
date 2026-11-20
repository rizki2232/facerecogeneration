<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include 'navbar.php'; ?>
            <div class="card mx-auto my-5 row col-9" style="border-color: black;">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 mt-4">
            <div>
                <h2 class="text-primary">Siswa</h2>
            </div>
            <div>
                <a href="#" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                        <path
                            d="M8 1a7 7 0 1 0 7 7A7 7 0 0 0 8 1zm0 13A6 6 0 1 1 8 2a6 6 0 0 1 0 12z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5V7h2.5a.5.5 0 0 1 0 1H8.5v2.5a.5.5 0 0 1-1 0V8H5a.5.5 0 0 1 0-1h2.5V4.5A.5.5 0 0 1 8 4z" />
                    </svg>
                    Tambah siswa
                </a>
            </div>
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive shadow-sm">
            <table class="table table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Alamat</th>
                        <th scope="col" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data, Anda dapat mengganti ini dengan data dinamis -->
                    <tr>
                        <td>1</td>
                        <td>Reza Andyah Wijaya</td>
                        <td>XII-MIPA 7</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-link text-decoration-none text-primary">
                                Edit
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Nurhaliza</td>
                        <td>XII-MIPA 8</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-link text-decoration-none text-primary">
                                Edit
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>