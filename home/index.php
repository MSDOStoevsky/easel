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
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Easel</a>
                </div>
                <!--<ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Page 1</a></li>
                    <li><a href="#">Page 2</a></li>
                </ul>-->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="things">
                <h3>Welcome to your Easel</h3>
            </div>
            <ul class="list-group">
                <a class="list-group-item">New <span class="badge">12</span></a>
                <a class="list-group-item">Deleted <span class="badge">5</span></a>
                <a class="list-group-item">Warnings <span class="badge">3</span></a>
            </ul>
        </div>
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>