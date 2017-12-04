<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login - CeleVote</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen"
          title="no title">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title text-center center-block">Login</h3>
                </div>

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

                <!--                Login Form-->
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo base_url('userController/login_user'); ?>">
                        <fieldset>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" placeholder="Username" name="userName" type="text"
                                       value="<?php echo set_value('userName'); ?>" autofocus>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input class="form-control" placeholder="Password" name="userPassword" type="password"
                                       value="<?php echo set_value('userPassword'); ?>" value="">
                            </div>
                            <br>

                            <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login">

                        </fieldset>
                    </form>
                    <center><b>Not registered ?</b> <br></b><a
                                href="<?php echo base_url('userController/register_view'); ?>">Register
                            here</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>