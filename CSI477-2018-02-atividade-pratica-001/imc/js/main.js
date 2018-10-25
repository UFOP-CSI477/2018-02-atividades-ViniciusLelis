const classifications = ["Subnutrição", "Peso saudável", "Sobrepeso", "Obesidade grau 1", "Obesidade grau 2", "Obesidade grau 3",]

function navCalculateOnClick() {
    $("#table-nav").removeClass("active");
    $("#calculate-nav").toggleClass("active");
    $("#card-table").hide();
    $("#card-calculate").show();
}

function navTableOnClick() {
    $("#calculate-nav").removeClass("active");
    $("#table-nav").toggleClass("active");
    $("#card-calculate").hide();
    $("#card-table").show();
}

function btnBackOnClick() {
    $("#result-div").fadeOut(600, function () {
        $('#calculate-div').fadeIn(600);
    });
}

function calculateHealthyWeightRange(height) {
    let inferior = 18.5 * (height*height);
    let superior = 24.5 * (height*height);
    return [inferior.toFixed(2), superior.toFixed(2)];
}

function getBMIClassification(bmi) {
    if (bmi < 18.5)
        return classifications[0];
    else if (bmi >= 18.5 && bmi < 24.9)
        return classifications[1];
    else if (bmi >= 24.9 && bmi < 29.9)
        return classifications[2];
    else if (bmi >= 29.9 && bmi < 34.9)
        return classifications[3];
    else if (bmi >= 34.9 && bmi < 39.9)
        return classifications[4];

    return classifications[5];
}

function calculateBMI(height, weight) {
    let bmi = weight / (height * height);
    return bmi;
}

function btnCalculateOnClick() {
    let weightValue = document.forms['data'].elements['weight-value'].value;
    let heightValue = document.forms['data'].elements['height-value'].value;
    if (weightValue.length == 0 || heightValue.length == 0) {
        document.getElementById("alertEmptyFields").style.display = "block";
        return;
    }
    heightValue = parseFloat(heightValue);
    weightValue = parseFloat(weightValue);
    let bmi = calculateBMI(heightValue, weightValue);
    let bmiClass = getBMIClassification(bmi);
    $('#bmi-label').text(bmi.toFixed(2));
    $('#bmi-class-label').text(bmiClass);
    let idealWeights = calculateHealthyWeightRange(heightValue);
    $('#ideal-weight-label').text(idealWeights[0] + "Kg e " + idealWeights[1] + "Kg");
    $("#calculate-div").fadeOut(600, function () {
        $('#result-div').fadeIn(600);
    });
}

function validateFieldsOnKeyDown(event) {
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

function fieldsOnClick() {
    document.getElementById("alertEmptyFields").style.display = "none";
}

$(document).ready(function () {
    $("#btnCalculate").click(btnCalculateOnClick);
    $("#btnBack").click(btnBackOnClick);
    $("#calculate-nav").click(navCalculateOnClick);
    $("#table-nav").click(navTableOnClick);
    document.forms['data'].elements['weight-value'].onkeydown = function (ev) { validateFieldsOnKeyDown(ev) };
    document.forms['data'].elements['height-value'].onkeydown = function (ev) { validateFieldsOnKeyDown(ev) };
    document.forms['data'].elements['weight-value'].onclick = fieldsOnClick;
    document.forms['data'].elements['height-value'].onclick = fieldsOnClick;
});