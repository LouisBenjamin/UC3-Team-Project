<?php
include 'core/init.php';
date_default_timezone_set('EST');
/** @var $pdo PDO */
global $pdo;
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_SESSION['user_id'])) {
  $user_data = User::getUserFromId($_SESSION['user_id']);
} else {
  header("refresh: 1; url=index.php");
  echo "You are not logged in...redirecting to login page. ";
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tato_submit'])) {
    $text = htmlspecialchars($_POST['tato_status']);
    if (strlen($text) > 140) {
      $error = 'Length exceeds 140 characters. ';
    } else {
      $getTato->postTato($user_data->user_id, $text);
    }
  }
   if (isset($_POST['image_submit'])) {
    $image = file_get_contents(addslashes($_FILES['image']['tmp_name']));
    $file = base64_encode($image);
    $getTato->uploadTato($file, $user_data->user_id);
  } 
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tato</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.2.1.min.js" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" defer></script>
    <style>
        .well p { text-align: left; }
        .well img { margin: 20px 0; }
        #a { background-color: lightblue; }
        #b { background-color: lightgreen; }
        #userName { color: black; font-weight: bold; font-size: medium; }
        #tatosfeed { font-weight: bold; font-size: large; padding: 11.75px; 
                     background-color:lightgray; border-radius: 5px; } 
    </style>

</head>

<body>
    
    <!--Navigation bar-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Tato</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">

                    <!-- redirect to Home page-->
                    <li class="active" id="post-new"><a href="home.php">Home</a></li>

                    <!-- redirect to -->
                    <li><a href="#" id="post-list">About</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <!-- redirect to My profile page-->
                    <li><a href="profile.php" id="categories-editor">
                        <span class="glyphicon glyphicon-user"></span> MyAccount</a></li>

                    <!-- redirect to login out page -->
                    <li><a href="includes/logout.php">Logout</a></li>
                </ul>
            </div>

        </div>
    </nav>

    
    <div class="container text-center">

        <div class="row">

            <!-- To display the sidebar-->
            <div class="col-sm-3 well">
                
                <div class="well" style="margin-bottom: 0">
                  
                    <img src="data:image/jpeg;base64,<?php echo $user_data->profile_image; ?>" class="img-circle"
                         height="80" width="80" alt="Profilepic"/>
                     <div>
                        <a href="profile.php" id="userName">
                           <?= $user_data->username; ?>     
                        </a>
                     </div>
                     <br>
                     <p id="a"><b> Followers: <?= $user_data->fan_count; ?></b></p>
                     <p id="b"><b> Following: <?= $user_data->idol_count; ?></b></p>
                     <br>
                </div>

            </div>

            <!-- To submit and display posts-->
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-md-12">
                      <div class="well" style="margin-bottom: 0">
                        <h4 style="text-align: left">Leave a Tato</h4>
                        <form role="form" method="post">
                            <div class="form-group">
                                 <textarea class="form-control" name="tato_status" rows="3" required></textarea>
                                  <?php
                                      if (isset($error)) {
                                        echo '<div class="span-fp-error">' . $error . '</div>';
                                      }
                                  ?>
                            </div>
                            <div style="text-align: right">
                                <button type="submit" name="tato_submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>

                        <!-- To upload picture-->
                        <form method="post" enctype="multipart/form-data" style="text-align: left">
                            <input type="file" name="image" id="image"/>
                            <input type="submit" value="Upload" name="image_submit" id="image-upload"/>
                        </form>
                      </div>
                      <br>
                      <p id="tatosfeed"> Tatos Feed </p>
                      <div style="text-align: left"> <?php $getTato->showTatoes(); ?> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>