<?php
    $code = $_POST['sourcecode'];
    $filename = $_POST['file'];

    file_put_contents(__DIR__ . "/../tasks/$filename", $code);
?>