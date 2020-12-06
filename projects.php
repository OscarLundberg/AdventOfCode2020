<?php
include __DIR__ . "/partials/header.php";


$_GET['input'] = str_to_int_array(file( __DIR__ . "/data/" . $item));
$sourcefile = __DIR__ . "/tasks/" . $_GET['file'];
include $sourcefile;

$start = microtime(true);
$_GET['output'] = main();
$_GET['elapsed_time'] = (microtime(true) - $start) * 1000;

$_GET['codeLength'] = count(file($sourcefile));
$_GET['dataLength'] = count($_GET['input']);
include __DIR__ . "/partials/footer.php"
?>



