<?php
$user_id = $this->session->userdata('userId');

if (!$user_id)
    redirect('userController/login_view');
if ($celebDetails[0]['id'] == $celebDetails[1]['id'])
    redirect('dashboardController/getCelebrityDetails');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard- CeleVote</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <?php
        foreach (array_slice($celebDetails, 0, 2) as $celebrity): ?>
            <div class="col-sm-4">

                <form action="<?php echo base_url(); ?>dashboardController/vote" method="post">
                    <div class="panel panel-success">
                        <div class="panel-heading"><?php echo($celebrity['name']) ?></div>
                        <img src="<?php echo base_url('uploads/' . $celebrity['imagePath']) ?>" class="img-thumbnail"
                             alt="Cinque Terre" width="304" height="236">
                        <div class="panel-body"><?php echo($celebrity['description']) ?></div>
                        <?php echo form_hidden('celebrityId', $celebrity['id']); ?>
                        <?php echo form_hidden('userId', $user_id); ?>
                        <a href="<?php echo base_url('dashboardController/vote/'); ?>">
                            <button type="submit" class="btn btn-success">Vote</button>
                        </a>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>


    <a href="<?php echo base_url('userController/user_logout'); ?>">
        <button type="button" class="btn-primary">Logout</button>
    </a>

    <a href="<?php echo base_url('dashboardController/ViewaddCelebrity'); ?>">
        <button type="button" class="btn-primary">add a celebrity</button>
    </a>
</div>
</body>
</html>