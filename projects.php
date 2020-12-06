<?php
include __DIR__ . "/partials/header.php";
include __DIR__ . "/partials/taskfinder.php";

$activeTask = task_with_index($_GET['task']);
$_GET['inputfile'] = $activeTask['inputfile'];
$_GET['file'] = $activeTask['file'];


//['inputfile'];
$_GET['input'] = str_to_int_array(file(__DIR__ . "/data/" . $activeTask['inputfile']));
$sourcefile = __DIR__ . "/tasks/" . $activeTask['file'];
include $sourcefile;

$start = microtime(true);
$_GET['output'] = main();
$_GET['elapsed_time'] = (microtime(true) - $start) * 1000;

$_GET['codeLength'] = count(file($sourcefile));
$_GET['dataLength'] = count($_GET['input']);


include __DIR__ . "/partials/footer.php"
?>
<script>
    $(document).ready(function() {
		var codeEditorElement = $(".codemirror-textarea")[0];
		var editor = CodeMirror.fromTextArea(codeEditorElement, {
            value: "// No code atm",
            mode: "application/x-httpd-php",
            lineNumbers: true,
            matchBrackets: true,
            theme: "ambiance",
            lineNumbers: true,
            matchBrackets: true,
            showHint: true,
            lineWiseCopyCut: true
        });
    });
</script>