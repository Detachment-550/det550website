<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<title>Security Question</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style>
    /* Styles for mobile */
    @media (max-width: 500px) 
    {
        .card
        {
            width: 100%;
        }
        body
        {
            min-width: 400px;
        }
    }
    @media (min-width: 600px) 
    {
        .card
        {
            width: 40%;
        }
    }
    </style>
</head>
    
<body>
<div class="jumbotron container-fluid">
  <div class="container">
    <h1 class="display-4">Security Question</h1>
    <div style="width:90%;display:block;margin-left:auto;margin-right:auto;" class="card" id="Edit Groups">
      <div class="card-body">
        
      <?php echo form_open('cadet/saveanswer'); ?>
      
          <h4>Security Question:</h4>
          <select name="question">
            <option value="What was your childhood nickname?">What was your childhood nickname?</option>
            <option value="What is the name of your favorite childhood friend?">What is the name of your favorite childhood friend?</option>
            <option value="In what city or town did your mother and father meet?">In what city or town did your mother and father meet?</option>
            <option value="What is your favorite team?">What is your favorite team?</option>
            <option value="What is your favorite movie?">What is your favorite movie?</option>
            <option value="What was your favorite sport in high school?">What was your favorite sport in high school?</option>
            <option value="What was your favorite food as a child?">What was your favorite food as a child?</option>
            <option value="What was the make and model of your first car?">What was the make and model of your first car?</option>
            <option value="Who is your childhood sports hero?">Who is your childhood sports hero?</option>
            <option value="In what town was your first job?">In what town was your first job?</option>
            <option value="What was the name of the company where you had your first job?">What was the name of the company where you had your first job?</option>
          </select><br><br>
          <h4 class="card-text">Response:</h4>
          <input type="text" style="width:100%;" name="answer" id="answer"><br><br>
          <button class="btn btn-sm btn-primary" type="submit" name="submit">Save Answer</button>
        </form><br>
    </div>
</div>

</body>