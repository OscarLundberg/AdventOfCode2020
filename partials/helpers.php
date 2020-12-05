<?php
function contains($string, $query) {
    $doesInclude = strpos($string, $query) !== FALSE;
    return $doesInclude;
}

function str_to_int_array($arr){
    $output = array();
    foreach($arr as $str){
        array_push($output, (int)$str);
    }
    return $output;
}
?>