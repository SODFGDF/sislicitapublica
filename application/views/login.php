<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NOVACAP | Licitações</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url("assets/plugins/fontawesome-free/css/all.min.css"); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/adminlte.min.css"); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style type="text/css" media="screen">
        .login-page {
            width: 100%;
            height: 100%;
            position: absolute;
            background: url('<?php echo base_url("assets/images/background.jpg"); ?>') no-repeat fixed;
            background-size: cover;
            background-position: 50%;    
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?php echo base_url("assets/images/logo.png"); ?>" alt=""><br>
            <a href="<?php echo base_url(""); ?>"><b>LicitaSIS</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <p class="login-box-msg">Informe seus dados de acesso</p>
                <?php $this->load->helper('form'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
                <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $error; ?>
                </div>
                <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $success; ?>
                </div>
                <?php } ?>
                <form action="<?php echo base_url(); ?>loginMeAD" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Usuário" name="login" required autofocus/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user-lock" style="color: orange;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Senha" name="password" id="password-field" value="" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
								<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
                        <!-- /.col -->
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-outline-primary">Acessar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
                <!-- /.social-auth-links -->

                <!-- <p class="mb-1">
                    <a href="<?php echo base_url() ?>forgotPassword">Esqueci minha senha</a>
                </p> -->
                <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url("assets/plugins/jquery/jquery.min.js"); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url("assets/dist/js/adminlte.min.js"); ?>"></script>

	<script>

		$(".toggle-password").click(function() {
		  $(this).toggleClass("fa-eye fa-eye-slash");
		  var input = $($(this).attr("toggle"));
		  if (input.attr("type") == "password") {
			input.attr("type", "text");
		  } else {
			input.attr("type", "password");
		  }
		});

	</script>

</body>

</html>
