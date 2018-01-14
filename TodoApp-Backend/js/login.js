/**
 * Created by Isuru Amantha on 1/8/2018.
 */

$(document).ready(function () {
    $("#login").click(function () {

        var username = $("#userName").val();
        var password = $("#password").val();

        // alert(username);

        $.ajax({
            type: "POST",
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/user/login",
            data: "userName=" + username + "&userPassword=" + password,
            success: function (response) {

                if (response == "Please enter valid data" | response == "Error credentials") {
                    alert("Error credentials")
                } else {
                    alert("Success");
                    window.location = "http://localhost/Server_Side_CW1/TodoApp-Backend/dashboardController";
                }
            }
        });
        return false;

    });
});
