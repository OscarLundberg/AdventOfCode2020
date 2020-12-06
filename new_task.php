<?php

$_GET['name'] = 'Create new task';
include_once('./partials/header.php');
?>

<div class="container">
    <div class="card mx-auto mt-3">
        <div class="card-body">
            <div id="taskContainer" class="list-group"></div>
        </div>
    </div>
    <script src="./js/readTaskList.js"></script>

    <div class="spinner-fade d-flex justify-content-center mt-5">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div id="editor" class="card mx-auto mt-3 p-4" style="display: none;">
        <form>
            <p id="editor-text">Editing</p>
            <div class="row">
                <div class="col">
                    Task Name:
                    <input id="name-input" type="text" class="form-control" placeholder="My New Task">
                </div>
                <div class="col">
                    Input File:
                    <input id="data-input" type="text" class="form-control" placeholder="data.txt">
                </div>
            </div>
            <hr>
            <button id="clear-btn" type="button" class="btn btn-secondary">Cancel</button>
            <button id="post-btn" type="button" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <button id="add-btn" type="button" class="btn btn-success mt-3">New task</button>
    <button id="save-btn" type="button" class="btn btn-warning mt-3">Save Changes</button>
    <button id="refresh-btn" type="button" class="btn btn-info mt-3"><i class="fas fa-undo"></i></button>


</div>