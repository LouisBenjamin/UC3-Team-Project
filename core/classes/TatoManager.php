<?php
require_once('UserManager.php');

/* This is a tato class that manages alls functions of the user. It includes posting and showing tatos, pictures
 */


class TatoManager
{
    /** @var PDO */
    protected $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /*This encodes the image*/
    function processImage($path){
        $image = file_get_contents(addslashes($path));
        return base64_encode($image);
    }

    /*Inserst tato in database*/
    public function postTato($uid, $text, $path) {
        if(is_uploaded_file($path))
            $file = $this->processImage($path);
        else $file = NULL;
        $ins_db = $this->pdo->prepare('INSERT INTO tatos (user_id,status,tato_image,created) VALUES (:uid,:text,:file,:created)');
        return $ins_db->execute(array(
            ':uid' => $uid,
            ':text' => $text,
            ':file' => $file,
            ':created' => date("Y-m-d H:i:s", time()),
        ));
    }
    /*Retrieve photo in database*/
    public function postPic($tatoid) {
        $stmt = $this->pdo->prepare('SELECT tato_image from tatos  where tato_id=:id');
      $stmt->bindParam(":id",$tatoid);
      $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    /*Prints all tatos found in databsae*/
    public function showTatoes() {
        // Select all info from tatos table
        $sel_data = $this->pdo->prepare('
SELECT user_id,status,tato_image,created,t.tato_id,likes_count FROM tatos t ORDER BY created DESC LIMIT 10;
');
        $sel_data->execute();
        $result = $sel_data->fetchAll();
        foreach ($result as $row) {
            $user_data = UserManager::getUserFromId($row['user_id']);
            $stmt = $this->pdo->prepare('
                SELECT like_flag FROM tatos t INNER JOIN likes l on t.tato_id = l.tato_id AND t.tato_id= ? AND l.fan_id = ?;
            ');
            $stmt->execute(array($row['tato_id'], $_SESSION['user_id']));
            $liked = $stmt->fetch(PDO::FETCH_ASSOC)['like_flag'] ?? '';
            echo "<p><a href=\"profile.php?id={$row['user_id']}\" class=\"username\">{$user_data->username}</a>:</p>";

            if (!empty($row['status'])) {
                echo "<p>{$row['status']} </p>";
            }


            if (!empty($row['tato_image'])) {
                echo '<img src="data:image/jpeg;base64,' . ($row['tato_image']) . '" width="200px">';
            }

            echo "
            <div>
                <script>
                    // Function to update tato like and refresh count
                    function sendLikedTatoId(tato_id, fan_id) {
                        // On button click, call php script to update the likes for tatos
                        $('#tato-like-' + tato_id).load('includes/liketato.php', {
                            liked_tato_id: tato_id, liker_id: fan_id
                        });
                    }
                </script>
                <span class=\"badge\">{$row['created']}</span>
                <div class=\"center\">
                    <button type=\"button\" id=\"like-btn\" class=\"btn btn-default btn-sm\"
                            onclick=\"sendLikedTatoId({$row['tato_id']},{$_SESSION['user_id']})\">            
                        <!-- To display the number of likes for a tato fetched from table -->
                        <span id=\"tato-like-{$row['tato_id']}\">";
            if ($liked) echo '<img src="assets/images/unlike.png" alt="unlike" width="30px">';
            else echo '<img src="assets/images/like.png" alt="like" width="30px">';
            echo $row['likes_count'] . '</span></button></div></div><hr>';
        }
    }
}
