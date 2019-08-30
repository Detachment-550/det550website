<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <title><?php echo $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


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
    </style>

</head>

<body class="text-center">
<div class="card" style="margin:auto;padding: 10px;width:80%;">
    <div class="card-body">
        <form action="/index.php/login/question" method="POST">
            <h5 class="card-title">Password Reset</h5>
            <p>(sends new temporary password to your email)</p><br>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" placeholder="Enter your email..." name="email" id="email" required>
            </div>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Reset Password</button>
        </form>
    </div>
</div>
