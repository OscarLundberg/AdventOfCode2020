<?php
include_once __DIR__ . "/partials/header.php";
include __DIR__ . "/partials/taskfinder.php";

$activeTask = task_with_index($_GET['task']);
if (empty($activeTask)) {
    echo ('<div>This task does not exist <br> <a href="index.php">Go to homepage</a> or <a href="new_task.php">Task Manager</a></div>');
    die();
}

// $_GET['inputfile'] = $activeTask['inputfile'];
// $_GET['file'] = $activeTask['file'];


//['inputfile'];

// $_GET['input'] = file(__DIR__ . "/data/" . $activeTask['inputfile']);
// if ($activeTask['numberData'] == true) {
//     echo ("Parsing to ints");
//     $_GET['input'] = str_to_int_array($_GET['input']);
// }

// $sourcefile = __DIR__ . "/tasks/" . $activeTask['file'];
// $oldCode = file_get_contents($sourcefile);
?>

<div class="container-fluid mt-2">
    <h4 id="taskTitle"></h4>
    <div class="row" id="infoPanes" style="display: none;">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active" data-toggle="tab" id="DisplaySource">Source code</a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile" class="nav-link" data-toggle="tab" id="DisplayData">Input Data</a>
                        </li>
                    </ul>
                </h5>
                <div class="card-body">
                    <div class="tab-content">
                        <code class="code tab-pane fade show active" id="home">
                            <textarea class="codemirror-textarea" id="ed_code"></textarea>
                            </textarea>
                        </code>
                        <code class="code tab-pane fade" id="profile">
                            <?php
                            echo (implode("<br>", $_GET['input']));
                            ?>
                        </code>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#home">Output</a>
                        </li>
                    </ul>
                </h5>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="code tab-pane fade show active" id="output">
                            <div class="spinner-border text-warning" id="executionSpinner" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="exec-btn" type="button" class="btn btn-info mt-3">Execute</button>
    <button id="store-btn" type="button" class="btn btn-success mt-3">Save</button>
</div>



<script src="./js/projects.js"></script>
<?php
include_once "./partials/footer.php";
?>