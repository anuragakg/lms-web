<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Global School of Trading</title>
	<?php include('parts/head-tag.php'); ?>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="index.html"><img src="assets/images/logo.jpeg"></a>
                        </div>
                        <div class="login-form">
                            <form method="post" id="resetformID">
							<label><strong>Reset Password</strong></label>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" placeholder="password" id="password" required name="password">
									
                                </div>
								<div class="form-group">
                                    <label>Conform Password</label>
                                    <input type="password" class="form-control" placeholder="password" id="password_confirmation" required name="password_confirmation">
									
                                </div>
								<span class="text-success" id="success_msg"></span>
								<label class="pull-right">
									<a href="index.php">Login</a>
								</label>
                                <button type="submit" class="btn btn-primary btn-flat m-t-30">Submit</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('parts/login-js-files.php'); ?>

<script type="text/javascript" src="assets/js/custom/forgotpassword.js?v=<?php echo time(); ?>"></script>
</body>

</html>