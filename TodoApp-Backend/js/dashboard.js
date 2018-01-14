/**
 * Created by Isuru Amantha on 1/8/2018.
 */

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/lists/getlist?userId=3",
        success: function (response) {

            if (response == "Enter complete user information to save" | response == "Email already found") {
                alert("Error credentials")
            } else {
                $.each(response, function (i) {
                    $('#list').append('<li class="list-group-item">' + response[i].listName + '<button type="button" ' +
                        'class="btn btn-info" onclick="editList()"><span class="glyphicon glyphicon-search"></span> Edit</button><button type="button" ' +
                        'class="btn btn-info" onclick="deleteList()"><span class="glyphicon glyphicon-search"></span> Delete</button></li>');
                });
            }
        }
    });
    return false;
});

/*
 Redirect the edit list page
 */
function editList() {
    window.location = "http://localhost/Server_Side_CW1/TodoApp-Backend/dashboardController/viewList";
}

/*
 Delete popup
 */
function deleteList() {
    alert("Do you really want to delete?");
}