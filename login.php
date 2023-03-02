<?php
session_start();
require_once "conn.php";

//cek cookie (lebih bagus simpen cookie di DB)
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id ='$id'");
    $row = mysqli_fetch_assoc($result);
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
?>

<?php
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username ='$username'");
    // cek username
    if (mysqli_num_rows($result) == 1) {
        // cek Password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST['remember'])) {
                //buat cookie
                setcookie('id', $row['id'], time() + 120);
                setcookie('key', hash('sha256', $row['username']), time() + 120);
            }
            header("Location:index.php");
            exit;
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto py-4 px-0">
                <div class="card p-0" style="margin-top: 20vh;">
                    <div class="card-title text-center">
                        <h5 class="mt-5">HEY, THERE</h5> <small class="para">Login To Your Account Below.</small>
                    </div>
                    <form class="signup" action="" method="POST">
                        <div class="form-group"><input type="text" name="username" id="username" class="form-control" placeholder="Username"></div>
                        <div class="form-group"><input type="password" name="password" id="password" class="form-control" placeholder="Password"></div>
                        <label>Remember Me</label> <input class="checkbox float-left" type="checkbox" name="remember" id="remember">


                        <button type="submit" class="btn btn-secondary" name="login">Login</button>
                        <div class="row">
                            <div class="col"> <a href="register.php">
                                    <p class="text-right pt-2 mr-1">Sign Up Now</p>
                                </a> </div>
                            <?php if (isset($error)) : ?>
                                <p style="color: red; font-style:italic; text-align: center;">Please Check Your Username or Password Again</p>

                                <!-- <script>
                                    alert('Please Check Your Username Or Password');
                                </script> -->
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="submit" value="Login" name="login" />
            </li>
        </ul>
    </form> -->
</body>

</html>