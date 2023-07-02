var ageInput = document.getElementById('age');
ageInput.addEventListener('input', function() {
  var age = parseInt(ageInput.value);
  if (isNaN(age) || age < 1 || age > 120) {
    ageInput.setCustomValidity('Please enter a valid age between 1 and 120.');
  } else {
    ageInput.setCustomValidity('');
  }
});

var reportInput = document.getElementById('report');
reportInput.addEventListener('change', function() {
  var fileName = reportInput.files[0].name;
  var fileNameDisplay = document.getElementById('report-file-name');
  fileNameDisplay.textContent = fileName;
});

// Example: Clear the displayed filename when the form is reset
var form = document.getElementById('healthReportForm');
form.addEventListener('reset', function() {
  var fileNameDisplay = document.getElementById('report-file-name');
  fileNameDisplay.textContent = '';
});
