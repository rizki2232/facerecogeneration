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
                <div class="col-12 py-3 row">
                    <div class="container">
                        <h2>Formulir Siswa</h2>
                        <form method="POST" action="http://localhost:5000/register">
                            <label for="name">Name:</label>
                            <input type="text" name="name" required><br><br>

                            <label for="NISN">NISN</label>
                            <input type="text" name="NISN" required><br><br>

                            <label for="class">Class:</label>
                            <input type="text" name="class" required><br><br>

                            <button type="submit">Register</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>