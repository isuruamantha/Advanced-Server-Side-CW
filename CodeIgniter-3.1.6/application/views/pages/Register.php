<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration - CeleVote</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen"
          title="no title">

</head>
<body>

<span style="background-color:red;">
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title">Registration</h3>
                  </div>
                  <div class="panel-body">

                  <?php
                  $error_msg = $this->session->flashdata('error_msg');
                  if ($error_msg) {
                      echo $error_msg;
                  }
                  ?>

                      <!--Registration form-->
                      <form role="form" method="post" action="<?php echo base_url('userController/register_user'); ?>">
                          <fieldset>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                  <input class="form-control" placeholder="Username" name="userName" type="text"
                                         autofocus>
                              </div><br>

                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <input class="form-control" placeholder="Email Address" name="userEmail" type="email"
                                         autofocus>
                              </div><br>

                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                  <input class="form-control" placeholder="Password" name="userPassword"
                                         type="password" value="">
                              </div><br>

                              <input class="btn btn-lg btn-success btn-block" type="submit" value="Register"
                                     name="register">

                          </fieldset>
                      </form>
                      <center><b>Already registered ?</b> <br>
                          </b><a href="<?php echo base_url('userController/login_view'); ?>">Login here</a></center>

                  </div>
              </div>
          </div>
      </div>
  </div>
</span>
</body>
</html>