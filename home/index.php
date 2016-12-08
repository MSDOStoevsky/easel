<php
include('../databaseconn.php') 
     
     
     
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Welcome Home!</title>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <meta name="description" content="The Fair-Use Test Taking Site" />
            <meta name="keywords" content="MTU, Website, Grading, Testing, Exam" />
            <meta name="author" content="Dylan Lettinga, Ben Slade" />

            <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
            <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
        </head>
    </html>
    <body>
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand">Easel</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
              <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
          </div>
        </nav>
        <div class="container">
            <div class="things">
                <h3>Welcome to your Easel</h3>
                <h6>Here are your paints</h6>
            </div>
        </div>
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>