/**
 * Created by Isuru Amantha on 1/8/2018.
 */


$(document).ready(function () {
    $("#login").click(function () {

        var username = $("#userName").val();
        var password = $("#password").val();

        $.ajax({

            type: "POST",
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/user/login",
            data: "userName=" + username + "&userPassword=" + password,
            success: function (response) {

                if (response == "Please enter valid data" | response == "Error credentials") {
                    alert("Error credentials")
                } else {
                    alert("Success");

                    // Store the data into local storage
                    localStorage.setItem("userId", response.userId);
                    localStorage.setItem("userName", response.userName);
                    localStorage.setItem("userEmail", response.userEmail);
                    console.log(response);
                    window.location = "Dashboard.html";
                }
            }
        });
        return false;

    });
});
