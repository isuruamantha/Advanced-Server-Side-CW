<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration - CeleVote</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen"
          title="no title">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>css/style.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/register.js"></script>
</head>
<body style="background-image: url('<?php echo base_url('uploads/background_image.jpg'); ?>');
        background-size:cover; background-repeat:   no-repeat;
        background-position: center center;  ">

<span style="background-color:red;">
  <div class="container ">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title text-center center-block"><b>Registration</b></h3>
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

                      <!--Registration form-->
                      <form role="form" method="post" action="./">
                          <fieldset>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                  <input class="form-control" placeholder="Username" name="userName" type="text"
                                         maxlength="40" id="userName"
                                         value="<?php echo set_value('userName'); ?>" autofocus>
                              </div><br>

                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <input class="form-control" placeholder="Email Address" name="userEmail" type="email"
                                         maxlength="40" id="userEmail"
                                         value="<?php echo set_value('userEmail'); ?>" autofocus>
                              </div><br>

                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                  <input class="form-control" placeholder="Password" name="userPassword" maxlength="10"
                                         id="userPassword"
                                         value="<?php echo set_value('userPassword'); ?>" type="password">
                              </div><br>

                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                  <input class="form-control" placeholder="Confirm Password" name="userPasswordConfirm"
                                         maxlength="10" id="confirmUserPass"
                                         value="<?php echo set_value('userPasswordConfirm'); ?>" type="password">
                              </div><br>

                              <input class="btn btn-lg btn-success btn-block box-shadow-button" type="submit"
                                     value="Register" name="register" id="register">

                          </fieldset>
                      </form>
                      <center style="margin-top: 8px"><b>Already registered ?</b> <br>
                          </b><a href="<?php echo base_url('userController/login_view'); ?>">Login here</a></center>

                  </div>
              </div>
          </div>
      </div>
  </div>
</span>
</body>
</html>