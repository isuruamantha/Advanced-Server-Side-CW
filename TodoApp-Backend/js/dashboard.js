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


var app = {};

// Models
app.Todo = Backbone.Model.extend({
    idAttribute: "listId",
    urlRoot: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/lists/"
});
// Collections
app.TodoList = Backbone.Collection.extend({
    model: app.Todo,
    url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/lists/"
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
        'click #viewItem': 'viewItem',
        'click #edit': 'editList'
    },
    editList: function (e) {
        app.currentList = this.model;
    },
    deleteOne: function (e) {
        console.log("delete");
        console.log(this.model);
        this.model.destroy();
        $('#listview tbody').empty();
        app.todoList.fetch({
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/lists/" + userId
        });
    },
    viewItem: function (e) {
        var listId = (this.model.get("listId"));
        var listName = (this.model.get("listName"));
        localStorage.setItem("listId", listId);
        localStorage.setItem("listName", listName);
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
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/lists/" + userId
        });
    },
    events: {
        'click #saveList': 'saveList',
        'click #update-saveButton': 'updateListName'
    },
    saveList: function () {
        var val = $("#newname").val()
        var newtodo = new app.Todo;
        newtodo.set('listName', val);
        newtodo.set('userId', userId);
        newtodo.save();
        $('#listview tbody').empty();
        app.todoList.fetch({
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/lists/" + userId
        });
    },
    updateListName: function (e) {
        var listId = $("#listId-updated").val();
        var listName = $("#listNameNew").val();
        var newtodo = new app.Todo;
        newtodo.set('listId', listId);
        newtodo.set('listName', listName);
        newtodo.save();
        $('#listview tbody').empty();
        app.todoList.fetch({
            url: "http://localhost/Server_Side_CW1/TodoApp-Backend/api/lists/" + userId
        });

    },
    addOne: function (todo) {
        var view = new app.TodoView({model: todo});
        $('#listview').append(view.render().el);
    },
    addAll: function () {
        // this.$('#todo-list').html('');
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
$('#editModal').on('show.bs.modal', function (e) {
    var listName = $(e.relatedTarget).data('list-name');
    var listId = $(e.relatedTarget).data('list-id');
    $(e.currentTarget).find('input[name="listNameNew"]').val(listName);
    $(e.currentTarget).find('input[name="listId-updated"]').val(listId);
});
