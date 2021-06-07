<?php include('server.php')

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Diary Entry</title>
    <style>
    body{
      background-image: url("five-year-diary.jpg");
      background-position: center;
      background-repeat: no-repeat;
        background-size: cover;
        height=100%;
        margin-top: 50px;
      text-align: center;}

      h1{
        text-align: center;
        margin-top: 0;
        color:#fc5404;
        font-size: 60px;
      }
      p{
        font-size: 40px;
        font-style: italic;
        color:#f98404;
      }
      .hi{
        margin-top: 3px;
        font-size: 20px;
        color:black;
        text-align: center;
      }
    }
    </style>
  </head>

  <body>

    <div class="display">
      <h1 >Today's Entries..</h1><br></br>
      <p class= "hi">Today's tasks include : 1) Complete TYRO 101 assignment
      2) Review project</p>
      <p>Work Entry:</p>
    <?php if(isset($_SESSION['username']))
    {displaydata($_SESSION['username'],'work');}?>
      </div>
      <div class= "personal">
        <p>Personal Entry:</p>
      <?php if(isset($_SESSION['username']))
    {displaydata($_SESSION['username'],'personal');}?>

    </div>

  </body>
</html>
