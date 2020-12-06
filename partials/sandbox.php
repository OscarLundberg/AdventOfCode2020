<?php
include './helpers.php';

$code = $_GET['sourcecode'];
$inputfile = $_GET['inputfile'];

if(empty($_GET['sourcecode'] || empty($_GET['inputfile']))){
    die('Invalid input');
}



$input = str_to_int_array(file(__DIR__ . "/../data/" . $inputfile));


/*$code = str_replace($code, '<?php', "\n");
$code = str_replace($code, '?>', "\n");*/
$task_input = $input;

// echo($code);

function create_custom_function($arguments, $body) {
    return eval("return function($arguments) { $body };");
}

$sandbox = create_custom_function('$input', $code);

$start = microtime(true);
$output = $sandbox($input);
$time = (microtime(true) - $start) * 1000;
$elapsedTime = number_format($time * 1000, 1)  . " µs";

$codeLen = count(explode("\n", $code));
$dataLen = count($input);

$response = new \stdClass();
$response->output = $output; 
$response->executionTime = $elapsedTime; 
$response->codeLength = $codeLen;
$response->dataLength = $dataLen;

echo json_encode($response);
?>