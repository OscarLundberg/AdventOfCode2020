let dataContainer;

$(document).ready(function () {
  $('#clear-btn').click(() => stopEditing())
  $('#add-btn').click(() => createEditor('-1'));
  $('#save-btn').click(() => postData());
  $('#refresh-btn').click(() => window.location.reload());



  $.getJSON("./tasklist.json", function (data) {
    dataContainer = data;
    update();
    $(".spinner-fade").attr("style", "display: none !important");
  });
});

function update() {
  let _parent = $('#taskContainer');
  _parent.empty()
  // $('body').append(_parent);
  let ind = 0;
  for (let task of dataContainer) {
    let _elt = $(`
      <div class="list-group-item list-group-item-action">
        <div class="row">  
          <div class="col-md-6">
            <h4>${task.name}</h4>
          </div>
          <div class="col-md-6">
            <h4 class="float-right">
              <a href="#" onclick="move(-1, ${ind})" id="up-${ind}"><span class="badge badge-light"><i class="fas fa-arrow-up"></i></span></a>
              <a href="#" onclick="move(1, ${ind})" id="down-${ind}"><span class="badge badge-light"><i class="fas fa-arrow-down"></i></span></a>
              <a href="/projects.php?task=${ind}" id="code-${ind}"><span class="badge badge-success"><i class="fas fa-code"></i></span></a>
              <a href="#" onclick="createEditor(${ind})" id="edit-${ind}"><span class="badge badge-warning"><i class="fas fa-cogs"></i></span></a>
              <a href="#" onclick="remove(${ind})" id="delete-${ind}"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
              <a href="#" onclick="duplicate(${ind})" id="duplicate-${ind}"><span class="badge badge-info"><i class="fas fa-copy"></i></span></a>
            </h4>
          </div>
        </div>
      </div>
    `);//<button type="button" class="list-group-item list-group-item-action active">${task.name}</button> <a href="#">View/Code</a><a href="#">Delete</a>`);
    //let _content = $(`<p></p>`)
    // let elt = _element.append(_content);
    //  _elt.click(() => { createEditor(task.index) })
    // $(`#up-${ind}`).click(() => { move(-1, ind) });
    // $(`#down-${ind}`).click(() =>{ move(1, ind)})
    // // $(`#code-${ind}`).click(open($ind));
    // $(`#edit-${ind}`).click(() => { createEditor(ind) });
    $(_parent).append(_elt);
    ind++;
  }
}

function setEditor(a = "", b = "", c = "", d = false) {
  $('#name-input').val(a)
  $('#data-input').val(b)
  $('#puzzleData').val(c);
  $('#numberData')[0].checked = d;
}


function stopEditing() {
  $('#editor').fadeOut(1000);
  setEditor();
}

function submitEdit(index) {
  editData({
    "name": $('#name-input').val(),
    "inputfile": $('#data-input').val(),
    "puzzleData": $('#puzzleData').val(),
    "numberData": $('#numberData')[0].checked
  }, index);
}

function createEditor(index) {
  setEditor();
  $('#post-btn').unbind();
  let target = dataContainer[index] || undefined;
  // let target = dataContainer.find(e => e.index === index);
  if (target) {
    $("#editor-text").html(`Editing <b>${target.name}</b>`);

    setEditor(target.name, target.inputfile, target.puzzleData, target.numberData);
  } else {
    $("#editor-text").html(`Editing <b>New Task</b>`);
    setEditor();
  }

  $('#post-btn').click(() => submitEdit(index))
  $('#editor').fadeIn(1000);
}


function editData(newData, index) {
  let target = dataContainer[index];//find(e => e.index === index);
  if (target) {
    let keys = Object.keys(newData)
    keys.map(x => {
      target[x] = newData[x];
    });
  }
  else {
    dataContainer.push({ ...newData, index: dataContainer.length, file: safeName(newData.name) })
    console.log("Pushed new task");
  }
  stopEditing();
  update();
}

function safeName(str) {
  return (str.replace(/ /g, "").replace(/\-/g, "_") + ".php").toLowerCase();
}

function postData() {
  console.log("saving data");
  let i = 0;
  for (let data of dataContainer) {
    data.index = i;
    i++;
  }
  $.post('../taskEditor.php', { "postdata": JSON.stringify(dataContainer) }, (response) => {
    Toastify({
      text: "Saving...",
    }).showToast();
    Toastify({ text: response }).showToast();

    console.log(response);
  })
}

function move(steps, index) {
  dataContainer.splice(index + steps, 0, dataContainer.splice(index, 1)[0]);
  update();
}

function remove(index) {
  dataContainer.splice(index, 1);
  update();
}

function duplicate(ind) {
  let target = { ...dataContainer[ind] };
  target.name += "(copy)";
  target.file = safeName(target.name);
  dataContainer.push(target);
  update();
}