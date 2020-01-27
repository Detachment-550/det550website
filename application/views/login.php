<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <title><?php echo $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="/application/third_party/jQuery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/application/third_party/bootstrap-4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/application/third_party/bootstrap-4.3.1/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/application/third_party/bootstrap-4.3.1/css/bootstrap-reboot.min.css">
    <script type="text/javascript" src="/application/third_party/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>

<style>
    @media (max-width: 500px) {
        div.card {
            width: 100%;
        }
    }
    @media (min-width: 500px) {
        div.card {
            width: 40%;
        }
    }
    .jumbotron{
        height: 100vh;
        margin: 0;
    }
</style>

<body class="text-center">
<div class="jumbotron-fluid jumbotron">
    <div class="container">
        <div class="card" style="margin: auto;padding: 10px;">
            <div class="card-body">
                <form action="/index.php/login/auth" method="POST">
                    <div class="alert alert-warning" role="alert" style="display: <?php if(isset($error)) { echo "block";} else {echo "none";} ?>">
                        <?php echo $error; ?>
                    </div>
                    <img class="img-fluid" src="/images/default.jpeg" alt="Responsive image">
                    <h5 class="card-title">Please Sign In</h5>
                    <label for="uname"><b>Email</b></label><br>
                    <input class="form-control" type="text" placeholder="Enter your email" name="user" required><br>

                    <label for="psw"><b>Password</b></label><br>
                    <input class="form-control" type="password" placeholder="Enter your password" name="psw" required><br>
                    <br>
                    <button class="btn btn-sm btn-primary" type="submit" name="submit">Login</button>
                    <button class="btn btn-sm btn-secondary" type="reset" name="reset">Reset</button>
                </form>
                <br>
                <a href="/index.php/login/forgot">Forgot Password</a>
            </div>
        </div>
    </div>
</div>

