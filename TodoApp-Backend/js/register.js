/**
 * Created by Isuru Amantha on 1/8/2018.
 */

$(document).ready(function () {
    $("#register").click(function () {

        var username = $("#userName").val();
        var userEmail = $("#userEmail").val();
        var userPassword = $("#userPassword").val();
        var confirmUserPass = $("#confirmUserPass").val();

        if (userPassword != confirmUserPass) {
            alert("Password didn't match");
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/user/register",
                data: "userName=" + username + "&userPassword=" + userPassword + "&userEmail=" + userEmail,
                success: function (response) {

                    if (response == "Enter complete user information to save" | response == "Email already found") {
                        alert("Error credentials")
                    } else {
                        alert("Success");
                    }
                }
            });
            return false;
        }

    });
});
