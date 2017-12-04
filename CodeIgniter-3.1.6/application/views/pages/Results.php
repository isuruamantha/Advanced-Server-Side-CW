<?php
$user_id = $this->session->userdata('userId');

if (!$user_id)
    redirect('userController/login_view');
if (!$celebDetails)
    redirect('dashboardController/getCelebrityDetailsinDesc');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard- CeleVote</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <div class="text-center center-block">
        <button type="button" class="btn btn-success">Total count of votes &nbsp;<span
                    class="badge"><?php echo $totalCountOfVotes ?></span></button>
        <button type="button" class="btn btn-success">All registered users &nbsp;<span
                    class="badge"><?php echo $totalCountOfUsers ?></span></button>
        <button type="button" class="btn btn-success">Total celebrity count &nbsp;<span
                    class="badge"><?php echo $totalCountOfCelebrities ?></span></button>
    </div>
    <h2>Celebrities with votes</h2>
    <ul class="list-group">
        <?php foreach ($celebDetails as $celebrity): ?>
            <li class="list-group-item"><?php echo $celebrity['name']; ?><span
                        class="badge"><?php echo $celebrity['voteCount']; ?></span></li>
        <?php endforeach; ?>

    </ul>
</div>


</body>
</html>