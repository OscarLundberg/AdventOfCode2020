<?php
    include "./taskfinder.php";
    include_once "./helpers.php";

    // echo($_GET);
    if(!empty($_GET['all'])){
        $tasks = get_all_tasks();
        foreach($tasks as &$task)
        {
            $oldCode = file_get_contents(__DIR__ . "/../tasks/" . $task['file']);
            $task['src'] = $oldCode;
            // if(empty($task['puzzleData'])){
            if ($task['numberData'] == true) {
                // echo ("Parsing to ints");
                $task['puzzleData'] = str_to_int_array(file(__DIR__ . "/../data/" . $task['inputfile']));
            }else {
                $task['puzzleData'] = file(__DIR__ . "/../data/" . $task['inputfile']);
            }
            // }
        }
        echo json_encode($tasks);

    }else
    {
        $ind = $_GET['index'];
        $task = task_with_index($ind);
        $oldCode = file_get_contents(__DIR__ . "/../tasks/" . $task['file']);
        $task['src'] = $oldCode;
        if ($task['numberData'] == true) {
            // echo ("Parsing to ints");
            $task['puzzleData'] = str_to_int_array(file(__DIR__ . "/../data/" . $task['inputfile']));
        }else {
            $task['puzzleData'] = file(__DIR__ . "/../data/" . $task['inputfile']);
        }
        echo json_encode($task);
    }
    //"const _oldSourceCode = `" . $oldCode . "`;";
    // echo "const inputFileName = `" . $_GET['inputfile'] . "`;";
    // echo "const sourceCodeFile = `" . $sourcefile . "`;";
