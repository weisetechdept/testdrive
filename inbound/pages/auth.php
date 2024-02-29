<?php 
    session_start();
    date_default_timezone_set("Asia/Bangkok");

    if(isset($_POST['password'])){

        if($_POST['password'] == "1474413"){
            $_SESSION['testdrive_admin'] = true;
            header("location: /admin/home");
            exit();
        }else{
            header("location: /404");
            exit();
        }

    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Access</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Multipurpose Admin & Dashboard" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
 
    <div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-6">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="#" class="text-dark font-size-22 font-family-secondary">
                                                <b>TEST DRIVE</b>
                                            </a>
                                        </div>
                                        <h1 class="h5 mb-1">Welcome Back!</h1>
                                        <p class="text-muted mb-4">Enter your password to access admin panel.</p>

                                        <form action="/inbound/pages/auth.php" method="post" class="user">
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Log In </button>
                                        </form>
                                        
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>