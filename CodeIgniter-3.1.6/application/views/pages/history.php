<?php
$user_id = $this->session->userdata('userId');

if (!$user_id)
    redirect('userController/login_view');
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
        background-position: center center;  ">

<div class="container">

    <h2>User Voting History</h2>
    <ul class="list-group box-shadow">
        <?php
        $i = 1;
        foreach ($userHistory as $historyData): ?>
            <li class="list-group-item"><?php echo $i ?>) <?php echo $historyData['name']; ?><span
                        class="badge badge-primary"
                        style="background-color: #990000">Voted date: <?php echo $historyData['votedDate'];
                    $i++; ?></span></li>
        <?php endforeach; ?>

    </ul>
</div>


</body>
</html>