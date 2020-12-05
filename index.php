    <?php
    include __DIR__ . "/partials/header.php";
    $tasks = json_decode(file_get_contents("tasklist.json"), true);


    ?>
    <div class="container-fluid mt-2">
        <ul class="list-group">
            <?php
            foreach ($tasks as $key => $task) {
                $file = $task['file'];
                $nm = $task['name'];
                echo ("<a href=\"./projects.php?" . http_build_query($task) . "\" class=\"list-group-item list-group-item-action\">$nm</a>");
            }
            ?>
        </ul>
    </div>