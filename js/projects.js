let activeTask = {};
let allTasks = [];

function mod_floor(a, n) {
    return ((a % n) + n) % n;
}

function quickload(taskIndex) {
    activeTask = allTasks[mod_floor(activeTask.index + taskIndex, allTasks.length)];
    update();
}

function loadAll() {
    $.get('../partials/taskinfo.php?all=true', (resp) => {
        let response = JSON.parse(resp);
        allTasks = response;
        // Enable buttons
        $('#leftTask').prop('disabled', false);
        $('#rightTask').prop('disabled', false);
    });
}

function loadTask(taskIndex = new URLSearchParams(window.location.search).get('task'), then = () => { }) {
    $.get('../partials/taskinfo.php?index=' + taskIndex, (resp) => {
        let response = JSON.parse(resp);
        //console.log(response);
        activeTask = response;
        then();
        loadAll();
    });
}

function execute(code) {
    activeDocument.clearGutter('debug');
    $('#executionSpinner').fadeIn(500);
    Toastify({
        text: "Execution started...",
        duration: 800
    }).showToast();

    let data = {
        src: code,
        inputfile: activeTask.inputfile,
        numberData: activeTask.numberData
    }
    console.log(activeTask.numberData);
    $.post('./partials/sandbox.php', data, (responseText, status, xhr) => {
        console.log(responseText);

        // console.log(xhr);
        let resp;
        try {
            resp = JSON.parse(responseText);
        } catch (e) {
            Toastify({
                text: "Execution completed with errors.",
                duration: 800
            }).showToast();
            let matches = responseText.match(/<b>(\d+)[^<]*<\/b>/);
            let targetLine = parseInt(matches[1]);
            let match2 = responseText.match(/:\s+(.*?)\s+in/);
            let errorMsg = match2[1];
            activeDocument.setGutterMarker(parseInt(matches[1]) - 1, "debug",
                $(`
                    <i class="fas fa-bug red-text px-1 mt-1" data-toggle="tooltip" data-html="true" data-placement="right" title="<code>${errorMsg}</code>"></i>
                `)[0]
            );
            $('[data-toggle="tooltip"]').tooltip()
            $('#output').html('<b>' + errorMsg.charAt(0).toUpperCase() + errorMsg.slice(1) + ` on line <code>${targetLine}</code></b>`);
            return;
        }

        if (resp.output) {
            Toastify({
                text: "Execution completed.",
                duration: 800
            }).showToast();
            $('#executionSpinner').fadeOut(500);
            $('#output').html(
                `${resp.output}
            <hr>
            <small style="font-size:11px" class="text-info">
            <br>${resp.codeLength} lines of code
            <br>${resp.dataLength} rows of input data
            <br>Executed in ${resp.executionTime}
            <br>
            <br>
            Debug Output:</small>
            
            `);
            let msg = "";
            let timestamps = "";
            resp.logs.forEach(e => {
                msg += `${e.msg}<br>`;
                timestamps += `${e.timestamp}<br>`;
            });
            if (resp.logs.length > 0) {
                $('#output').append(`<br>
                <span style="width:100%" class="badge mt-1 badge-dark"><code class="float-left">${msg}</code><code class="float-right">${timestamps}</code></span>
            `);
            }
        } else {
            $('#output').html(resp);
        }
    })

}

$('#infoPanes').fadeIn(1200);

function startup() {
    var codeEditorElement = $(".codemirror-textarea")[0];
    var editor = CodeMirror.fromTextArea(codeEditorElement, {
        mode: "text/x-php",
        lineNumbers: true,
        indentWithTabs: true,
        matchBrackets: true,
        theme: "monokai",
        fontSize: 14,
        matchBrackets: true,
        showHint: true,
        anywordHint: true,
        lineWiseCopyCut: true,
        lint: true,
        gutters: ["debug"],
        comment: true,
        extraKeys: {
            'Cmd-/': function (e, h) { e.toggleComment() },
        }
    });
    activeDocument = editor.getDoc();
    editor.on('inputRead', (instance, name, evt) => {
        console.log(name);
        if (["paste", "cut"].includes(name.origin) ||
            [" ", ";"].includes(name.text[0])) { return; }
        let hints = editor.showHint({
            hint: CodeMirror.hint.auto,
            customKeys: {
                Up: function (e, h) {
                    h.moveFocus(-1)
                },
                Down: function (e, h) {
                    h.moveFocus(1)
                },
                Esc: function (e, h) {
                    h.close()
                },
                'Shift-Tab': function (e, h) {
                    h.close()
                },
                Tab: function (e, h) {
                    h.pick()
                },
                Enter: function (e, h) {
                    h.pick()
                },
                Ctrl: function (e, h) {
                    h.close();
                },
                Mod: function (e, h) {
                    h.close();
                },
            },
            completeSingle: false
        });
    });

    $('#leftTask').prop('disabled', true);
    $('#rightTask').prop('disabled', true);
    $('#leftTask').click(() => quickload(-1));
    $('#rightTask').click(() => quickload(1));
    // $('#rightTask').click(() => quickload(1));


    update();
}


function update() {
    {
        let editor = activeDocument.getEditor()
        editor.setValue(activeTask.src ?? "<?php\n   function main($input) {\n\n    }\n?>");
        zoomCode(0);
        $('#executionSpinner').hide();

        $('#exec-btn').unbind();
        $('#exec-btn').click(function () {
            execute(editor.getValue());
        });

        $('#store-btn').unbind();
        $('#store-btn').click(function () {
            store(editor.getValue(), activeTask.file);
        });

        $('#profile').html(`${activeTask.puzzleData.join('<br>')}`);
        $('#taskTitle').html(`${activeTask.name}`);

        window.history.replaceState({ page: "Task " + activeTask.index }, activeTask.name, location.pathname + "?task=" + activeTask.index);

    }
}


let zoom = 13;
let activeDocument = {};
$(document).ready(function () {
    loadTask(undefined, () => startup());

});


hotkeys('command+r,command+s', function (event, handler) {
    event.preventDefault();
    switch (handler.key) {
        case 'command+r': $('#exec-btn').click()
            break;
        case 'command+s': $('#store-btn').click()
            break;
        case 'r': alert('you pressed r!');
            break;
        case 'f': alert('you pressed f!');
            break;
        default: alert(event);
    }
});


function zoomCode(i) {
    zoom += i;
    $('.CodeMirror').attr('style', `font-size:${zoom}px !important;`);
}

function store(sourcecode, file) {
    let data = {
        sourcecode,
        file
    }

    $.post('../partials/storefile.php', data, (response) => {
        Toastify({ text: "Saving...\n" + response, duration: 2000 }).showToast();
        console.log(response);
    })
}