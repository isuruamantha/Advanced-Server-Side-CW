<?php
//$user_id = $this->session->userdata('userId');
//
//if (!$user_id)
//    redirect('userController/login_view');
//if (sizeof($celebDetails) >= 2) {
//
//    if ($celebDetails[0]['id'] == $celebDetails[1]['id'])
//        redirect('dashboardController/getCelebrityDetails');
//}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard- CeleVote</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>css/style.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/dashboard.js"></script>
</head>
<body style="background-image: url('<?php echo base_url('uploads/background_image.jpg'); ?>');
        background-size:cover; background-repeat:   no-repeat;
        background-position: center center;">

<div class="container">
    <button type="button" class="btn btn-primary">Add</button>
    <ul class="list-group" id="list">
    </ul>
</div>


</body>
</html>