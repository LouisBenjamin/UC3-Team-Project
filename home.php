<?php
include dirname(__FILE__) . '/core/init.php';
date_default_timezone_set('EST');
/** @var $pdo PDO */
global $pdo;
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_SESSION['user_id'])) {
    $user_data = UserManager::getUserFromId($_SESSION['user_id']);
} else {
    header("refresh: 1; url=index.php");
    echo "You are not logged in...redirecting to login page. ";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tatoSubmit'])) {
        $text = htmlspecialchars($_POST['tatoStatus']);
        $getTatoManager->postTato($user_data->user_id, $text, $_FILES['tatoImage']['tmp_name']);
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
        .well p { text-align: left; }
        .well img { margin: 20px 0; }
        #a { background-color: lightblue; }
        #b { background-color: lightgreen; }
        #userName { color: black; font-weight: bold; font-size: medium; }
        #tatosfeed { font-weight: bold; font-size: large; padding: 11.75px;
                     background-color:lightgray; border-radius: 5px; }
        footer {background-color: black; color: #555; padding: 30px; }
    </style>

    <script src="https://code.jquery.com/jquery-2.2.1.min.js" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" defer></script>
    <script>
        function validateTato() {
            let errorMsg = document.getElementById("tatoInvalid"),
                invalid = true;
            let tato = document.tatoForm,
                statusLen = tato.tatoStatus.value.length;
            if (statusLen > 140) {
                errorMsg.innerHTML = 'Length exceeds 140 characters. ';
            } else if (statusLen === 0 && tato.tatoImage.value === "") {
                tato.tatoStatus.required = true;
                tato.tatoImage.required = true;
                errorMsg.innerHTML = 'Cannot post empty tato. ';
            } else {
                tato.tatoStatus.required = false;
                tato.tatoImage.required = false;
                errorMsg.innerHTML = '';
                invalid = false;
            }
            document.tatoForm.tatoSubmit.disabled = invalid;
        }
    </script>
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
                <li><a href="AboutPage.html" id="post-list">About</a></li>
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
                <img src="data:image/jpeg;base64,<?php echo $user_data->profile_image; ?>" class="img-circle"
                     height="65" width="65" alt="Avatar">
                <h5><a href="profile.php" id="userName"><?= $user_data->username; ?></a></h5>

                <p id="a"><b> Followers: <?= $user_data->fan_count; ?></b></p>
                <p id="b"><b> Following: <?= $user_data->idol_count; ?></b></p>

            </div>
        </div>
        <div class="col-sm-7">

            <div class="row">

                <div class="col-md-12">
                    <div class="well" style="margin-bottom: 0">
                        <form name="tatoForm" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="tatoStatus" style="display:block;text-align:left">Post a tato</label>
                                <textarea class="form-control" id="tatoStatus" name="tatoStatus" rows="3"
                                          required onchange="validateTato()"></textarea>
                                <p id="tatoInvalid" class="span-fp-error"></p>
                                <input id="tatoImage" type="file" name="tatoImage">
                            </div>
                            <script>
                                ["click", "change"].forEach(function (evt) {
                                    document.tatoForm.tatoImage.addEventListener(evt, validateTato, false);
                                });
                                ["keyup", "blur", "change"].forEach(function (evt) {
                                    document.tatoForm.tatoStatus.addEventListener(evt, validateTato, false);
                                });
                            </script>
                            <div style="text-align: left">
                                <input type="submit" name="tatoSubmit" class="btn btn-success" value="Potato" disabled>
                            </div>
                        </form>
                    </div>
                    <br>
                    <p id="tatosfeed"> Tatos Feed </p>
                    <div style="text-align: left"> <?php $getTatoManager->showTatoes(); ?> </div>

                </div>
            </div>
        </div>

    </div>
</div>
    <footer class="container-fluid text-center">

    </footer>
</body>
</html>