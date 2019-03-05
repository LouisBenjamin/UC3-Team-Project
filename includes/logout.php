<?php
session_start();

setcookie(session_name(), "", time() - 3600*24*7);
session_destroy();
$login_url = '../index.php';
?>

<!doctype html>
<html lang="en-US">
<head><title>You are logged out!</title></head>
<body>
<h3>Logging out.. redirecting to home. </h3>
<?php
header("refresh: 1; url=$login_url");
exit;
?>
</body>
</html>