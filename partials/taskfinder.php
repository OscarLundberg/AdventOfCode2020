<?php
$GLOBALS['taskList'] = json_decode(file_get_contents(__DIR__ . "/../tasklist.json"), true);

function get_all_tasks(){
    return $GLOBALS['taskList'];
}


function task_with_index($ind){
    $tasks = $GLOBALS['taskList'];
    $item = null;
    foreach($tasks as $struct) {
        if ($struct['index'] == $ind) {
            return $struct;
            break;
        }
    }
    return null;
}
?>