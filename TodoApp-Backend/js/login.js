/**
 * Created by Isuru Amantha on 1/8/2018.
 */


$(document).ready(function () {

    $('.toggle').on('click', function () {
        $('.container').stop().addClass('active');
    });

    $('.close').on('click', function () {
        $('.container').stop().removeClass('active');
    });


    /*
     Login function
     */
    $("#login").click(function () {

        var username = $("#userNameLogin").val();
        var password = $("#passwordLogin").val();

        if (username == "") {
            alert("Please enter the username!");
        } else if (password == "") {
            alert("Please enter the password!");
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/users/login",
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
        }


        return false;

    });

    /*
     Register function
     */
    $("#register").click(function () {

            var username = $("#userName").val();
            var userEmail = $("#userEmail").val();
            var userPassword = $("#userPassword").val();
            var confirmUserPass = $("#confirmUserPass").val();

            if (username == "") {
                alert("Please enter the username!");
            } else if (userEmail == "") {
                alert("Please enter the email!");
            } else if (userPassword == "") {
                alert("Please enter the password!");
            } else if (confirmUserPass == "") {
                alert("Please enter the confirmation password!");
            } else if (userPassword != confirmUserPass) {
                alert("Password didn't match");
            } else {
                $.ajax({
                    type: "POST",
                    url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/users/register",
                    data: "userName=" + username + "&userPassword=" + userPassword + "&userEmail=" + userEmail,
                    success: function (response) {

                        if (response == "Enter complete user information to save" | response == "Email already found") {
                            alert("Email already found!")
                        } else {
                            alert("Success");
                            window.location = "Login.html";
                        }
                    }
                });
                return false;
            }

        }
    )
    ;
});
