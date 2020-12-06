<?php
$tasklist = $_GET["postdata"];

file_put_contents('./tasklist.json', $tasklist);

$taskArr = json_decode($tasklist, true);
foreach ($taskArr as $key => $value) {
    $path = "./tasks/" . $value['file'];
    $dataPath = "./data/" . $value['inputfile'];
    if(!file_exists($path)){
        file_put_contents($path, "<?php\n//Generated on " . date('d-m-y H:i') . "\n\nfunction main() {\nreturn \"no output\";\n}\n?>");
    }

    if(!file_exists($dataPath)){
        file_put_contents($dataPath, "no data");
    }
    
}


header("OK", false, 200);

?>