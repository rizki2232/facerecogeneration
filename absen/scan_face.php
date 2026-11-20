<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pemindaian Wajah</title>
</head>
<body>

<h1>Hasil Pemindaian Wajah</h1>

<?php
$output = shell_exec("python test.py 2>&1");
echo "<pre>$output</pre>";
?>

</body>
</html>
