<?php
include dirname(__FILE__) . '/core/init.php';
date_default_timezone_set('EST');
/** @var $pdo PDO */
global $pdo;
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_SESSION['user_id'])) {
    $user_data = UserManager::getUserFromId($_SESSION['user_id']);
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
    <meta charset="UTF-8">
    <title>Tato</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--        <link rel="stylesheet" href="css/main.css">-->
    <style>
        .well p {
            text-align: left;
        }

        .well img {
            margin: 20px 0;
        }
    </style>

    <script src="https://code.jquery.com/jquery-2.2.1.min.js" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" defer></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Tato</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active" id="post-new"><a href="home.php">Home</a></li>

                <!-- redirect to -->
                <li><a href="#" id="post-list">About</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="profile.php" id="categories-editor"><span class="glyphicon glyphicon-user"></span> My
                        Account</a></li>

                <!-- redirect to -->
                <li><a href="includes/logout.php">Logout</a></li>
            </ul>
        </div>

    </div>
</nav>

<div class="container text-center">
    <div class="row">
        <div class="col-sm-3 well">
            <div class="well" style="margin-bottom: 0">
                <h5><a href="profile.php"><?= $user_data->username; ?></a></h5>
                <img src="data:image/jpeg;base64,<?php echo $user_data->profile_image; ?>" class="img-circle"
                     height="65" width="65" alt="Avatar">
                <p><b> Followers: <?= $user_data->fan_count; ?></b></p>
                <p><b> Following: <?= $user_data->idol_count; ?></b></p>

            </div>
        </div>
        <div class="col-sm-7">

            <div class="row">

                <div class="col-md-12">
                    <div class="well" style="margin-bottom: 0">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label for="tato_status" style="display:block;text-align:left">Post a tato</label>
                                <textarea class="form-control" id="tato_status" name="tato_status" rows="3"
                                          required></textarea>
                                <?php
                                if (isset($error)) echo '<div class="span-fp-error">' . $error . '</div>';
                                ?>
                            </div>
                            <div style="text-align: left">
                                <input type="submit" name="tato_submit" class="btn btn-success" value="Potato">
                            </div>
                        </form>
                        <form method="post" enctype="multipart/form-data" style="text-align: left">
                            <input type="file" name="image" id="image"/>
                            <input type="submit" value="Upload" name="image_submit" id="image-upload"/>
                        </form>
                    </div>
                    <div style="text-align: left"> <?php $getTato->showTatoes(); ?> </div>

                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>