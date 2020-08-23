<?php
session_start();
if(!empty($_SESSION["sessionId"]) or isset($_SESSION["sessionId"])) {
  header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Organization Name - DES | Log In</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">

</head>

<body class="hold-transition login-page">
    
    <div class="login-box">
        <div style="text-align:center; margin-bottom:50px;">        
            <a href="https://cheec.uiowa.edu/" class="text-center" target="_blank">
                <img src="./dist/img/Logo.png" alt="Organization Logo" class="profile-user-img img-responsive img-circle"/>
            </a>
            <h2 class="text-center">Organization Name</h2>
            <h2 class="text-center"><b>Data Exploration System</b></h2>
        </div>
        <div class="card">
            <div id="login-failed-alert" class="alert alert-danger alert-dismissible" style="display:none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Login Failed</h5>
                    Invalid Username or Password, try again.
            </div>
            
            <div class="card-body login-card-body">
                <!-- <p class="login-box-msg"><b>Log in</b></p> -->
                <form action="./api/login_verify.php" method="post">
                    <?php
                      if (isset($_SESSION["errorMessage"]) && !empty($_SESSION["errorMessage"])) {?>
                      <script>document.getElementById("login-failed-alert").style.display="block"
                      </script>
                    <?php
                        unset($_SESSION["errorMessage"]);
                      }
                    ?>
                    <div id="username-group" class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="on" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
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
                        <div class="col-4">
                            <button type="submit" name="login" value="Log In" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <footer>
        <strong>&copy; 2020 - <a href="#" target="_blank">Muneeb Shahid</a></strong>
    </footer>
    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>

</body>

</html>
