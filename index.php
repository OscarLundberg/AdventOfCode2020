    <?php
    include __DIR__ . "/partials/header.php";
    include __DIR__ . "/partials/taskfinder.php";
    ?>
    <div class="container-fluid mt-2">
        <ul class="list-group">
            <?php
            $tasks = get_all_tasks();
            foreach ($tasks as $key => $task) {
                // $file = $task['file'];
                $ind = $task['index'];
                $nm = $task['name'];
                echo ('<a href="./projects.php?task='.$ind.'" class="list-group-item list-group-item-action">'.$nm.'</a>');
            }
            ?>
        </ul>
    </div>