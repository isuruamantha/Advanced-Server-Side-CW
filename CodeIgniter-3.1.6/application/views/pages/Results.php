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
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>css/style.css">
</head>
<body style="background-image: url('<?php echo base_url('uploads/background_image.jpg'); ?>');
        background-size:cover; background-repeat:   no-repeat;
        background-position: center center;  ">

<div class="container">

    <div class="text-center center-block">
        <button type="button" class="btn btn-success box-shadow-button">Total count of votes &nbsp;<span
                    class="badge"><?php echo $totalCountOfVotes ?></span></button>
        <button type="button" class="btn btn-success box-shadow-button">All registered users &nbsp;<span
                    class="badge"><?php echo $totalCountOfUsers ?></span></button>
        <button type="button" class="btn btn-success box-shadow-button">Total celebrity count &nbsp;<span
                    class="badge"><?php echo $totalCountOfCelebrities ?></span></button>
    </div>
    <div class="text-center center-block" style="margin-top: 10px">
        <a href="<?php echo base_url('dashboardController/'); ?>">
            <button type="button" class="btn btn-warning box-shadow-button margin-top-button">Vote for another celebrity
                &nbsp;<span
            </button>
        </a>
    </div>
    <hr>
    <h2 class="text-center center-block"">Celebrities with votes</h2>
    <ul class="list-group box-shadow">
        <?php
        $i = 1;
        foreach ($celebDetails as $celebrity): ?>
            <li class="list-group-item"><?php echo $i ?>) <?php echo $celebrity['name']; ?><span
                        class="badge badge-primary"
                        style="background-color: #990000"><?php echo $celebrity['voteCount'];
                    $i++; ?></span></li>
        <?php endforeach; ?>

    </ul>
    <hr>

    <div>
        <h2 class="text-center center-block" style="color: white">Voting Results Chart</h2>
        <div id="piechart" class="box-shadow"></div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Celebrity Name', 'Votes'],
                    <?php foreach($celebDetails as $celebrity): ?>
                    ['<?= $celebrity['name'] ?>', <?= $celebrity['voteCount'] ?>],
                    <?php endforeach; ?>
                ]);
                var options = { 'height': 400};

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>
    </div>

</div>


</body>
</html>