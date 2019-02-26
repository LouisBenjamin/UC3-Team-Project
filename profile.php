<?php 
 

?>


<!DOCTYPE html>

<html lang = "en">
<head>
<title> My profile</title>
<meta charset = "utf-8" />
        <title>Tato</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">



</head>

<body>
	 <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Tato</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li  id="post-new"><a href="home.php">Home</a></li>

                        <!-- redirect to -->
                        <li><a href="#" id="post-list">About</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                       <li class="active"><a  href="profile.php" id="categories-editor"><span class="glyphicon glyphicon-user"></span> My Account</a></li>

                       <!-- redirect to -->
                       <li><a href="index.php">Logout</a></li>
                    </ul>
                </div>

            </div>
        </nav>

            <div class="container">    
                  <div class="row">
                      <div class="panel panel-default">
                      <div class="panel-heading">  <h4 style='text-align: center;'>User Profile</h4></div>
                       <div class="panel-body">
                      <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                        <br> 
                       <center><img alt="User" src="assets/images/profilepic.png" id="profile-image1" class="img-circle" style="width: 70%; "> </center>
                     
                 
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
                          <div class="container" >
                            <h2>Name         <button type="submit" name="follow" class="btn btn-default" style= "margin-left: 570px">Edit</button> </h2>
                            <p> <b> Bio</b></p>

    
                           
                          </div>
                           <hr>
                          <ul class="container details" >
                            <li><p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>UserID</p></li>
                            <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>email</p></li>
                    
                          </ul>
                          <hr>

                          <div class="col-sm-5 col-xs-6 tital " ><button type="submit" name="follow" class="btn btn-success">Follow</button> </div>
                      </div>
                </div>
            </div>
            </div>
</body>

</html>

