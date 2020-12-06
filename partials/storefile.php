<?php
    $code = $_POST['sourcecode'];
    $filename = $_POST['file'];

    file_put_contents("$filename", $code);
?>