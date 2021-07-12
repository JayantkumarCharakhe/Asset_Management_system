<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Asset Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assests/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container text-center mt-3">
        <div class="row ">
            <div class="col col-md-4 offset-4">

                <div class="signup-form">
                    <form action="loginProcess.php" method="post" enctype="multipart/form-data">
                        <h2>Login</h2>
                        <p class="hint-text"><b>Asset Management System</b></p>
                        <div class="form-group">
                        <fieldset>                
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Login</button>
                        </div>
                        </fieldset>
                        <div class="text-center">Don't have an account? <a href="register.php">Register Here</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>