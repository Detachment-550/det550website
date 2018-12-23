<head>
	<title>Connect RFID</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
  <div class="jumbotron container-fluid">
	<h1 class="display-4"> Connect RFID </h1>
	<div class="card">
	  <div class="card-body">
        <?php echo form_open('cadet/saverfid'); ?>          
			RIN: <input class="form-control" type="text" name="rin"/><br>
			Scan Card: <input class="form-control" type="text" name="rfid"/><br>
			<input class="btn btn-primary btn-sm" type="submit" name="addcard" value="Submit"/>
		  </form>
	  </div>
  </div>
</body>