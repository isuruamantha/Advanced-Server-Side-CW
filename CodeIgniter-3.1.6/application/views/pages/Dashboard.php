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

<div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6></div>
</div>

<div class=" container-fluid
    " style="margin-left: 140px; margin-right: 140px">
    <div class="row">
        <script type='text/javascript' src="<?php echo base_url();
        ?>js/text_animation.js"></script>
        <div>
            <h1>
                <a class="typewrite" data-period="2000"
                   data-type='[ "Please vote for your favourite celebrity...", "You can vote multiple times..." ]'>
                    <span class="wrap"></span>
                </a>
            </h1>
        </div>

        <hr>
        <?php
        foreach (array_slice($celebDetails, 0, 2) as $celebrity): ?>
            <div class="col-lg-6">

                <form action="<?php echo base_url(); ?>dashboardController/vote" method="post">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="text-align: center"><b><?php echo($celebrity['name']) ?></b>
                        </div>
                        <div style="height: 200px; width: 200px; overflow: hidden; display: block;margin: 0 auto;">
                            <img src="<?php echo base_url('uploads/' . $celebrity['imagePath']) ?>"
                                 class="img-thumbnail"
                                 alt="Cinque Terre" style="max-width: 100%;max-height: 100%; margin-top: 10px"></div>
                        <div class="panel-body"
                             style="text-align: center"><?php echo($celebrity['description']) ?></div>
                        <?php echo form_hidden('celebrityId', $celebrity['id']); ?>
                        <?php echo form_hidden('userId', $user_id); ?>
                        <a href="<?php echo base_url('dashboardController/vote/'); ?>">
                            <button type="submit" style="display: block;margin: 0 auto; margin-bottom: 10px"
                                    class="btn btn-success">Vote
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="<?php echo base_url('dashboardController/'); ?>">
        <button type="button" class="btn btn-primary btn-md text-center center-block" style="margin-top: 10px">Reload
        </button>
    </a>
</div>


</body>
</html>