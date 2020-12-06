<?php
include_once __DIR__ . '/helpers.php';
?>
<html>

<head>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

    <!-- CodeMirror -->
    <script src="codemirror/lib/codemirror.js"></script>
    <link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="codemirror/theme/monokai.css">
    <link rel="stylesheet" href="codemirror/addon/hint/show-hint.css">


    <script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="codemirror/mode/xml/xml.js"></script>
    <script src="codemirror/mode/javascript/javascript.js"></script>
    <script src="codemirror/mode/css/css.js"></script>
    <script src="codemirror/mode/clike/clike.js"></script>
    <script src="codemirror/mode/php/php.js"></script>
    <script src='codemirror/addon/selection/active-line.js'></script>
    <script src='codemirror/addon/edit/matchbrackets.js'></script>
    <script src='codemirror/addon/hint/show-hint.js'></script>
    <script src='codemirror/addon/hint/anyword-hint.js'></script>

    <link rel="stylesheet" href="codemirror/addon/lint/lint.css">
    <script src='codemirror/addon/lint/lint.js'></script>

    <!-- HOTKEYS -->
    <script src="https://cdn.jsdelivr.net/npm/hotkeys-js@3.7.3/dist/hotkeys.min.js"></script>

    <!-- TOASTIFY -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script> -->

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        html,
        body {
            height: 100%;

            display: flex;
            flex-direction: column;

        }

        body>* {
            flex-shrink: 0;
        }

        .code {
            background-color: #F2F2F2;
            border-radius: 5px;
            padding: 15px;
            box-shadow: inset 1px 1px 6px -1px #00000038;
            height: 55vh;
            flex-grow: 1;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-light bg-light">
        <a href="/index.php">
            <?php
            if ($_SERVER["REQUEST_URI"] != "/index.php") {
                echo ("Go Back");
            } else {
                echo ("Home");
            }
            ?>
        </a>
        <?php
        $pagename = "";
        if (!empty($_GET['name'])) {
            $pagename = $_GET['name'];
            if (isset($_GET['name'])) {
                echo ("<h5>$pagename</h5>");
            }
        }
        if (isset($_GET['task'])) {
            $btn  = "<a href=\"?task=" . ((int)$_GET['task'] - 1) . "\">
                        <button type=\"button\" class=\"btn btn-info\">
                            <i class=\"fas fa-angle-left\"></i>
                        </button
                    </a>";
            $btn2 = "<a href=\"?task=" . ((int)$_GET['task'] + 1) .  "\">
                        <button type=\"button\" class=\"btn btn-info\">
                            <i class=\"fas fa-angle-right\"></i>
                        </button>
                    </a>";
            echo ("<div>" . $btn . $btn2 . "</div>");
        }

        if ($pagename != "Create new task") {
            echo ('<a href="/../new_task.php">Task Manager</a>');
        }
        ?>
    </nav>

    