function addNumbers() {
  // Get the numbers out of the text boxes.
  var numberA = document.getElementById("numA").value;
  var numberB = document.getElementById("numA").value;
  // Perform the calculation.
  var result = numberA + numberB;
  // Show the result on the page.
  document.getElementById("result").innerHTML = result;
}