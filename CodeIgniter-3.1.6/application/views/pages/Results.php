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