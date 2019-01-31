document.addEventListener("DOMContentLoaded", function(event) {
	var login = ["0713961217", "0713577843"];
	var pass = "123456";

	$("#idButton").click(function() {
  		var inputLogin = $("#idLogin").val();
  		var inputPass = $("#idPass").val();

  		if(login.indexOf(inputLogin) != -1 && inputPass == pass){
			//alert("Логин и пароль верный");
			document.location.href = "https://www.google.com/";
		} else {
			alert("Неверный логин или пароль");
		}
	});
});