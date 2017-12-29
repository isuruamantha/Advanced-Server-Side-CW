<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add a celebrity - CeleVote</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen"
          title="no title">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>css/style.css">

</head>
<body style="background-image: url('<?php echo base_url('uploads/background_image.jpg'); ?>');
        background-size:cover; background-repeat:   no-repeat;
        background-position: center center;  ">

<span style="background-color:red;">
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title text-center center-block"><b>Add a Celebrity</b></h3>
                  </div>
                  <div class="panel-body box-shadow">

                  <?php
                  $success_msg = $this->session->flashdata('success_msg');
                  $error_msg = $this->session->flashdata('error_msg');
                  if ($success_msg) {
                      ?>
                      <div class="alert alert-success">
                        <?php echo $success_msg; ?>
                    </div>
                      <?php
                  }
                  if ($error_msg || validation_errors()) {
                      ?>
                      <div class="alert alert-danger">
                        <?php
                        print_r($error_msg);
                        echo validation_errors();
                        ?>
                    </div>
                      <?php
                  }
                  ?>

                      <!--Add a celebrity form-->
                      <?php echo form_open_multipart('DashboardController/do_upload') ?>

                      <fieldset>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Celebrity Name" name="celebName" type="text"
                                         maxlength="40"
                                         value="<?php echo set_value('celebName'); ?>" autofocus>
                              </div>

                                <div class="form-group">
                                  <input class="form-control" placeholder="Description" name="celebDescription"
                                         maxlength="100"
                                         type="text" value="<?php echo set_value('celebDescription'); ?>" autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="uploads">Upload a file</label>
                                     <input type="file" name="userfile" size="20"/>
                                </div>

                          <input class="btn btn-lg btn-success btn-block box-shadow-button" type="submit" value="Upload"
                                 name="register">

                          <?php echo form_close() ?>

                  </div>
              </div>
          </div>
      </div>
  </div>
</span>
</body>
</html>