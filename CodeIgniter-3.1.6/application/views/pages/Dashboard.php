<?php
$user_id = $this->session->userdata('userId');

if (!$user_id)
    redirect('userController/login_view');
if (sizeof($celebDetails) >= 2) {

    if ($celebDetails[0]['id'] == $celebDetails[1]['id'])
        redirect('dashboardController/getCelebrityDetails');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard- CeleVote</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>css/style.css">
</head>
<body style="background-image: url('<?php echo base_url('uploads/background_image.jpg'); ?>');
        background-size:cover; background-repeat:   no-repeat;
        background-position: center center;">

<div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6></div>
</div>

<div class=" container-fluid
    " style="margin-left: 140px; margin-right: 140px">
    <div class="row">

        <hr>
        <?php
        if (sizeof($celebDetails) >= 2) { ?>
            <?php foreach (array_slice($celebDetails, 0, 2) as $celebrity): ?>
                <div class="col-lg-6 ">

                    <form action="<?php echo base_url(); ?>dashboardController/vote" method="post">
                        <div class="panel panel-success box-shadow">
                            <div class="panel-heading" style="text-align: center">
                                <b><?php echo($celebrity['name']) ?></b>
                            </div>
                            <div>
                                <img src="<?php echo base_url('uploads/' . $celebrity['imagePath']) ?>"
                                     class="img-thumbnail  text-center center-block"
                                     alt="Cinque Terre"
                                     style="max-width: 100%; max-height: 100%;margin-top: 10px;width: 200px;height: 250px;
                                 object-fit: cover;">
                            </div>
                            <div class="panel-body"
                                 style="text-align: center"><?php echo($celebrity['description']) ?></div>
                            <?php echo form_hidden('celebrityId', $celebrity['id']); ?>
                            <?php echo form_hidden('userId', $user_id); ?>
                            <a href="<?php echo base_url('dashboardController/vote/'); ?>">
                                <button type="submit" style="display: block;margin: 0 auto; margin-bottom: 10px"
                                        class="btn btn-success box-shadow-button">Vote
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php } else if (sizeof($celebDetails) == 1) { ?>
            <div class="col-lg-12 center-block">
                <form action="<?php echo base_url(); ?>dashboardController/vote" method="post">
                    <div class="panel panel-success box-shadow">
                        <div class="panel-heading" style="text-align: center">
                            <b><?php echo($celebDetails[0]['name']) ?></b>
                        </div>
                        <div>
                            <img src="<?php echo base_url('uploads/' . $celebDetails[0]['imagePath']) ?>"
                                 class="img-thumbnail  text-center center-block"
                                 alt="Cinque Terre"
                                 style="max-width: 100%; max-height: 100%;margin-top: 10px;width: 200px;height: 250px;
                                 object-fit: cover;">
                        </div>
                        <div class="panel-body"
                             style="text-align: center"><?php echo($celebDetails[0]['description']) ?></div>
                        <?php echo form_hidden('celebrityId', $celebDetails[0]['id']); ?>
                        <?php echo form_hidden('userId', $user_id); ?>
                        <a href="<?php echo base_url('dashboardController/vote/'); ?>">
                            <button type="submit" style="display: block;margin: 0 auto; margin-bottom: 10px"
                                    class="btn btn-success box-shadow-button">Vote
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        <?php } else { ?>
            <div class="col-lg-12 center-block">
                <div class="panel panel-default">
                    <div class="panel-body center-block box-shadow" style="text-align: center;">
                        <span style="font-size: 80px;" class="glyphicon glyphicon-warning-sign "></span><br>
                        <span style="font-size: 30px">No celebrity data found!</span><br><br>
                        Please add a celebrity <br><br>
                        <a href="<?php echo base_url('dashboardController/ViewaddCelebrity'); ?>">
                            <button type="button" class="btn btn-success">Add a celebrity</button>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
    <a href="<?php echo base_url('dashboardController/'); ?>">
        <?php
        if (sizeof($celebDetails) >= 2) { ?>
            <button type="button" class="btn btn-md text-center center-block box-shadow-button"
                    style="margin-top: 10px">
                Reload
            </button>
        <?php } ?>
    </a>
</div>


</body>
</html>