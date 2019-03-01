<?php
require('core/init.php');

if(isset($_GET['id'])) {
  $user_data = User::getUserFromId($pdo, $_GET['id']);
}
else if(isset($_SESSION['user_id'])) {
  $user_data = User::getUserFromId($pdo, $_SESSION['user_id']);

  if (isset($_POST['image_submit'])) {
    $image = file_get_contents(addslashes($_FILES["image"]["tmp_name"]));
    $file = base64_encode($image);
    $getUser->upload($file, $user_data->user_id);
  }
}


?>


<!DOCTYPE html>
<html lang="en-US">
<head>
    <title> My profile</title>
    <meta charset="utf-8"/>
    <title>Tato</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="css/main.css">-->


</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Tato</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li id="post-new"><a href="home.php">Home</a></li>

                <!-- redirect to -->
                <li><a href="#" id="post-list">About</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="profile.php" id="categories-editor"><span
                                class="glyphicon glyphicon-user"></span> My Account</a></li>

                <!-- redirect to -->
                <li><a href="index.php">Logout</a></li>
            </ul>
        </div>

    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4 style='text-align: center;'>User Profile</h4></div>
            <div class="panel-body">
                <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                    <br>
                    <img src="data:image/jpeg;base64,<?php echo $user_data->profile_image; ?>" height="100"
                         width="100" alt="Profile Photo"/>

                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="image" id="image"/>
                        <input type="submit" value="Upload" name="image_submit" id="image-upload"/>
                    </form>
                </div>
                <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                    <div class="container">
                        <h2><?php echo  $user_data->username; ?>
                            <button type="submit" name="follow" class="btn btn-default" style="margin-left: 570px">
                                Edit
                            </button>
                        </h2>
                        <p><?php echo  $user_data->bio; ?></p>


                    </div>
                    <hr>
                    <ul class="container details">
                        <li><p>ID: <?php echo  $user_data->user_id; ?></p></li>
                        <li><p><?php echo  $user_data->email; ?></p></li>
                    </ul>
                    <hr>

                    <div class="col-sm-5 col-xs-6 tital ">
                        <button type="submit" name="follow" class="btn btn-success">Follow</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
