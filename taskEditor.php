<?php

function get_content($URL)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $URL);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$tasklist = $_POST["postdata"];
$taskArr = json_decode($tasklist, true);


foreach ($taskArr as  &$value) {
    $path = "./tasks/" . $value['file'];
    $dataPath = "./data/" . $value['inputfile'];
    $puzzleData = "";
    if(!empty($value['puzzleData']))
    {
        $puzzleData = $value['puzzleData'];
    }

    if (!file_exists($path)) {
        file_put_contents($path, "//Generated on " . date('d-m-y H:i') . "");
    } else {
        echo ("File exists");
    }

    if (strpos($dataPath, "http") != false) {
        if (strlen($puzzleData) > 10) {
            $file  = $puzzleData;
        } else {
            $file = get_content($dataPath);
        }
        $fname = preg_replace('/.*\.com/',  "", $dataPath);
        $fname = str_replace("/", "_", $fname) . ".txt";

        file_put_contents('./data/' . $fname, $file);
        $value['inputfile'] = $fname;
    } else if (!file_exists($dataPath)) {
        if (strlen($puzzleData) > 10) {
            $file  = $puzzleData;
        } else {
            $file = "no data";
        }
        file_put_contents($dataPath, $file);
    } else {
        echo ("File exists");
    }
}

file_put_contents('./tasklist.json', json_encode($taskArr, JSON_PRETTY_PRINT));


header("OK", false, 200);
