function validate_password()
{
  var password = document.getElementById("register_password").value;
  var confirm_password = document.getElementById("register_confirm_password").value;

  if (password != confirm_password)
  {
    alert("Password does not match.");
    return false;
  }
  else
  {
    return true;
  }
}
function password_strength(password) {
                
  // Do not show anything when the length of password is zero.
  if (password.length === 0) {
      document.getElementById("msg").innerHTML = "";
      return;
  }
  // Create an array and push all possible values that you want in password
  var matchedCase = new Array();
  matchedCase.push("[$@$!%*#?&]"); // Special Charector
  matchedCase.push("[A-Z]");      // Uppercase Alpabates
  matchedCase.push("[0-9]");      // Numbers
  matchedCase.push("[a-z]");     // Lowercase Alphabates

  // Check the conditions
  var ctr = 0;
  for (var i = 0; i < matchedCase.length; i++) {
      if (new RegExp(matchedCase[i]).test(password)) {
          ctr++;
      }
  }
  // Display it
  var color = "";
  var strength = "";
  if (document.getElementById("register_password").value.length < 8)
  {
    strength = "Very Weak";
    color = "Red";
  }
  else 
  {
    switch (ctr) {
      case 0:
      case 1:
      case 2:
          strength = "Very Weak";
          color = "red";
          break;
      case 3:
          strength = "Medium";
          color = "orange";
          break;
      case 4:
          strength = "Strong";
          color = "green";
          break;
    }
  }
  
  document.getElementById("msg").innerHTML = strength;
  document.getElementById("msg").style.color = color;
}