$('#infoPanes').fadeIn(1200);

let zoom = 13;
$(document).ready(function () {
    var codeEditorElement = $(".codemirror-textarea")[0];
    var editor = CodeMirror.fromTextArea(codeEditorElement, {
        mode: "text/x-php",
        lineNumbers: true,
        matchBrackets: true,
        theme: "monokai",
        fontSize: 14,
        lineNumbers: true,
        matchBrackets: true,
        showHint: true,
        anywordHint: true,
        lineWiseCopyCut: true,
        lint: true
    });

    editor.setValue(_oldSourceCode ?? "<?php\n   function main($input) {\n\n    }\n?>");
    editor.on('inputRead', (instance, name, evt) => {

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
                Tab: function (e, h) {
                    h.pick()
                },
                Enter: function (e, h) {
                    h.pick()
                }
            },
            completeSingle: false
        });
        console.log(hints);

    });
    zoomCode(0);
    $('#executionSpinner').hide();
    $('#exec-btn').click(function () {
        execute(editor.getValue());
    });

    $('#store-btn').click(function () {
        store(editor.getValue(), sourceCodeFile);
    });
});


hotkeys('ctrl+r,ctrl+s', function (event, handler) {
    switch (handler.key) {
        case 'ctrl+r': $('#exec-btn').click()
            break;
        case 'ctrl+s': $('#store-btn').click()
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