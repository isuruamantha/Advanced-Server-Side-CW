<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add a celebrity - CeleVote</title>

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
                      <h3 class="panel-title">Add a Celebrity</h3>
                  </div>
                  <div class="panel-body">

                  <?php
                  $error_msg = $this->session->flashdata('error_msg');
                  if ($error_msg) {
                      echo $error_msg;
                  }
                  ?>

                      <!--Add a celebrity form-->
                      <?php echo form_open_multipart('DashboardController/do_upload') ?>

                      <fieldset>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Celebrity Name" name="celebName" type="text"
                                         autofocus>
                              </div>

                                <div class="form-group">
                                  <input class="form-control" placeholder="Description" name="celebDescription"
                                         type="text"
                                         autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="uploads">Upload a file</label>
                                     <input type="file" name="userfile" size="20"/>
                                </div>

                          <input class="btn btn-lg btn-success btn-block" type="submit" value="Upload"
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