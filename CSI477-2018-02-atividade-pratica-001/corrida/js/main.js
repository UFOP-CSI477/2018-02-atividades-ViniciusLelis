let racers = [];
let rowsCount = 0;

function fillResultsTable() {
    $('#tableResults > tbody').empty();
    let tableResultsRef = document.getElementById('tableResults').getElementsByTagName('tbody')[0];
    let position = 1;
    for (let i = 0; i < racers.length; i++) {
        let newRow = tableResultsRef.insertRow(tableResultsRef.rows.length);
        let newPositionCell = newRow.insertCell(0);
        let newStartCell = newRow.insertCell(1);
        let newNameRowCell = newRow.insertCell(2);
        let newTimeRowCell = newRow.insertCell(3);
        let newResultRowCell = newRow.insertCell(4);

        if (i > 0 && racers[i].time != racers[i - 1].time)
            position = i + 1;

        let positionText = document.createTextNode(position);
        let startText = document.createTextNode(racers[i].start);
        let nameText = document.createTextNode(racers[i].name);
        let timeText = document.createTextNode(racers[i].time);
        let resultText = document.createTextNode(position == 1 ? "Vencedor(a)!" : "-");

        newPositionCell.appendChild(positionText);
        newStartCell.appendChild(startText);
        newNameRowCell.appendChild(nameText);
        newTimeRowCell.appendChild(timeText);
        newResultRowCell.appendChild(resultText);
    }
}

function btnRemoveRowOnClick() {
    $(this).parent().parent().remove();
    rowsCount--;
    let $rows = $("#tableRace > tbody").find('tr:not(:hidden)');
    count = 1;
    $rows.each(function () {
        let $tds = $(this).find('td');
        $tds.each(function (i) {
            if (i == 0)
                $(this).text(count);
        });
        count++;
    });
    document.getElementById("alertMaximum").style.display = "none";
    document.getElementById("alertEmptyFields").style.display = "none";
}

function btnSubmitOnClick() {
    if (rowsCount == 0) {
        document.getElementById("alertNoData").style.display = "block";
        return;
    }
    racers = [];
    document.getElementById("alertNoData").style.display = "none";
    document.getElementById("alertMaximum").style.display = "none";
    let flagComplete = true;
    let $rows = $("#tableRace > tbody").find('tr:not(:hidden)');
    $rows.each(function () {
        let start;
        let name;
        let time;
        let $tds = $(this).find('td');
        $tds.each(function (i) {
            switch (i) {
                case 0: start = $(this).text(); break;
                case 1: name = $(this).text(); break;
                case 2: time = $(this).text(); break;
            }
        })
        if (start.length == 0 || name.length == 0 || time.length == 0) {
            racers = [];
            flagComplete = false;
            return;
        }
        racers.push(new Racer(start, name, time));
    });

    if (flagComplete) {
        document.getElementById("alertEmptyFields").style.display = "none";
        racers = racers.sort(function (a, b) {
            if (parseFloat(a.time) > parseFloat(b.time))
                return 1;
            if (parseFloat(a.time) < parseFloat(b.time))
                return -1;
            return 0;
        });
        fillResultsTable();
        $("#table-div").fadeOut(600, function () {
            $('#result-table-div').fadeIn(600);
        });
    } else
        document.getElementById("alertEmptyFields").style.display = "block";
}

function btnClearOnClick() {
    $("#tableRace > tbody").empty();
    rowsCount = 0;
    racers = [];
    document.getElementById("alertNoData").style.display = "none";
    document.getElementById("alertEmptyFields").style.display = "none";
    document.getElementById("alertMaximum").style.display = "none";
}

function validateTimeCellOnKeyDown(event) {
    if ($.inArray(event.keyCode, [46, 8, 9, 110, 190]) !== -1 ||
        (event.keyCode == 65 && (event.ctrlKey === true || event.metaKey === true)) ||
        (event.keyCode == 67 && (event.ctrlKey === true || event.metaKey === true)) ||
        (event.keyCode == 88 && (event.ctrlKey === true || event.metaKey === true)) ||
        (event.keyCode >= 35 && event.keyCode <= 39)) {
        return;
    }
    if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105))
        event.preventDefault();
}

function btnAddRowOnClick() {
    document.getElementById("alertNoData").style.display = "none";
    document.getElementById("alertEmptyFields").style.display = "none";
    let tableRef = document.getElementById('tableRace').getElementsByTagName('tbody')[0];
    if (rowsCount < 6) {
        let newRow = tableRef.insertRow(rowsCount);

        let newStartCell = newRow.insertCell(0);
        newStartCell.className = "align-middle";
        newRow.insertCell(1).contentEditable = 'true';
        let newTimeCell = newRow.insertCell(2);
        newTimeCell.contentEditable = 'true';
        newTimeCell.onkeydown = function (ev) { validateTimeCellOnKeyDown(ev) };
        let newRemoveRowCell = newRow.insertCell(3);

        let startText = document.createTextNode(rowsCount + 1);
        let removeRowButton = document.createElement("a");
        removeRowButton.id = rowsCount;
        removeRowButton.className = "btn btn-danger btn-sm my-1";
        removeRowButton.href = "#";
        let innerContent = document.createElement("i");
        innerContent.className = "far fa-trash-alt fa-sm";
        removeRowButton.appendChild(innerContent);
        removeRowButton.onclick = btnRemoveRowOnClick;

        newStartCell.appendChild(startText);
        newRemoveRowCell.appendChild(removeRowButton);
        rowsCount++;
    } else 
        document.getElementById("alertMaximum").style.display = "block";
}

function btnBackOnClick() {
    $("#result-table-div").fadeOut(600, function () {
        $('#table-div').fadeIn(600);
    });
}

$(document).ready(function () {
    $("#btnSubmit").click(btnSubmitOnClick);
    $("#btnClear").click(btnClearOnClick);
    $("#btnAddRow").click(btnAddRowOnClick);
    $("#btnBack").click(btnBackOnClick);
});