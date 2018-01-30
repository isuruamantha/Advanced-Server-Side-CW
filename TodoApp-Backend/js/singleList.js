var userId = localStorage.getItem("userId");
console.log("userId " + userId);

/*
 To view/remove logout button
 */
if (localStorage.getItem("userName") != null) {
    document.getElementById("logout").innerHTML = "Logout";

} else {
    document.getElementById("logout").innerHTML = "";
    $('#todoapp').addClass('hidden');
}

$( function() {
    $("#newDatePicker").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#newDatePicker").datepicker('setDate', new Date());
} );

var app = {};
var listId = localStorage.getItem("listId");
var listName = localStorage.getItem("listName");
console.log(listName);
document.getElementById('list-name').innerHTML = listName;

// Models
app.Todo = Backbone.Model.extend({
    idAttribute: "itemId",
    urlRoot: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/items/"
});

// Collections
app.TodoList = Backbone.Collection.extend({
    model: app.Todo,
    url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/items/"
});

// instance of the Collection
app.todoList = new app.TodoList();

// renders individual todo items list (li)
app.TodoView = Backbone.View.extend({
    tagName: 'tr',
    template: _.template($('#item-template').html()),
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this; // enable chained calls
    },
    events: {
        'click #delete': 'deleteOne',
        'click #viewItem': 'viewItem'
    },
    deleteOne: function (e) {
        this.model.destroy();
        $('#listview tbody').empty();
        app.todoList.fetch({
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/items/" + listId
        });
    },
    viewItem: function (e) {
        window.location = "SingleList.html";
    }
});

app.AppView = Backbone.View.extend({
    el: '#todoapp',
    initialize: function () {
        this.input = this.$('#new-todo');
        app.todoList.on('add', this.addOne, this);
        app.todoList.on('reset', this.addAll, this);
        app.todoList.fetch({
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/items/" + listId
        });
    },
    events: {
        'click #saveList': 'saveList',
        'click #update-saveButton': 'updateListName'
    },
    updateListName: function (e) {
        var itemId = $("#edited-item-id").val();
        var itemName = $("#edited-newname").val();
        var itemDetails = $("#edited-itemDetails").val();
        var priority = $("#priority").val();
        var deadline = $("#datepicker").val();

        if (document.getElementById('edited-high').checked) {
            priority = "high"
        } else if (document.getElementById('edited-medium').checked) {
            priority = "medium"
        } else {
            priority = "low"
        }
        console.log(priority);
        var newtodo = new app.Todo;
        newtodo.set('itemId', itemId);
        newtodo.set('itemName', itemName);
        newtodo.set('itemDetails', itemDetails);
        newtodo.set('priority', priority);
        newtodo.set('deadline', deadline);
        newtodo.set('listId', listId);
        newtodo.save();

        $('#listview tbody').empty();
        app.todoList.fetch({
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/items/" + listId
        });
    },
    saveList: function (e) {

        var newname = $("#newname").val();
        var itemDetails = $("#itemDetails").val();
        var priority = $("#priority").val();
        var deadline = $("#newDatePicker").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        // var date = $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();
        console.log(deadline);
        if (document.getElementById('high').checked) {
            priorityLevel = document.getElementById('high').value;
        } else if (document.getElementById('medium').checked) {
            priorityLevel = document.getElementById('medium').value;
        } else {
            priorityLevel = document.getElementById('low').value;
        }

        var newtodo = new app.Todo;

        newtodo.save({
            itemName: newname, itemDetails: itemDetails,
            priority: priorityLevel, deadline: deadline,
            listId: listId
        });
        $('#listview tbody').empty();
        app.todoList.fetch({
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/items/" + listId
        });
    },
    addOne: function (todo) {
        var view = new app.TodoView({model: todo});
        $('#listview').append(view.render().el);
    },
    addAll: function () {
        // this.$('#todo-list').html(''); // clean the todo list
        $('#listview tbody').empty();
        app.todoList.each(this.addOne, this);
    }
});

app.appView = new app.AppView();

/*
 Logout function
 */
function logout() {
    localStorage.clear();
    window.location = "Login.html";
}

// Set data to the modal
$('#editItemModal').on('show.bs.modal', function (e) {
    var itemId = $(e.relatedTarget).data('item-id');
    var itemName = $(e.relatedTarget).data('item-name');
    var itemDetails = $(e.relatedTarget).data('item-details');
    var itemPriority = $(e.relatedTarget).data('item-priority');
    var itemDeadline = $(e.relatedTarget).data('item-deadline');

    console.log(itemPriority);
    $(e.currentTarget).find('input[name="edited-newname"]').val(itemName);
    $(e.currentTarget).find('input[name="edited-item-id"]').val(itemId);
    $(e.currentTarget).find('input[name="edited-itemDetails"]').val(itemDetails);

    if (itemPriority == "High") {
        $("#edited-high").prop("checked", true);
    } else if (itemPriority == "Medium") {
        $("#edited-medium").prop("checked", true);
    } else {
        $("#edited-low").prop("checked", true);
    }
    
    $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#datepicker").datepicker('setDate', itemDeadline);

});
