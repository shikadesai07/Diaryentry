<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Diary!</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Enter Your Thoughts!</h2>
  </div>

  <form method="post" action="entry.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
      <h1 >Greetings! We hope you are doing well!</h1>
      <label>Personal Entry</label>
  	  <input type="text" name="personal" value="<?php echo $personal; ?>">
  	</div>
  	<div class="input-group">
  	  <label>work entry</label>
  	  <input type="text" name="work" value="<?php echo $work; ?>">
  	</div>

    <div class="input-group">
      <button type="submit" class="btn" name="submit">submit</button>

    </div>

  </form>
</body>
</html>
