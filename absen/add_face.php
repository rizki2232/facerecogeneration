<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $output = shell_exec("python add_faces.py ");
    echo "<pre>$output</pre>";
}
?>
