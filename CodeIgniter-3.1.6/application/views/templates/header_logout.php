<!DOCTYPE html>
<html lang="en">
<head>
    <title>Celevote</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(); ?>usercontroller">Celevote</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url(); ?>dashboardController">Home</a></li>
            <li><a href="<?php echo base_url(); ?>dashboardController/getCelebrityDetailsinDesc">Leaderboard</a></li>
            <li><a href="<?php echo base_url(); ?>dashboardController/ViewaddCelebrity">Add celebrity</a></li>
        </ul>
        <div class="navbar-header" style="float: right">
            <a class="navbar-brand" href="<?php echo base_url('userController/user_logout'); ?>">Logout</a>
        </div>
    </div>
</nav>


</body>
</html>
