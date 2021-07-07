<?php
require 'connection.php';
if (isset($_POST['btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO register( `name`, `email`, `password`) 
	VALUES ('$name','$email','$password')";
    if (mysqli_query($conn, $sql)) {
?>
        <script>
            alert("User Regisiterd Success");
            window.location.href = "login.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Error");
        </script>
<?php
    }
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Register User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assests/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js">
        < /scrip> <
        script src = "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" >
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container text-center mt-3">
        <div class="row ">
            <div class="col col-md-4 offset-4">

                <div class="signup-form">
                    <form method="post" id="fupForm" name="form1">
                        <h2>Register</h2>
                        <p class="hint-text">Create your account</p>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Username" required="required">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
                        </div>


                        <div class="form-group">
                            <button type="submit" name="btn" id="butsave" class="btn btn-success btn-lg btn-block">Register Now</button>
                        </div>
                        <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

</html>