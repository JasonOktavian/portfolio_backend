<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once "conn.php";

// Tambah User Baru
if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
       alert('New User has been Added');
       </script>";
        header("location: login.php");
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <style>
        label {
            display: block;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: whitesmoke;
        }

        .card {
            border: none;
            border-radius: 0;
            width: 420px !important;
            margin: 0 auto
        }

        .signup {
            display: flex;
            flex-flow: column;
            justify-content: center;
            padding: 10px 50px
        }

        a {
            text-decoration: none !important
        }

        h5 {
            color: black;
            margin-bottom: 3px;
            font-weight: bold
        }

        small {
            color: rgba(0, 0, 0, 0.3)
        }

        input {
            width: 100%;
            display: block;
            margin-bottom: 7px
        }

        .form-control {

            border-radius: 30px;
            background-color: rgba(0, 0, 0, .075);
            letter-spacing: 1px
        }

        .form-control:focus {

            border-radius: 30px;
            box-shadow: none;
            background-color: rgba(0, 0, 0, .075);
            color: #000;
            letter-spacing: 1px
        }

        .btn {
            display: block;
            width: 100%;
            border-radius: 30px;
            border: none;
            color: white;
            background: black;
        }

        .text-left {
            color: rgba(0, 0, 0, 0.3);
            font-weight: 400
        }

        .text-right {
            color: black;
            font-weight: bold
        }

        span.text-center {
            color: rgba(0, 0, 0, 0.3)
        }

        .fab {
            padding: 15px;
            font-size: 23px
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto py-4 px-0">
                <div class="card p-0" style="margin-top: 20vh;">
                    <div class="card-title text-center">
                        <h5 class="mt-5">HEY, THERE</h5> <small class="para">Register Your Account Below.</small>
                    </div>
                    <form class="signup" action="" method="POST">
                        <div class="form-group"><input type="text" name="username" id="username" class="form-control" placeholder="Username"></div>
                        <div class="form-group"><input type="email" name="email" id="email" class="form-control" placeholder="E-Mail"></div>
                        <div class="form-group"><input type="password" name="password" id="password" class="form-control" placeholder="Password"></div>
                        <div class="form-group"><input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm Password"></div>
                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                    </form>
                    <div class="row">
                        <div class="col"> <a href="login.php">
                                <p class="text-right pt-2 mr-1">Already Have An Account?</p>
                            </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>