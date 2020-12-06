<?php
$GLOBALS['taskList'] = json_decode(file_get_contents("tasklist.json"), true);

function get_all_tasks(){
    return $GLOBALS['taskList'];
}


function task_with_index(){
    $tasks = $GLOBALS['taskList'];
    $item = null;
    foreach($tasks as $struct) {
        if ($_GET['task'] == $struct['index']) {
            $item = $struct;
            break;
        }
    }
    return $item;
}
?>