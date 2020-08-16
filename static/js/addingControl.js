// Init
document.getElementById('containsLettersWarn').style.display = "none";
document.getElementById('tooLongWarn').style.display = "none";

function setDiv(divId, status) {
    document.getElementById(divId).style.display = status;
}

function handleYearInput(e) {
    let text = e.target.value;

    if (text.match(/^[0-9]+$/) == null && !text.length == 0) {
        setDiv('containsLettersWarn', 'block');
    }
    else
        setDiv('containsLettersWarn', 'none');

    if (text.length > 4) {
        setDiv('tooLongWarn', 'block');
    }
    else
        setDiv('tooLongWarn', 'none');
}

function areThereWarnings() {
    if (document.getElementById('containsLettersWarn').style.display === "block")
        return true;
        
    if (document.getElementById('tooLongWarn').style.display === "block")
        return true;

    return false;
}

function checkValid() {
    if (areThereWarnings())
        return;
    document.getElementById('addForm').submit();
}

const yearInput = document.getElementsByName('year');

yearInput[0].addEventListener('input', handleYearInput);
yearInput[0].addEventListener('propertychange', handleYearInput);