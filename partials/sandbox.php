<?php
include './helpers.php';


if(empty($_POST['src'] || empty($_POST['inputfile']))){
    die('Invalid input');
}



$code = $_POST['src'];
$inputfile = $_POST['inputfile'];
$parseFile = $_POST["numberData"];



$newSrc = array();
$ind = 1;
foreach(explode("\n", $code) as $line){
    array_push($newSrc, preg_replace('/debug\((.*?)\);/', 'debug($1, ' . $ind . ');', $line));
    $ind++;
}
$code = implode("\n", $newSrc);


// $code = $_POST['sourcecode'];
// $inputfile = $_POST['inputfile'];
// $parseFile = $_POST["numberData"];
set_time_limit ( 30 ); 
$input;
if($parseFile != "true"){
    $input = file(__DIR__ . "/../data/" . $inputfile);
}else {
    $input = str_to_int_array(file(__DIR__ . "/../data/" . $inputfile));
}

/*$code = str_replace($code, '<?php', "\n");
$code = str_replace($code, '?>', "\n");*/
$task_input = $input;

// echo($code);

$GLOBALS['log'] = array();

function debug($str, $line){
    $now = DateTime::createFromFormat('U.u', microtime(true));
    array_push($GLOBALS['log'], ['msg' => $str, 'timestamp' => "Line $line"]);//$now->format("H:i:s.u")]);
}

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

if($output == FALSE){
    $output = "false";
}
else if(empty($output)){
    $output = 'Output null or non-existing';
}

$response = new \stdClass();
$response->output = $output; 
$response->executionTime = $elapsedTime; 
$response->codeLength = $codeLen;
$response->dataLength = $dataLen;
$response->logs = $GLOBALS['log'];

echo json_encode($response);
?>