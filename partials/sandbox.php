<?php
include './helpers.php';


if(empty($_POST['sourcecode'] || empty($_POST['inputfile']))){
    die('Invalid input');
}

$code = $_POST['sourcecode'];
$inputfile = $_POST['inputfile'];
set_time_limit ( 30 ); 

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
$elapsedTime;// = number_format($time * 1000, 1);

if($time > 1){
    $elapsedTime = number_format($time, 2) . "ms" ;
}else {
    $elapsedTime = number_format($time * 1000, 2) . "µs";
}

$codeLen = count(explode("\n", $code));
$dataLen = count($input);

$response = new \stdClass();
$response->output = $output; 
$response->executionTime = $elapsedTime; 
$response->codeLength = $codeLen;
$response->dataLength = $dataLen;

echo json_encode($response);
?>